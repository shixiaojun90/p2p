<?php
    /**
    * 手机版 用户中心
    */
    class UserAction extends MobileAction
    {
        
         public function index()
         {   
			  $data = M('escrow_account')->field('*')->where('uid='.$this->uid)->find();
			 if(empty($data)){
			      $this->assign("is_bangding",1);
			   }
             $this->display();
         }
         
         /**
         * 个人资料
         */
         public function info()
         {
             $this->assign("kflist",get_admin_name());
             $pre = C('DB_PREFIX');
             $rule = M('ausers u')->field('u.id,u.qq,u.phone')->join("{$pre}members m ON m.customer_id=u.id")->where("u.is_kf =1 and m.customer_id={$minfo['customer_id']}")->select();
             foreach($rule as $key=>$v){
                $list[$key]['qq']=$v['qq'];
                $list[$key]['phone']=$v['phone'];
             }
             $this->assign("kfs",$list);
        
             $minfo =getMinfo($this->uid,true);

             $this->assign("minfo",$minfo);
             $this->display();
         }
         
         /**
         * 资金信息
         */
         public function fund()
         {
             $this->assign('pcount', get_personal_count($this->uid));   
             $this->assign('benefit', get_personal_benefit($this->uid));   //收入
             $minfo =getMinfo($this->uid,true);
             $this->assign("minfo",$minfo); 
             $this->display();
         }
         
         /**
         * 我要提现
         */
         public function cash()
         {
             if($this->isAjax()){
                  $money = $this->_post('money');
                  $paypass = $this->_post('paypass');
                  $status = checkCash($this->uid, $money, $paypass);
                  if($status == 'TRUE'){
                      die('TRUE');
                  }else{
                      die('<font color=red>'.$status.'</font>');   
                  }
             }else{
                 $pre = C('DB_PREFIX');
                 $field = "m.user_name,m.user_phone,(mm.account_money+mm.back_money) all_money,mm.account_money,mm.back_money,i.real_name,b.bank_num,b.bank_name,b.bank_address";
                 $vo = M('members m')->field($field)->join("{$pre}member_info i on i.uid = m.id")->join("{$pre}member_money mm on mm.uid = m.id")->join("{$pre}member_banks b on b.uid = m.id")->where("m.id={$this->uid}")->find();
                 //print_r($vo);exit;
                 if(empty($vo['bank_num'])) 
                    $this->error("请用电脑登录先绑定银行卡后申请提现！");
                  /* */ 
                    
                 $tqfee = explode( "|", $this->glo['fee_tqtx']);
                 $fee[0] = explode( "-", $tqfee[0]);
                 $fee[1] = explode( "-", $tqfee[1]);
                 $fee[2] = explode( "-", $tqfee[2]);
                 $this->assign( "fee",$fee);
                 $borrow_info = M("borrow_info")
                            ->field("sum(borrow_money+borrow_interest+borrow_fee) as borrow, sum(repayment_money+repayment_interest) as also")
                            ->where("borrow_uid = {$this->uid} and borrow_type=4 and borrow_status in (0,2,4,6,8,9,10)")
                            ->find();
                 $vo['all_money'] -= $borrow_info['borrow'] + $borrow_info['also'];
                 $this->assign("borrow_info", $borrow_info);
                 $this->assign( "vo",$vo);
                 $this->assign("memberinfo", M('members')->find($this->uid));
                 $this->display(); 
             }  
         }
         /**
         * 投资总表
         */
         public function invest()
         {
             $uid = $this->uid;
             $pre = C('DB_PREFIX');
            
             $this->assign("dc",M('investor_detail')->where("investor_uid = {$this->uid}")->sum('substitute_money'));
             $this->assign("mx",getMemberBorrowScan($this->uid));
             $this->display();
         }
         public function loan()
         {
             $this->assign("mx",getMemberBorrowScan($this->uid));
             $this->display();   
         }
         /**
         * 安全中心
         */
         public function safe()
         {
             $this->assign("memberinfo", M('members')->find($this->uid));
             $this->assign("mstatus", M('members_status')->field(true)->find($this->uid)); 
             $this->assign("memberdetail", M('member_info')->find($this->uid));
             $paypass = M("members")->field('pin_pass')->where('id='.$this->uid)->find();
             $this->assign('paypass', $paypass['pin_pass']);
             $this->display();
         }
         /**
         * 设置支付密码
         */
         public function setPayPass()
         {
            if($this->isAjax()){
                $password = $this->_post('password');
                $paypass = $this->_post('paypass');
                $paypass2 = $this->_post('paypass2');
                if(!$password || !$paypass || !$paypass2){
                    die('数据不完整，请检查后再试');
                }
                $paypass == $password && die('不能和登陆密码相同，请重新输入');
                $paypass != $paypass2 && die('两次支付密码不一致，请重新输入');
                $user = M('members')->field('user_pass, pin_pass')->where('id='.$this->uid)->find();
                !$user  && die('数据有误');
                if($user['user_pass']!=md5($password)){
                    die('登陆密码不正确');   
                }
                if(M("members")->where('id='.$this->uid)->save(array('pin_pass'=>md5($paypass)))){
                    die('TRUE');
                }else{
                    echo '设置出错，刷新页面重试';   
                }
                
            }else{
                $this->display();
            } 
         }
         /**
         * 修改支付密码
         * 
         */
         public function editpaypass()
         {   
             if($this->isAjax()){
                $oldpass = $this->_post('oldpass');
                $paypass = $this->_post('paypass');
                $paypass2 = $this->_post('paypass2');
                if(!$oldpass || !$paypass || !$paypass2){
                    die('数据不完整，请检查后再试');
                }
                $paypass == $oldpass && die('新密码不能和旧密码相同，请重新输入');
                $paypass != $paypass2 && die('两次支付密码不一致，请重新输入');
                $user = M('members')->field('pin_pass')->where('id='.$this->uid)->find();
                !$user  && die('数据有误');
                if($user['pin_pass']!=md5($oldpass)){
                    die('支付密码不正确');   
                }
                if(M("members")->where('id='.$this->uid)->save(array('pin_pass'=>md5($paypass)))){
                    die('TRUE');
                }else{
                    echo '设置出错，刷新页面重试';   
                } 
                 
             }else{
                $this->display(); 
             }
         }
         
         /**
         * 修改登录密码
         * 
         */
         public function editpass()
         {
             if($this->isAjax()){
                $oldpass = $this->_post('oldpass');
                $password = $this->_post('password');
                $password2 = $this->_post('password2');
                if(!$oldpass || !$password || !$password2){
                    die('数据不完整，请检查后再试');
                }
                $password == $oldpass && die('新密码不能和旧密码相同，请重新输入');
                $password != $password2 && die('两次密码不一致，请重新输入');
                $user = M('members')->field('user_pass')->where('id='.$this->uid)->find();
                !$user  && die('数据有误');
                if($user['user_pass']!=md5($oldpass)){
                    die('旧密码不正确');   
                }
                if(M("members")->where('id='.$this->uid)->save(array('user_pass'=>md5($password)))){
                    die('TRUE');
                }else{
                    echo '设置出错，刷新页面重试';   
                } 
                 
             }else{
                $this->display(); 
             }
         }
         
         /**
         * 资金记录
         */
         public function  records()
         {
            $logtype = C('MONEY_LOG');
            $this->assign('log_type',$logtype);

            $map['uid'] = $this->uid;
            $list = getMoneyLog($map,15);
            $this->assign("list",$list['list']);        
            $this->assign("pagebar",$list['page']);    
            $this->assign("query", http_build_query($search));
            $this->display();
         }
         
         public function msg()
         {
             if($this->isAjax()){
                $id = $this->_get('id');
                $msg = M('inner_msg')->field('msg')->where('id='.$id.' and uid='.$this->uid)->find();
                if(count($msg)){
                    M('inner_msg')->where('id='.$id)->save(array('status'=>1));
                    echo $msg['msg'];
                }else{
                    echo '<font color=\'red\'>读取错误</font>';
                }

             }else{
                $map['uid'] = $this->uid;
                //分页处理
                import("ORG.Util.Page");
                $count = M('inner_msg')->where($map)->count('id');
                $p = new Page($count, 15);
                $page = $p->show();
                $Lsql = "{$p->firstRow},{$p->listRows}";
                //分页处理
                $list = M('inner_msg')->where($map)->order('status asc,id DESC')->limit($Lsql)->select();

                $this->assign("list",$list);
                $this->assign("pagebar",$page);
                $this->assign("count",$count);
                $this->display();     
             }
                
         }
		 
    /*
	    **邮箱验证
	 */
   
	
   public function dosetemail(){
       $email=$_POST['email'];
	   
	  $yzemail=M("members")->where("user_email='{$email}'")->find();
	  if(!empty($yzemail)){
	  
	    die("邮箱已被人占用");
	   } 
	   
	   if(!empty($email)){
	       $data['user_email']=$email;
		   $rs1=M('members')->where("id={$this->uid}")->save($data);
		  setMemberStatus($this->uid, 'email', 1, 10, '邮箱');
		     if($rs1){
			       die("TRUE");
			   }else{
			       die("认证失败");
			   }
		   }else{
		   
		     die("参数有误");
		   }
   
     }
	 
	 
	         /**
		 *验证手机号
		  
		**/ 
    public function editephone(){
	   
	     $this->display();
		 
	   }  	
    public function setphone(){
	     $mobilenum=$_POST['mobilenum'];
		 $phonecode=$_POST['phonecode'];
		 if(session('code_temp')!=$mobilecode){
				  die("验证码不正确");
				 }
				 
	   $yzmobile=M("members")->where("user_phone='{$mobilenum}'")->find();
	   if(!empty($yzmobile)){
	       die("手机号已存在");
	    }			 
				 
	    $data['user_phone']=$mobilenum;
        $rs=M("members")->where("id={$this->uid}")->save($data);
          if(!empty($rs)){
		    setMemberStatus($this->uid, 'phone', 1, 10, '手机');
			  die('TRUE');
		  }else{
		  
		      die('false');
		  }		

	   }	
	   
	/*
	 *验证身份证
	*/  			 
	
    public function  cardid(){
	   $parm=array();
       $parm['id_status']=array('eq',1);
	   $parm['uid']=array('eq',$this->uid);
	   $vo=M("members_status")->where($parm)->find();
	   if(!empty($vo)){
	   $userinfo=M("member_info")->field("idcard,real_name,card_img,card_back_img")->where("uid={$this->uid}")->find(); 
	     $this->assign("userinfo",$userinfo);
	     }else{
		  $rsstauts=setMemberStatus($this->uid, 'id', 1, 10, '身份证号');
	       $this->success("实名资料还没有认证！", U('/m/user/editecardid'));	
		   exit(); 
		 
		 }
	   $this->assign("username",$this->uname);
       $this->display();
	
	
	 }	 
   	
	public function editecardid(){
	  $this->display();
	
	 }	
	 
	public  function docardid(){
	   $cardid=$_POST['idcard'];
	   $real_name=$_POST['real_name'];
       if(!preg_match("/^(\d{18,18}|\d{15,15}|\d{17,17}x)$/",$cardid)){
		  $this->error("身份证不合法");
		  exit();
		} 
	   $data['idcard']=$cardid;
	   $data['real_name']=$real_name;
	 
	        import("ORG.Net.UploadFile");
			$upload=new UploadFile();
	        $upload->maxSize=3145728;
	        $upload->saveRule = 'time';
			$upload->thumb = true ;
			$upload->thumbMaxWidth ="300,320" ;
			$upload->thumbMaxHeight = "130,320";
			$upload->allowExts=array('jpg','gif','png','jpg');
	        $upload->savePath='./UF/Uploads/Idcard/';
		    $pathsave="UF/Uploads/Idcard/";
		    $upload->upload();
	  $info=$upload->getUploadFileInfo();
	   
	   if(!empty($info)){ 
	  
			$data['card_img']=$pathsave.$info[0]['savename'];
			$data['card_back_img']=$pathsave.$info[1]['savename'];
		    $sel=M("member_info")->where("uid={$this->uid}")->find();
		if(!empty($sel)){
		    $rs=M("member_info")->where("uid={$this->uid}")->save($data);
		}else{
		    $data['uid']=$this->uid;
		    $data['up_time']=time();
		    $rs=M("member_info")->add($data);
		 }
		  
	  if($rs!==false)
	  $this->success("认证成功",U("./m/user/"));
	    else
	  $this->error("认证失败");	
	   }else{
      
	  $this->error("认证失败");	   
	   
	   }
		
		
		 
	 
      	
	  
	 } 




	 
	 public function bankinfo(){  //银行卡绑定信息		   
		$bank = C('bank');
        $this->assign('bank', $bank);
        $ids = M('members_status')->getFieldByUid($this->uid,'id_status');
        if($ids!=1){
              $this->error("还没有实名认证",U("/m/user/cardid/"));
        }else{
         $voinfo = M("member_info")->field('idcard,real_name')->find($this->uid);
         $vobank = M("member_banks")->field(true)->where("uid = {$this->uid} and bank_num !=''")->find();
	     $this->assign("vobank",$vobank);
         $this->assign("voinfo",$voinfo);
         $bank = C('bank');
         $this->assign('bank_list', $bank);
	     $this->assign('edit_bank', $this->glo['edit_bank']);
            }
			 $this->display();
       
	  }
	  
	  
	 public function bankinfohandle(){
	     $bank_info = M('member_banks')->field("uid, bank_num")->where("uid=".$this->uid)->find();
		 $data['bank_num'] = text($_POST['txt_account']);
         $data['bank_name'] = text($_POST['bank_name']);
         $data['bank_address'] = text($_POST['txt_bankName']);
         $data['bank_province'] =intval($_POST['province']);
         $data['bank_city'] =intval($_POST['city']);
         $data['add_ip'] = get_client_ip();
         $data['add_time'] = time(); 
         $data['uid']=intval($this->uid);
		 if($bank_info['uid']){
            $old = text($_POST['txt_oldaccount']);
            if($bank_info['bank_num'] && $old <> $bank_info['bank_num']) 
			 $this->error('与原来卡号不服');
			
            $newid = M('member_banks')->where("uid=".$this->uid)->save($data);
        }else{
            $newid = M('member_banks')->add($data);
        }
        if($newid){
             $this->success("编辑成功");
        }
        else $this->error("添加失败");;
	      
	 
	   }  
	  
	 public function banklist(){
	     $bank = C('bank');
        $this->assign('bank', $bank);
        $ids = M('members_status')->getFieldByUid($this->uid,'id_status');
        if($ids!=1){
             $this->error("您还未完成身份验证，请先进行实名认证！",U("/m/user/cardid/")); 
        }else{
            $voinfo = M("member_info")->field('idcard,real_name')->find($this->uid);
            $vobank = M("member_banks")->field(true)->where("uid = {$this->uid} and bank_num !=''")->find();
            $this->assign("voinfo",$voinfo);
            $this->assign("vobank",$vobank);
           
          }
		
	       $this->display();
	    }
	  
	  
	  public function getarea(){  //获取地区
        $rid = intval($_GET['rid']);
        $map['parentid'] = $rid;
        $alist = M('cityinfo')->field('id,cityname')->where($map)->select();
        
        if(count($alist)===0){
            $str="<option value=''>--该地区下无下级地区--</option>\r\n";
        }else{
            foreach($alist as $v){
                $str.="<option value='{$v['id']}'>{$v['cityname']}</option>\r\n";
            }
        }
        $data['option'] = $str;
        $res = json_encode($data);
        echo $res;
    }  
	  
	  
	   /**
    * 绑定乾多多账号
    * 
    */
    public function  bindingAccount()
    {
        header("Content-type:text/html;charset=utf-8");
        $status = M('members_status')->field('*')->where("uid={$this->uid}")->find();
        //$status['email_status']!=1 &&  $this->error('请先认证邮箱再来绑定托管账户', '/member/verify#fragment-1');
        $status['phone_status']!=1 &&  $this->error('请先认证手机号再来绑定托管账户', '/m/user/editephone/');
        $status['id_status']!=1 &&  $this->error('请先实名认证再来绑定托管账户', '/m/user/editecardid/');
        
        if(M('escrow_account')->where("uid={$this->uid}")->count('uid')){
             $this->error('您已经绑定了托管账户，无需重复绑定', '/m/user/');   
        }
        
        $user_info = M('members')->field('user_name, user_email, user_phone')->where("id={$this->uid}")->find();
        $id_info = M("member_info")->field('idcard, real_name')->where("uid={$this->uid}")->find();
        import("ORG.Loan.Escrow");
        $loan = new Escrow();

        $data =  $loan->registerMobileAccount($user_info['user_phone'], $user_info['user_email'], $id_info['real_name'], $id_info['idcard'],$user_info['user_name'],2,'','','',$this->uid);
        
		$form =  $loan->setForm($data, 'register');
        echo $form;
        exit; 

    }
    /**
    * 绑定乾多多返回地址
    * 
    */
    public function bindReturn()
    {
        
        $lang = L('Binding');
        $msg = $_POST['Message'];
        $_POST['ResultCode']==88 && $msg = "成功绑定托管账户！";
		
		if($_POST['ResultCode']==88){
		      $this->success("成功绑定托管账户！",U("/m/user/"));
		 }else{
		      $this->error($msg,U("/m/user/"));
		   }
		
      
        
    }
	
	//****一下信息先留着
     public function checkLoan()
    {
        $msg = '';
        $url = '';
        $status = M('members_status')->field('*')->where("uid={$this->uid}")->find();
        /*if($status['email_status']!=1){
            $msg = "请点击确定完成邮箱验证";
            $url = '/member/verify#fragment-1';    
        }else*/
        if($status['phone_status']!=1){
            $msg = "请点击确定完成手机验证";
            $url = '/member/verify#fragment-2';
        }elseif($status['id_status']!=1){
            $msg = "请点击确定完成实名认证";
            $url = '/member/verify#fragment-3';
        }
        
        if(!$msg){
            $escrow = M('escrow_account')->field('qdd_marked')->where("uid={$this->uid}")->find();
            if(!$escrow['qdd_marked']){
                $url = U('member/bank/bindingAccount');
                $msg = "点击确定完成绑定托管";
            }else{
                $msg = 'ok';
            }
        }
        echo json_encode(array('msg'=>$msg, 'url'=>$url));
        
    }


    /**
    *    绑定银行卡通知地址
    **/
    public function bindbankret()
    {
        import("ORG.Loan.Escrow");
        $loan = new Escrow();
        if($loan->toloanfastpayVerify($_POST)){
            $msg = $_POST['Message'];
            if($_POST['ResultCode']!=88){
                $this->error($msg,'/m/bank/banklist/'); 
            }else{
                $this->success('银行卡绑定'.$msg, '/m/bank/bankinfo/');
            }
        }
        $msg = "返回信息被篡改";
        $this->error($msg, '/m/bank/banklist/'); 
    }	
	
	
    
	  
		 
		 
	 
   
   
	 
		 
		 
        
    }
?>

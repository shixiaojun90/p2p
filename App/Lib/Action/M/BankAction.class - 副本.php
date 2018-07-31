<?php 
   class BankAction extends MobileAction{
      
	   public function index(){
	       
	   
	     }
   
        public function charge(){  //充值界面
		    $data = M('escrow_account')->field('*')->where('uid='.$this->uid)->find();
                if(!$data){
                $this->error('请到先绑定托管账户', '/m/user/');
                    }
					
			  $this->display(); 		
		
		   }
		
        public function mobilecharge(){//提交充值
		          
		 import("ORG.Loan.Escrow");
        $charge = new Escrow();
        $data = M('escrow_account')->field('*')->where('uid='.$this->uid)->find();
        if(!$data){
            $this->error('请先绑定托管账户', '/m/user/');
        }
        $RechargeType =  isset($_POST['RechargeType'])?intval($_POST['RechargeType']):'';
        $FeeType = isset($_POST['FeeType'])?intval($_POST['FeeType']):'';
        $realmoney=$_POST['money'];

        $add = array(    //同时添加到 member_payonline 一条临时数据 状态 issuccess = 0
            'uid'=> $this->uid,
            'add_time'=>time(),
            'money' => $realmoney,
            'RechargeType'  => intval($RechargeType),
        );
        $id = M("member_payonline")->add($add);//利用返回id 查找表自动生成的 orderno(平台充值单号)
        if(!$id){
            $this->error('订单生成出错！');
        }
		$orders = date("YmdHi").$id;
        $Amount  = floatval($_POST['money']);
        $ReturnURL = C('WEB_URL').U('m/bank/chargeReturn'); 
        $NotifyURL = C('WEB_URL').U("member/Notify/charge");
      

	     
        $array = $charge->Moneymoremorecharge($data['qdd_marked'], $data['platform_marked'], $orders, $Amount, $ReturnURL, $NotifyURL,$RechargeType,$FeeType);

        $form  = $charge->setForm($array, 'charge');   
		echo "<div style='display:none;margin-top:68px; text-align:center;'>";
		echo "<img src='__ROOT__/Style/newmobile/images/progress.gif'>";
        echo $form;
		echo "</div>";
        exit; 
		
		 }
		 
		public function chargeReturn(){  //充值回返地址，提示充值成功与否
		       $msg = $_POST['Message'];
		  if($_REQUEST['ResultCode']==88){
		    	$msg = "充值成功";
		    }else{
			    $msg="充值未成功";
			
			}
          $this->assign('msg', $msg);
          $this->display();
		
		
		 }
	
	 
	 /**
	     ** 提现页面
	   
	  **/	
		 
	   public function Withdraw(){
	       $data = M('escrow_account')->field('*')->where('uid='.$this->uid)->find();
              if(!$data){
            $this->error('请到网站先绑定托管账户', '/m/user/');
                }
			$userinfo=M("members")->where("id={$this->uid}")->getField("user_name");	
			$this->assign("username",$userinfo);
			$money_info = M("member_money")->field("account_money, back_money")->where("uid={$this->uid}")->find();
			$this->assign("usermoney",$money_info['account_money']+$money_info['back_money']);			
			$this->display(); 
	   
	   
	    }
		

	  /**
	     ** 执行提现
	   
	  **/		
		
  public function mobilewithdraw(){
		   
		 $_P_fee = get_global_setting();
		$pre = C('DB_PREFIX');
		$money_info = M("member_money")->field("account_money, back_money")->where("uid={$this->uid}")->find();
		$amount = floatval($_POST['money']);  

        $amount > ($money_info['account_money']+$money_info['back_money']) &&  $this->error('提现金额超过了可用资金金额！');
		$tx['uid']=$this->uid;
		$tx['add_ip']=get_client_ip();
		$tx['add_time']=time();
		$tx['withdraw_money']= $amount;
		$nid=M('member_withdraw')->add($tx);
		
		$field = "m.user_leve, m.time_limit, m.user_name,m.user_phone,(mm.account_money+mm.back_money) all_money,mm.account_money,mm.back_money,i.real_name,b.bank_num,b.bank_name,b.bank_address,b.bank_province,b.bank_city";
		$vo = M('members m')->field($field)->join("{$pre}member_info i on i.uid = m.id")->join("{$pre}member_money mm on mm.uid = m.id")->join("{$pre}member_banks b on b.uid = m.id")->where("m.id={$this->uid}")->find();
		if(empty($vo['bank_num'])) 
		 $this->error("您还未绑定银行帐户，请先绑定账号",u("/m/user/"));
		else{
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
				
			$vo['OrderNo']=$nid;
		
          
		}
	    $va=M('escrow_account')->where("uid={$this->uid}")->find();
	    $fee_percent_arr = explode('|', $_P_fee['fee_percent']);
        $fee_max_arr = explode('|', $_P_fee['fee_max']); //用户承担的最高手续费
        $fee_rate_arr = explode('|', $_P_fee['fee_rate']);
        
        $fee_percent = 0;
        if($vo['user_leve']!=0 && $vo['time_limit']>time()){ //vip会员
            $fee_percent = intval($fee_percent_arr['0']);   
            $fee_max = floatval($fee_max_arr['0']); 
            $fee_rate = $fee_rate_arr['0'];
        }else{
            $fee_percent = intval($fee_percent_arr['1']);    
            $fee_max = floatval($fee_max_arr['1']);
            $fee_rate = $fee_rate_arr['1'];
        }
	    $submitdata['WithdrawMoneymoremore']=$va['qdd_marked'];
	    if($nid)$submitdata['OrderNo'] = date("YmdHi").$nid;
	    $submitdata['CardNo']=$vo['bank_num'];
	    $submitdata['CardType']=0;//(0.借记卡 1.信用卡)
	    $submitdata['BankCode']=$vo['bank_name'];//银行代码
	    $submitdata['BranchBankName']=$vo['bank_address'];
	    $submitdata['Province']=$vo['bank_province'];
	    $submitdata['City']=$vo['bank_city'];
	    $submitdata['FeePercent']= $fee_percent;
        $submitdata['FeeMax']= $fee_max>0? $fee_max: '';
        $submitdata['FeeRate']= $fee_rate>0? $fee_rate: '';
	    $submitdata['Amount']= $amount;
	    $submitdata['PlatformMoneymoremore']=$va['platform_marked'];
	    $submitdata['Remark1']='';
		import("ORG.Loan.Escrow");
        $loan = new Escrow();

        $data =  $loan->mobilewithdraw($submitdata);
   
      $form =  $loan->setForm($data, 'withdraw');
	  	echo "<div style='display:none;margin-top:68px; text-align:center;'>";
		echo "<img src='__ROOT__/Style/newmobile/images/progress.gif'>";
        echo $form;
		echo "</div>";
        exit;
      }
		
		
	
   
   	/**
	*提现返回前台
	*
	*/
	public function withdrawreturn(){  
		//dump($_POST);exit;
		$WithdrawMoneymoremore = $_POST["WithdrawMoneymoremore"];
	    $PlatformMoneymoremore = $_POST["PlatformMoneymoremore"];
	    $LoanNo = $_POST["LoanNo"];
	    $OrderNo = $_POST["OrderNo"];
	    $Amount = $_POST["Amount"];
	    $FeePercent = $_POST["FeePercent"];
        $FeeMax = $_POST['FeeMax'];
        $FeeRate = $_POST['FeeRate'];
        $FeeWithdraws = $_POST['FeeWithdraws'];
	    $Fee = $_POST["Fee"];
	    $FreeLimit = $_POST["FreeLimit"];
        $FeeRate = $_POST['FeeRate'];
        $FeeSplitting = $_POST['FeeSplitting'];
	    $RandomTimeStamp = $_POST["RandomTimeStamp"];
	    $Remark1 = $_POST["Remark1"];
	    $Remark2 = $_POST["Remark2"];
	    $Remark3 = $_POST["Remark3"];
	    $ResultCode = $_POST["ResultCode"];
	    $SignInfo = $_POST["SignInfo"];
	    
	    $dataStr = $WithdrawMoneymoremore.$PlatformMoneymoremore.$LoanNo.$OrderNo.$Amount.$FeeMax.$FeeWithdraws.$FeePercent.$Fee.$FreeLimit.$FeeRate.$FeeSplitting.$RandomTimeStamp.$Remark1.$Remark2.$Remark3.$ResultCode;
	    import("ORG.Loan.Escrow");
         
        $loan = new Escrow();
		    
	    if($this->antistate == 0)
	    {
		    $dataStr = strtoupper(md5($dataStr));
		    
	    }

        $msg = $_POST['Message'];
	    $this->assign('msg', $msg);
 
		$this->display();
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
			 $this->error('与原来卡号不符和');
			
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
	  
	  //****一下信息先留着
     public function checkLoan()
    {
        $msg = '';
        $url = '';
       
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
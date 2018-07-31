<?php
    class PubAction extends Action
    {
        
         public function Verify()
         {
            import("ORG.Util.Image");
            Image::buildImageVerify();   
         }
        /**
         * 用户登陆
         */
         public function login()
         {   
			 $hetong = M('hetong')->field('name,dizhi,tel')->find();
			$this->assign("web",$hetong);
             if($this->isPost()){
                //[username] => dsfsaf [password] => asdf [verify] => mebr
                 if($_SESSION['verify'] != md5($_POST['verify'])) {
                   $this->error('验证码错误！');
                 }
                 $user_name = $this->_post('username');
                 $pass = $this->_post('password');
                 $vo = M('members')->field('id,user_name,user_email,user_pass,is_ban')->where("user_name='{$user_name}' or user_email='{$user_name}'")->find();
                 if(!$vo){
                    $this->error('没有此用户！'); 
                 }
                 if($vo['is_ban']==1){
                    $this->error('您的帐户已被冻结，请联系客服处理！');
                 }  
                 if($vo['user_pass'] != md5($pass)){
                    $this->error('密码错误，请重新输入！'); 
                 }
                 
                 session('u_id', $vo['id']);
                 session('u_user_name', $vo['user_name']);
                 $JumpUrl = U('M/user/index');
                 //session('JumpUrl','');
                 $this->success("登陆成功！", $JumpUrl);
                 
             }else{
                 if(session('u_id')){
                    $this->redirect('M/user/index');   
                 }
                 session('JumpUrl', $_SERVER['HTTP_REFERER']);
                 $this->display();    
             }
             
         }
         /**
         * 注销用户
         */
         public function Logout()
         {
            session(null);
            $this->success('安全退出!',U('M/index/index'));   
         } 
         
         /**
         * 用户注册
         * 
         */
         public function regist()
         {
			 $datag = get_global_setting();
			$is_manual=$datag['is_manual'];
			$this->assign("is_manual",$is_manual);
			 $this->display();
         } 
     
	 //手机验证开始............
    public function sendphone() {
		$smsTxt = FS("Webconfig/smstxt");
		$smsTxt = de_xie($smsTxt);
		$phone = text($_POST['cellphone']);
		$xuid = M('members') -> getFieldByUserPhone($phone, 'id');
		if ($xuid > 0 && $xuid <> $this -> uid) ajaxmsg("", 2);

		$code = rand_string_reg(6, 1, 2);
		$datag = get_global_setting();
		$is_manual = $datag['is_manual'];
		
		if ($is_manual == 0) { // 如果未开启后台人工手机验证，则由系统向会员自动发送手机验证码到会员手机，
			$res = sendsms($phone, str_replace(array("#UserName#", "#CODE#"), array(session('u_user_name'), $code), $smsTxt['verify_phone']));
			session("temp_phone", $phone);
			ajaxmsg();
		} else { // 否则，则由后台管理员来手动审核手机验证
			$res = true;
			$phonestatus = M('members_status') -> getFieldByUid($this -> uid, 'phone_status');
			if ($phonestatus == 1) ajaxmsg("手机已经通过验证", 1);
			$updata['phone_status'] = 3; //待审核
			$updata1['user_phone'] = $phone;
			$a = M('members') -> where("id = {$this->uid}") -> count('id');
			if ($a == 1) $newid = M("members") -> where("id={$this->uid}") -> save($updata1);
			else {
				M('members') -> where("id={$this->uid}") -> setField('user_phone', $phone);
			} 

			$updata2['cell_phone'] = $phone;
			$b = M('member_info') -> where("uid = {$this->uid}") -> count('uid');
			if ($b == 1) $newid = M("member_info") -> where("uid={$this->uid}") -> save($updata2);
			else {
				$updata2['uid'] = $this -> uid;
				$updata2['cell_phone'] = $phone;
				M('member_info') -> add($updata2);
			} 
			$c = M('members_status') -> where("uid = {$this->uid}") -> count('uid');
			if ($c == 1) $newid = M("members_status") -> where("uid={$this->uid}") -> save($updata);
			else {
				$updata['uid'] = $this -> uid;
				$newid = M('members_status') -> add($updata);
			} 
			if ($newid) {
				ajaxmsg();
			} else ajaxmsg("验证失败", 0); 
			// ////////////////////////////////////////////////////////////
		} 
		
		if ($res) {
			session("temp_phone", $phone);
			ajaxmsg();
		} else ajaxmsg("", 0);
	}

	//手机验证结束	
		public function regtemp(){
			//session("temp_email") = text($_POST['txtEmail']);
			$map['user_name'] = text($_POST['txtUser']);
			$count = M('members')->where($map)->count('id');
			$time = time()-24*3600;
			M('members_cache')->where("addtime<{$time}")->delete();
			$cache_count = M('members_cache')->where("user='{$map['user_name']}'")->count('cache_id');
			if ($count>0 || $cache_count>0) {
				ajaxmsg('此用户名已被注册',0);
			} 
			
			$datag = get_global_setting();
			$is_manual=$datag['is_manual'];
			if($is_manual == 0){
				if(text($_POST['phoneCode']) == ""){
					ajaxmsg('请输入验证码！',0);
				}

				if (session('code_temp')==text($_POST['phoneCode']) &&  session('temp_phone')==$_POST['txt_phone']) {
					if(session('send_time')< (time()-36000)){
						session('temp_phone',null);
						session('send_time', null);
						ajaxmsg('手机验证码超时',0);   
					}              
				}else{
					//session('temp_phone',null);
					//session('send_time', null);
					ajaxmsg('手机验证码错误',0);
				}
				session('temp_phone',$_POST['txt_phone']);
			}
			else{
				session('temp_phone',$_POST['txt_phone']);
			}
			
		
			$txtRec = text($_POST['txtRec']);
			$recommend_id= M("members")->field("id")->where("user_name = '{$txtRec}'")->find();
			//file_put_contents('1.txt',M()->getLastSql());
			//$recommend_id ? $data['recommend_id'] = $recommend_id : $data['recommend_id'] = 0;
			if($recommend_id == ''){
				$data['recommend_id'] = 0;
			}else{
				$data['recommend_id'] = $recommend_id['id'];
			}
		
			session('user_name',$map['user_name']);	
			session('txtPwd',$_POST['txtPwd']);	
			session('recommend_id',$data['recommend_id']);	
			session('txtEmail',text($_POST['txtEmail']));
			ajaxmsg();
		}

		public function register2(){
			$this->display();
		}

		/**
     * 注册绑定乾多多账号
     *
     */
		public function  regBindingAccount()
		{
			header("Content-type:text/html;charset=utf-8");
			$map['user_name'] = session('user_name');
			$count = M('members')->where($map)->count('id');
			if ($count>0) {
				$json['status'] = 1;
				exit(json_encode($json));
			}

			$key['user_name'] = session('user_name');
			$key['user_pass'] = md5(session('txtPwd'));
			$key['recommend_id'] = session('recommend_id');
			empty($key['user_email']) ? $key['user_email'] = "" : $key['user_email'] = session('txtEmail'); 
			$key['user_phone']  = session('temp_phone');
			$key['reg_time'] = time();
			$newid = M("members")->add($key); 
			if($newid){
				session('u_id',$newid);
				$data['real_name'] = text($_POST['txt_real_name']);
				$data['idcard'] = text($_POST['txt_idcard']);
				$data['cell_phone']  = session('temp_phone');
				$data['up_time'] = time();
				$c = M('member_info') -> where("uid = {$newid}") -> count('uid');
				if ($c == 1) {
					$newid = M('member_info') -> where("uid = {$newid}") -> save($data);
				} else {
					$data['uid'] = $newid;
					M('member_info') -> add($data);
				}	
		
				$data1['idcard'] = text($_POST['txt_idcard']);
				$data1['up_time'] = time();
				$data1['uid'] = $newid;
				$data1['status'] = 0;
				$b = M('name_apply') -> where("uid = {$this->uid}") -> count('uid');
				if ($b == 1) {
					M('name_apply') -> where("uid ={$this->uid}") -> save($data1);
				} else {
					M('name_apply') -> add($data1);
				}
			
				$ms = M('members_status') -> where("uid={$newid}") -> setField('id_status', 3);
				if ($ms != 1) {
						$dt['uid'] = $newid;
						$dt['id_status'] = 1;
						$dt['phone_status'] = 1;
						if(session('txtEmail')){
							$dt['email_status'] = 1;
						}else{
							$dt['email_status'] = 0;
						}
						
						M('members_status') -> add($dt); 
				}

				import("ORG.Loan.Escrow");
				$loan = new Escrow();
				$dataRows =  $loan->registerAccountphone($key['user_phone'], $key['user_email'], $data['real_name'], $data['idcard'],$key['user_name'],2,'','','',$newid);
				$form =  $loan->setForm($dataRows, 'register');
				$json['ret'] =  $form;
				exit(json_encode($json));
			}			
		}

		/**
     * 注册绑定乾多多返回地址
     *
     */
    public function regBindReturn()
    {

        if(intval($_POST['ResultCode'])==88 || intval($_POST['ResultCode'])==16)
        {
            import("ORG.Loan.Escrow");
            $loan = new Escrow();
            if($loan->registerVerify($_POST)){
                $msg = $_POST['Message'];
            }else{
                $msg = "数据校验错误";
            }
            
        }else{
			$msg = $_POST['Message'];
		}
		$this->assign('msg', $msg);
		
		
        $this->display('register3');

    }
	
	public function validatephone() {
	   /***	
		  echo session('code_temp');
		
		exit();
		
		  ***/
		if (session('code_temp')==text($_POST['code'])) {
			$updata['phone_status'] = 1;
			if (!session("temp_phone")) {
				ajaxmsg("验证失败", 0);
			}
            $mid = $this->regaction();
			
			$newid = setMemberStatus($mid, 'phone', 1, 10, '手机');
			if ($newid) {
				ajaxmsg();
			} else{
				ajaxmsg("验证失败", 0);
			}
		} else {
			$this->regaction();
			ajaxmsg("验证校验码不对，请重新输入！", 2);
		} 
	}   
     
   //手机验证结束	
   	 
		
		 
		 
	/******找回密码****/
	
	
	
	
	public function getfgtpass(){
	    
		if($this->isAjax()){
		  $mobilenum=text($_POST['mobilenum']);
		  $phonecode=text($_POST['phonecode']);
		  if (!session("temp_phone")) {
				die("验证码错误");
			}   
			
		
		  $send_code=session('code_temp');
		  $send_phone=session("temp_phone");
		 // die($send_phone);
		  if($send_code!=$phonecode){
		        die("验证码错误!");
		    }
	
		  if($send_phone!=$mobilenum) 
		    {
			   die("前后手机号不符");
			}

		     die("true");
		   
		}else{
		   $this->display();
		 } 
		 
	   
	 }
	 
	
	public function getfgtpasshandle(){
	    $mobilenum=text($_POST['mobilenum']);
		$password=text($_POST['password']);
		$rs=M("members")->where("user_phone='{$mobilenum}'")->setField("user_pass",md5($password));
		if($rs!==false)
		 die("true");
		else
		  die("修改失败");
		
	
	 } 
	
	
	
	

   /**找回密码结束**/	
	   

 
  
  public function getsendcode(){
  
  $smsTxt = FS("Webconfig/smstxt");
		$smsTxt = de_xie($smsTxt);
		$phone = text($_POST['cellphone']);
		$xuid = M('members') -> getFieldByUserPhone($phone, 'id');
		//if ($xuid > 0 && $xuid <> $this -> uid) ajaxmsg("", 2);
        
		 if($xuid<=0) ajaxmsg("", 2);
		  
		$code = rand_string_reg(6, 1, 2);
		$datag = get_global_setting();
		$is_manual = $datag['is_manual'];
		$res = sendsms($phone, str_replace(array("#UserName#", "#CODE#"), array(session('u_user_name'), $code), $smsTxt['verify_phone']));
	
		
		if ($res) {
			session("temp_phone", $phone);
			ajaxmsg();
		 } else ajaxmsg("", 0);
  
   
     }  
   




   

		  
    }
?>

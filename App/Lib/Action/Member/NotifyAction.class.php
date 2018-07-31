<?php
    /**
    * 乾多多后台通知地址汇总
    */
    class NotifyAction extends MCommonAction
    {
        var $notneedlogin=true;
        /**
        * 充值通知地址
        * 
        */
        public function charge()
        {
            
          
                import("ORG.Loan.Escrow");
            $loan = new Escrow();
            $ResultCode   = intval($_POST['ResultCode']);
			$RechargeType = intval($_POST['RechargeType']);
            $str = $_POST['Message'];
            if($loan->chargeVerify($_POST)){
                $orders  = $_POST['OrderNo'];
                $id = substr($orders,12);
                $info = M('member_payonline')->where('id='.$id)->find();
				$um = M("members")->field("user_phone,user_name")->find($info['uid']);
				
                if($ResultCode==88){  //成功
					if($RechargeType=='4'){  //企业充值
						if($info['status']==1){ // status = 2  审核中
							 $str = 'SUCCESS';
						}else{
							$updata = array(
								'status'=>'1',
								'fee'=>$_POST['Fee'],
								'loan_no'=> $_POST['LoanNo'],
								);
							if(memberMoneyLog($info['uid'],3,bcsub($_POST['Amount'],$_POST['Fee'],2),"企业充值{$_POST['Amount']}元，手续费{$_POST['Fee']}元"))
							{
								M("member_payonline")->where('id='.$id)->save($updata);//核实成功，
								
								SMStip("payonline",$um['user_phone'],array("#USERANEM#","#MONEY#"),array($um['user_name'],bcsub($_POST['Amount'],$_POST['Fee'],2)));
								$str = "SUCCESS";
							}
						}

					}else{
						if($info['status']==1){   //RechargeType
							 $str = 'SUCCESS';
						}else{
							$status = intval($info['RechargeType'])==3?2:1;
							$updata = array(
								'status'=>$status,
								'fee'=>$_POST['Fee'], 
								'loan_no'=> $_POST['LoanNo'],
								);
							if($status==1 && memberMoneyLog($info['uid'],3,$_POST['Amount'],"在线充值"))
							{
								$str = "SUCCESS";
							}
							M("member_payonline")->where('id='.$id)->save($updata);//核实成功，  
							
								SMStip("payonline",$um['user_phone'],array("#USERANEM#","#MONEY#"),array($um['user_name'],bcsub($_POST['Amount'],$_POST['Fee'],2)));
							$status &&  $str = "SUCCESS";  
						}
                    }
                }elseif($ResultCode==90){// 汇款充值资金到账
                    if($info['status']==1){ // status = 2  审核中
                         $str = 'SUCCESS';
                    }else{
                        $updata = array(
                            'status'=>'1',
                            'fee'=>$_POST['Fee'],
                            'loan_no'=> $_POST['LoanNo'],
                            );
                        if(memberMoneyLog($info['uid'],3,bcsub($_POST['Amount'],$_POST['Fee'],2),"汇款充值{$_POST['Amount']}元，手续费{$_POST['Fee']}元"))
                        {
                            M("member_payonline")->where('id='.$id)->save($updata);//核实成功，
							
								SMStip("payonline",$um['user_phone'],array("#USERANEM#","#MONEY#"),array($um['user_name'],bcsub($_POST['Amount'],$_POST['Fee'],2)));
                            $str = "SUCCESS";
                        }
                    }
                }elseif($ResultCode==89){ // 汇款充值钱多多审核不通过
				  //file_put_contents("1234.txt",$ResultCode);
			     $info = M('member_payonline')->where('id='.$id)->save(array("status"=>"3"));
					if($info){
							$inn = M("inner_msg"); // 实例化inner_msg对象
							$data['uid'] = M('escrow_account')->where("qdd_marked='{$_POST['RechargeMoneymoremore']}'")->getField('uid');
							$data['title'] = "您的{$id}号汇款充值，审核未通过";
							$data['msg'] = "您的{$id}号汇款充值，审核未通过";
							$data['send_time'] = time();
							$inn->add($data);
						$str = "SUCCESS";
					}
					$str = "SUCCESS";
			    }
			}
            notifyMsg('充值',$_POST, 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], $str);
            echo $str; exit; 
            
        }
        
        /**
        * 绑定接口
        * 
        */
        public function bind()
        {
            $ResultCode = intval($_POST['ResultCode']);
            if($ResultCode==88 || $ResultCode==16){
                import("ORG.Loan.Escrow");
                $loan = new Escrow();
                if($loan->registerVerify($_POST)){
					$str = '';
                    $uid = intval($_POST['Remark1']);
                     $data = array(
                       'type' => $_POST['AccountType'],
                       'account'=>$_POST['AccountNumber'],
                       'mobile' => $_POST['Mobile'],
                       'email' => $_POST['Email'],
                       'real_name' => $_POST['RealName'],
                       'id_card'  => $_POST['IdentificationNo'],
                       'uid' => $uid,
                       'platform' => '',
                       'platform_marked' => $_POST['PlatformMoneymoremore'],
                       'qdd_marked' => $_POST['MoneymoremoreId'],
                       'add_time' => time(),
                    );
                    if(M('escrow_account')->add($data)){
                        $str = "SUCCESS";
                    }else{
						$str = "ERROR";
					}
					notifyMsg('绑定账号',$_POST, 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], $str);
					echo $str;exit;
                }
            }else{
				$uid = intval($_POST['Remark1']);
				M("members")->where("id = {$uid}")->delete();
				M("member_info")->where("uid = {$uid}")->delete();
				M("members_status")->where("uid = {$uid}")->delete();
				M("name_apply")->where("uid = {$uid}")->delete();
				
			}
        }

        /**
        * 提现通知地址
        * 
        */
        public function withdraw(){
             if($_POST['ResultCode']=='88'){
                import("ORG.Loan.Escrow");
                $loan = new Escrow();
                if($loan->withdrawVerify($_POST)){
                
                    $updata['withdraw_status'] = 1;
                    $id = $_REQUEST['OrderNo'];
                    $vo = M('member_withdraw')->field('uid,money,fee,member_status')->where("id='{$id}'")->find();
                    //if($vo['status']!=0 || !is_array($vo)) return;
                    $xid = $withdrawlog->where("uid={$vo['uid']} AND id='{$id}'")->save($updata);
                    
                    $tmoney = floatval($vo['money'] - $vo['fee']);
                    memberMoneyLog($this->uid,4,-$withdraw_money,"提现,默认自动扣减手续费".$fee."元",'0','@网站管理员@',0);
					$um = M("members")->field("user_phone,user_name")->find($this->uid);
					SMStip("withdraw",$um['user_phone'],array("#USERANEM#","#MONEY#"),array($um['user_name'],$amoney));
                    MTip('chk6',$this->uid);
                    if(M('member_withdraw')->save($updata)){
						//file_put_contents("111.txt",M()->getlastSql());
						notifyMsg('提现',$_POST, 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], 'SUCCESS');
                        echo "SUCCESS";exit;
                    } 
					notifyMsg('提现',$_POST, 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], '');
                }
            }
        }

                //后台路径

    public function authorizenotify(){
        
        
        //dump($_POST);
        $AuthorizeTypeOpen = $_POST["AuthorizeTypeOpen"];
        $AuthorizeTypeClose = $_POST["AuthorizeTypeClose"];
        $MoneymoremoreId=$_POST['MoneymoremoreId'];
    
        if($_POST["ResultCode"]=='88'){ 
        import("ORG.Loan.Escrow");

        $loan = new Escrow();
        if($loan->Authorizenotify($_POST)){
            
        $escrow=M('escrow_account');
        $open = $AuthorizeTypeOpen;    
        strpos(',', $AuthorizeTypeOpen)&& $open = explode(',',$AuthorizeTypeOpen);
        $close = $AuthorizeTypeClose;
        strpos(',', $AuthorizeTypeClose)&& $close = explode(',',$AuthorizeTypeClose);
            
                
                if(strstr($close,'1')){
                    
                    $auth['invest_auth']='0';
                }else if(strstr($open,'1')){
                    $auth['invest_auth']='1';
                }
                if(strstr($close,'2')){
                    
                    $auth['repayment']='0';
                }else if(strstr($open,'2')){
                    $auth['repayment']='1';
                }
                if(strstr($close,'3')){
                    
                    $auth['secondary_percent']='0';
                }else if(strstr($open,'3')){
                    $auth['secondary_percent']='1';
                }
    

                $info = $escrow->field('uid')->where(array(qdd_marked =>$MoneymoremoreId))->find();
                
                //dump($info);
                $nid=$escrow->where(array('uid'=>$info['uid']))->save($auth);
           
                if($nid) echo 'SUCCESS';
                
            }
        
        }
     }
        
        /**
        * 还款后台通知地址
        * 
        */
        public function detail()
        {

            if($_POST['ResultCode']=='88'){ 
                import("ORG.Loan.Escrow");
                $loan = new Escrow();
                if($loan->loanVerify($_POST)){ 
					$str = '';
                    $info = explode("_",$_POST['Remark1']);
                    $batchno = $info[0];
                    $sort_order =  $info[1];
                    $expired = explode('/', $_POST['Remark2']);
                    $loan_list = json_decode(urldecode($_POST['LoanJsonList']),true);
                    $LoanList = $loan_list;
                    
					if($_POST['Action']==1){
                        $binfo = M("borrow_info")->field("id")->where("batch_no='{$batchno}'")->find();
                        $borrow_id = $binfo['id'];
						/********分批执行还款**********/
                        if(isset($LoanList['LoanOutMoneymoremore'])){
                                $orderno = $LoanList['OrderNo'];
                                $order_arr = explode('_', $orderno);
                                $invest_info = M("borrow_investor")->field("id")->where("order_no='{$order_arr[0]}'")->find();
                                $invest_id = $invest_info['id'];
                                $loanno =  $LoanList['LoanNo'];
                                M('investor_detail')->where("invest_id={$invest_id} and sort_order={$sort_order}")->save(array('repay_status'=>1,'loanno'=>$loanno));
                        }else{
                            foreach($LoanList as $v){
                                $orderno = $v['OrderNo'];
                                $order_arr = explode('_', $orderno);
                                $invest_info = M("borrow_investor")->field("id")->where("order_no='{$order_arr[0]}'")->find();
                                $invest_id = $invest_info['id'];
                                $loanno =  $v['LoanNo'];
                                M('investor_detail')->where("invest_id={$invest_id} and sort_order={$sort_order}")->save(array('repay_status'=>1,'loanno'=>$loanno));    
                            }        
                        }
                        $str = 'SUCCESS';
                        notifyMsg('还款['.$batchno.']',$_POST, 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], $str);
                        echo $str;
                        //判断 当前期数是否完成，如果完成执行更新还款记录，否则不更新
                        $unapproved = M("investor_detail")->where("borrow_id={$borrow_id} and sort_order={$sort_order} and pay_status=1 and repay_status=0")->count('id');
                        
                        if($unapproved){
                            die("本期存在未还款订单");
                        }
                        /********分批执行还款**********/  
						if(borrowRepayment($borrow_id, $sort_order, $expired)){
							$str = "SUCCESS";
						} 
					}elseif(empty($_POST['Action'])){
						notifyMsg('还款冻结['.$batchno.']',$_POST, 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], 'SUCCESS');
						die("SUCCESS");
					}
				   notifyMsg('还款['.$batchno.']',$_POST, 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], $str);
					echo $str;
                }
            }
        }
        /**
        * vip 后台通知
        * 
        */
        public function vip()
        {
            import("ORG.Loan.Escrow");
            $loan = new Escrow();
            if($loan->loanVerify($_POST)){

                $loan_list = json_decode(urldecode($_POST['LoanJsonList']), true);
                isset($loan_list[0]) ? $vip_loan_info = $loan_list[0]:$vip_loan_info = $loan_list;
                $orders = $vip_loan_info['OrderNo'];
                $vip_id = substr($orders, 12);
                $vip_info = M('vip_apply')->field(true)->where("id={$vip_id}")->find(); 

                $apply['loanno']=$vip_loan_info['LoanNo'];
                if(!$vip_info['loanno'] && M('vip_apply')->where("id={$vip_id}")->save($apply)){
					memberMoneyLog($vip_info['uid'],52,-$vip_info['vip_fee'],"升级VIP冻结");
					notifyMsg('VIP申请',$_POST, 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], 'SUCCESS');
                    die("SUCCESS");
                }
				notifyMsg('VIP申请',$_POST, 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], '');
            }
        }
        
        /**
        * 审核vip 后台通知地址
        * 
        */
        public function auditVip()
        {
			import("ORG.Loan.Escrow");
            $loan = new Escrow();
            if($loan->loanAuditVerify($_POST) && $_POST['ResultCode']==88){ 
                $status =  intval($_POST['AuditType']);
                preg_match('/([0-9]+)/', $_POST['Remark1'], $id_arr);    
                $save['deal_time'] = time();
                $save['deal_user'] =  $id_arr[0];
                $save['status'] = $status;
                $save['deal_info'] =  $_POST['Remark1'];
                $apply =  M('vip_apply')->field("id, status")->where("loanno='{$_POST['LoanNoList']}'")->find();

                if(!$apply['status'] && auditVIP($apply['id'], $status, $save)){
                    echo "SUCCESS";
					notifyMsg('VIP审核',$_POST, 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], 'SUCCESS');
					exit;
                }
				notifyMsg('VIP审核',$_POST, 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], '');
            }
            
        }
		
		/**
        * 企业直投还款
        * 
        */
        public function edetail()
        {
            if($_POST['ResultCode']=='88'){ 
                import("ORG.Loan.Escrow");
                $loan = new Escrow();
                if($loan->loanVerify($_POST)){
					if(intval($_POST['Action'])==1){
						$info = explode("_",$_POST['Remark1']); 
						if(repaymentEnterprise($info[0], $info[1]) == 'TRUE'){
							notifyMsg('直投还款',$_POST, 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], 'SUCCESS');
							echo 'SUCCESS';exit;
						} 
					}else{
						notifyMsg('直投还款冻结',$_POST, 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], 'SUCCESS');
						echo 'SUCCESS';exit; 
					}
					notifyMsg('直投还款',$_POST, 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], '');
                }
            }
        }
        

		/**
        * 绑定银行卡通知地址
        * 
        */
        public function bindBank()
        {
			$msg = $_POST['Message'];
            if((intval($_POST['ResultCode'])==88 || intval($_POST['ResultCode'])==18 ) && intval($_POST['Action'])==2){ 
                import("ORG.Loan.Escrow");
                $loan = new Escrow();
                if($loan->toloanfastpayVerify($_POST)){

                    $cardNo = $loan->rsa->decrypt($_POST['CardNo']);
                    $user_info = M('escrow_account')->field('uid')->where("qdd_marked='{$_POST['MoneymoremoreId']}'")->find();
                    $data['uid'] = $user_info['uid'];
                    
                    
                    $data['bank_num'] = $cardNo;
                    $data['bank_name'] = text($_POST['BankCode']);
                    $data['bank_address'] = text($_POST['BranchBankName']);
                    $data['bank_province'] = $_POST['Province'];
                    
                    $data['bank_city'] =$_POST['City'];
                    
                    $data['add_ip'] = get_client_ip();
                    $data['add_time'] = time();
                
                    if(M('member_banks')->where("uid={$data['uid']}")->count()){
                            
                        $newid = M('member_banks')->save($data);    
                    }else{
                        $newid = M('member_banks')->add($data);
                    }
                    
                    $newid && $msg = 'SUCCESS';
                    if($newid && intval($_POST['ResultCode'])==88){
                        $msg = 'SUCCESS';
                        $add = array(    
                            'uid'=> $data['uid'],
                            'add_time'=>time(),
                            'money' => 0.01,
                            'status'=>'1',
                            'loan_no'=> 'bdyhk'.date("YmdHi"),
                        );
                        if(memberMoneyLog($data['uid'], 3, 0.01, "在线充值")){
                            $id = M("member_payonline")->add($add);
                            notifyMsg('绑定银行卡充值',$_POST, 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], $msg);    
                        }
                    }
    
                }
			    notifyMsg('绑定银行卡',$_POST, 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], $msg);
			   echo $msg;
			  
            }
        }
		public function verifyIdCard() {
			import("ORG.Loan.Escrow");
			$loan = new Escrow();
			$str='SUCCESS';
			 if ($loan->verifyNameVerify($_POST)) {
			
				$dataIdCard=  json_decode(urldecode($_POST['IdentityJsonList']),true);
				
			
				if(is_array($dataIdCard[0])){
					$dataIdCard=$dataIdCard[0];
				
					
				}
				$info = M('member_info')->where("idcard='{$dataIdCard['identificationNo']}'")->find();
				
				$uid =$info['uid'];
				if($info && $dataIdCard['state']==1 && intval($_POST['ResultCode'])==88){		
					$newxid = setMemberStatus($uid, 'id', 1, 2, '实名');
					$data['status']=1;
					$data['deal_info']='实名认证审核通过';
					$new= M("name_apply")->where("uid={$uid}")->save($data);
				
					if($newxid){
						 $str='SUCCESS';  
					}else{
						 $str='ERROR';   
					}
					notifyMsg('实名认证', $_POST, 'http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 'SUCCESS');
					echo $str;exit;
				}else{ 
					
					 $newxid = setMemberStatus($uid, 'id', 2, 2, '实名');
					 if($newxid){
						 $str='SUCCESS';  
					}else{
						 $str='ERROR';   
					}
					 $data['deal_info']='实名认证审核未通过';
					  $data['status']= 3;
					 $new= M("name_apply")->where("uid={$uid}")->save($data);
					 notifyMsg('实名认证', $_POST, 'http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 'SUCCESS');
					 echo $str;exit;
				}  
			}
			 notifyMsg('实名认证', $_POST, 'http://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 'SUCCESS');
			// echo $str;exit;

		}
    }
?>

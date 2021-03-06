<?php 
   class DebtAction extends HCommonAction{
   
     public function index(){
	      $Bconfig = require C("APP_ROOT")."Conf/borrow_config.php";
		   $borrowtype = $Bconfig['BORROW_TYPE'];
		  

	
			$search=array();
		
            $search['d.id'] = array('not in','1,3');//隐藏标
			if($search['d.status']==0){
				$search['d.status']=array("in","1,2,4");
			}
		
            D("DebtBehavior");
            $Debt = new DebtBehavior();
            $list = $Debt->listAll($search);
            $this->assign("list", $list);
			$this->assign("searchUrl",$searchUrl);
        	$this->assign("searchMap",$searchMap);
			$this->display();  
	  
	     }
	/**  
	 public function seedebt(){
	 
	      if(!$this->uid)  $this->error("请先登陆",U("/m/pub/login/")); 
            $invest_id = intval($_REQUEST['id']);
            $debt = M("invest_detb")->field("transfer_price, money")->where("invest_id={$invest_id}")->find();
            $buy_user = M("member_money")->field("account_money, back_money")->where("uid={$this->uid}")->find();
            $account =  $buy_user['account_money'] + $buy_user['back_money'];
            
            $this->assign('debt', $debt);
            $this->assign('account', $account);
            $this->assign('invest_id', $invest_id);
			$this->display();
	 
	 
	  }
	  **/

	   public function seedebt(){
	 
	    if(!$this->uid){
                $this->error('请先登录',U('m/pub/login')); 
        }
            $invest_id = intval($_REQUEST['id']);
           
            $debt = M("invest_detb")->field("transfer_price, money")->where("invest_id={$invest_id}")->find();


            $buy_user = M("member_money")->field("account_money, back_money")->where("uid={$this->uid}")->find();
            $account =  $buy_user['account_money'] + $buy_user['back_money'];
            
            $this->assign('debt', $debt);
            $this->assign('account', $account);
            $this->assign('invest_id', $invest_id);
			$this->display();
	 
	 
	  }

	  
	       /**
        * 确认购买
        * 流程： 检测购买条件
        * 购买
        */
        public function buydebt()
        {
            if(!$this->uid)  $this->error("请先登陆",U("/m/pub/login/")); 
            $invest_id = intval($_REQUEST['invest_id']);
            session("invest_id",$invest_id);
            D("DebtBehavior");
            $Debt = new DebtBehavior($this->uid);
            // 检测是否可以购买  密码是否正确，余额是否充足
            $check_result = $Debt->checkBuy($invest_id);
            if($check_result=='TRUE'){

               $info = $Debt->qddBuy($invest_id);
               
               if(is_array($info)){
                   // 发送到乾多多
                    $loanconfig = FS("Webconfig/loanconfig");
                    $buy_qdd = M("escrow_account")->field('*')->where("uid={$this->uid}")->find();
                    $invest_info = M("borrow_investor")->field("reward_money, borrow_fee, investor_uid, borrow_id")->where("id={$invest_id}")->find();
                    $sell_qdd = M("escrow_account")->field('*')->where("uid={$invest_info['investor_uid']}")->find();
                    
                    $secodary = '';
                    import("ORG.Loan.Escrow");
                    $loan = new Escrow();
                    
                    if($info['fee']){  // 借款管理费
                        $secodary[] = $loan->secondaryJsonList($loanconfig['pfmmm'], $info['fee'],'债权转让手续费', '支付平台债权转让手续费'); 
                    }
                    $secodary && $secodary = json_encode($secodary);
                    // 投标奖励
					$markNo = 'zq'.$invest_info['borrow_id'].'_'.$invest_id;
 $loanList[] = $loan->loanJsonList($buy_qdd['qdd_marked'], $sell_qdd['qdd_marked'], $info['serial'], $markNo , $info['money'], $info['money'],'债权转让',$invest_id,$secodary);
                    $loanJsonList = json_encode($loanList);
                    $returnURL = C('WEB_URL').U("/m/debt/debtReturn");
                    $notifyURL = C('WEB_URL')."/debt/notify";
                    $data =  $loan->transfer($loanJsonList, $returnURL , $notifyURL,2,1,2,1,$info['serial']);
                    $form =  $loan->setForm($data, 'transfer');
                    echo $form;
                    exit;    
               }else{
                   $this->error("数据有误");
               }
                
            }else{
                $this->error($check_result);
            }
            
        }
        /**
        * 债权转让返回地址
        * 
        */
        public function  debtReturn()
        { 
            import("ORG.Loan.Escrow");
            $loan = new Escrow();
			$pre = C('DB_PREFIX');
			$invest_id = session("invest_id");
			$field = "m.user_name,m.id uid,d.invest_id did,i.invest_id";
			$vo = M('members')->field('id,user_name,user_phone')->where("id={$this->uid}")->find();
			$vo1 = M('invest_detb d')->field($field)->join("{$pre}borrow_investor i on i.id = d.invest_id")->join("{$pre}members m on m.id = i.investor_uid")->where("d.invest_id = {$invest_id}")->find();
			//dump($vo1);
            if($loan->loanVerify($_POST)){
                $lang = L('invest');  
                $msg = $lang[$_POST['ResultCode']];
                if($_POST['ResultCode']!=88){
                    $this->error($msg, U('/m/debt/index')); 
                }else{
					SMStip("debtmoney",$vo['user_phone'],array("#USERANEM#","#DEBTUSER#"),array($vo['user_name'],$vo1['user_name']));
                    $this->success($msg, U('/m/debt/index'));
                    exit;
                }
            }
            $this->error('返回信息被篡改', U('/m/debt/index')); 
        } 
		
		/**
        * 债权转让返回地址
        * 
        */
        /*public function  smstest()
        { 
			$pre = C('DB_PREFIX');
			$invest_id = session("invest_id");
			$field = "m.user_name,m.id,d.invest_id,i.investor_uid";
			$vo = M('members')->field('id,user_name,user_phone')->where("id={$this->uid}")->find();
			$vo1 = M('invest_detb d')->field($field)->join("{$pre}borrow_investor i on i.id = d.invest_id")->join("{$pre}members m on m.id = i.investor_uid")->where("d.invest_id=7")->find();
			//echo M()->getLastSql();
			dump($vo);
			$msg = "投标成功";
			$date = date("Y-m-d,h:i:s",time());
			//SMStip("debtmoney",'13146814372',array("#USERANEM#","#DEBTUSER#"),array($vo['user_name'],$vo1['user_name']));
			SMStip("investmoney",'13146814372',array("#USERANEM#","#TIME#","#NAME#","#MONEY#","#MESSAGE#"),array($vo['user_name'],$date,$vo1['user_name'],'100',$msg));
        }*/
	  
    
   
   }
?>
<?php
    /**
    * 普通标债权转让控制器类
    * 
    * @author  zhangjili 404851763@qq.com
    * @time 2014-01-03 16:28
    * @copyright lvmaque 超级版
    * @link www.lvmaque.com
    */
    class DebtAction extends HCommonAction
    {
        
        /**
        * 债权转让列表
        * 
        */
        public function index()
        {
				   $Bconfig = require C("APP_ROOT")."Conf/borrow_config.php";
		   $borrowtype = $Bconfig['BORROW_TYPE'];
		  /// dump($borrowtype);exit;
		   $this->assign('borrowtype',$borrowtype);
			$curl = $_SERVER['REQUEST_URI'];
		$urlarr = parse_url($curl);
		parse_str($urlarr['query'],$surl);//array获取当前链接参数，2.
       $urlArr = array('status','leve');
		$leveconfig = FS("Webconfig/leveconfig");
		foreach($urlArr as $v){
			$newpars = $surl;//用新变量避免后面的连接受影响
			unset($newpars[$v],$newpars['type'],$newpars['order_sort'],$newpars['orderby']);//去掉公共参数，对掉当前参数
			foreach($newpars as $skey=>$sv){
				if($sv=="all") unset($newpars[$skey]);//去掉"全部"状态的参数,避免地址栏全满
			}
			
			$newurl = http_build_query($newpars);//生成此值的链接,生成必须是即时生成
			$searchUrl[$v]['url'] = $newurl;
			$searchUrl[$v]['cur'] = empty($_GET[$v])?"all":text($_GET[$v]);
		}
		$searchMap['status'] = array("all"=>"不限制","2"=>"进行中","1"=>"已完成","4"=>"已停售");
		$searchMap['leve'] = array("all"=>"不限制","{$leveconfig['1']['start']}-{$leveconfig['1']['end']}"=>"{$leveconfig['1']['name']}","{$leveconfig['2']['start']}-{$leveconfig['2']['end']}"=>"{$leveconfig['2']['name']}","{$leveconfig['3']['start']}-{$leveconfig['3']['end']}"=>"{$leveconfig['3']['name']}","{$leveconfig['4']['start']}-{$leveconfig['4']['end']}"=>"{$leveconfig['4']['name']}","{$leveconfig['5']['start']}-{$leveconfig['5']['end']}"=>"{$leveconfig['5']['name']}","{$leveconfig['6']['start']}-{$leveconfig['6']['end']}"=>"{$leveconfig['6']['name']}","{$leveconfig['7']['start']}-{$leveconfig['7']['end']}"=>"{$leveconfig['7']['name']}");

		$search = array();
		//搜索条件
		
		foreach($urlArr as $v){
			if($_GET[$v] && $_GET[$v]<>'all'){
				switch($v){
					case 'leve':
						$barr = explode("-",text($_GET[$v]));
						$search["m.credits"] = array("between",$barr);
					break;
					case 'status':
						$search["d.".$v] = intval($_GET[$v]);
					break;
				}
			}
		}
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
        * 购买债权提示框
        * 
        */
        public function buydebt()
        {
            if(!$this->uid)  ajaxmsg("请先登陆",0);
            $invest_id = intval($_REQUEST['invest_id']);
            !$invest_id && ajaxmsg(L('参数错误'),0);
            $debt = M("invest_detb")->field("transfer_price, money")->where("invest_id={$invest_id}")->find();
            $buy_user = M("member_money")->field("account_money, back_money")->where("uid={$this->uid}")->find();
            $account =  $buy_user['account_money'] + $buy_user['back_money'];
            
            $this->assign('debt', $debt);
            $this->assign('account', $account);
            $this->assign('invest_id', $invest_id);
            $d['content'] = $this->fetch();
            echo json_encode($d);
            
        }
        
        /**
        * 确认购买
        * 流程： 检测购买条件
        * 购买
        */
        public function buy()
        {
            if(!$this->uid)  $this->error("请先登陆"); 
            $invest_id = intval($_REQUEST['invest_id']);
            
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
                    $returnURL = C('WEB_URL').U("debtReturn");
                    $notifyURL = C('WEB_URL').U("notify");
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
            if($loan->loanVerify($_POST)){
                $lang = L('invest');  
                $msg = $lang[$_POST['ResultCode']];
                if($_POST['ResultCode']!=88){
                    $this->error($msg, U('index')); 
                }else{
                    $this->success($msg, U('index'));
                    exit;
                }
            }
            $this->error('返回信息被篡改', U('index')); 
        }
        /**
        * 债权转让
        * 
        */
        public function  notify()
        {
			
            import("ORG.Loan.Escrow");
            $loan = new Escrow();
            if($loan->loanVerify($_POST) && $_POST['ResultCode']=='88'){
				$str =''; 
				if(intval($_POST['Action'])==1){
					$lang = L('invest');  
					$msg = $lang[$_POST['ResultCode']];
				
					$loan_list = json_decode(urldecode($_POST['LoanJsonList']), true);
					isset($loan_list[0]) ? $loan_info = $loan_list[0]:$loan_info = $loan_list;
					
					$serial = $loan_info['OrderNo'];
					$buy_info = M('escrow_account')->field('uid')->where("qdd_marked='{$loan_info['LoanOutMoneymoremore']}'")->find();
					$sell_info = M('escrow_account')->field('uid')->where("qdd_marked='{$loan_info['LoanInMoneymoremore']}'")->find();
					D("DebtBehavior");
					$Debt = new DebtBehavior($buy_info['uid']);
					$detb_info = M('invest_detb')->field('invest_id')->where("serialid='{$serial}'")->find();
				
					$str =  $Debt->qddUpdate($detb_info['invest_id'], $serial, $loan_info['LoanNo'], $buy_info['uid'], $sell_info['uid']);  
				}elseif(empty($_POST['Action'])){
					notifyMsg('债权转让冻结',$_POST, 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], 'SUCCESS');
					echo  "SUCCESS";exit;
				}
				notifyMsg('债权转让',$_POST, 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], $str);
				echo $str;exit;
            }
        }
		
			public function addcomment(){
	
				$data['comment'] = text($_POST['comment']);
				if(!$this->uid)  ajaxmsg("请先登陆",0);
				if(empty($data['comment']))  ajaxmsg("留言内容不能为空",0);
				$data['type'] = 1;
				$data['add_time'] = time();
				$data['uid'] = $this->uid;
				$data['uname'] = session("u_user_name");
				$data['tid'] = intval($_POST['tid']);
				$data['name'] = M('borrow_info')->getFieldById($data['tid'],'borrow_name');
		
				$newid = M('comment')->add($data);
				//$this->display("Public:_footer");
				if($newid) ajaxmsg();
				else ajaxmsg("留言失败，请重试",0);
			}
		
    }
?>

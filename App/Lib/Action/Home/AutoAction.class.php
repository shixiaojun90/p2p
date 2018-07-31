<?php
// 本类由系统自动生成，仅供测试用途
class AutoAction extends HCommonAction {
	private $updir = NULL;
	public function _MyInit(){
		$this->updir = dirname(C("WEB_ROOT"))."/AutoDo/";
	}

	public function autorepayment(){
		//echo strtotime("2014-07-05");
		$key = $_GET['key'];
		$arg = file_get_contents($this->updir."config.txt");
		$arga = explode("|",$arg);
		$rate = intval($arga[1]);
		if($key!=$arga[2]) exit("fail|密钥错误");
        
		$loanconfig = FS("Webconfig/loanconfig");
        import("ORG.Loan.Escrow");
        $loan = new Escrow();

		$glodata = get_global_setting();
		$pre = C("DB_PREFIX");
		$strOut="<br/>-----------正在执行企业直投自动还款程序：服务器当前时间".date("Y-m-d H:i:s",time())."---------------<br/>";
		
        $borrow_info = M('transfer_borrow_info')->field("id, borrow_uid")->where("borrow_status =2")->select(); 
        if(count($borrow_info) && is_array($borrow_info)){
			
            $time = time()+86400; 
		    //$time = 1409932800;	
            $map['deadline'] = array("lt",$time);
            $map['status'] = 7;
            $map['pay_status'] = 1;
            foreach($borrow_info as $v){
                $map['borrow_id'] = $v['id'];
                $total = M("transfer_investor_detail")
                        ->field(" sum(capital) as capital, sum(interest) as interest")
                        ->where($map)
                        ->find(); 
                $accountMoney_borrower = M('member_money')->field('money_freeze,money_collect,account_money,back_money')->find($v['borrow_uid']);
                if(($accountMoney_borrower['account_money']+$accountMoney_borrower['back_money']) < ($total['capital']+$total['interest'])) {
                    $strOut .=  "帐户可用余额不足，本期还款共需".($total['capital']+$total['interest'])."元，请先充值!";
                    break;
                }
                      
                $list = M("transfer_investor_detail")
                        ->field("id,invest_id,interest,investor_uid,borrow_id,capital,interest_fee,sort_order")
                        ->where($map)
                        ->select(); 
                if(is_array($list) && count($list)){
				   $secodary = "";
                   $borrow_qdd = M('escrow_account')->field('qdd_marked')->where("uid={$v['borrow_uid']}")->find();
                   foreach($list as $detail){
                        $invest_qdd = M('escrow_account')->field('qdd_marked')->where("uid={$detail['investor_uid']}")->find();
                        if(floatval($detail['interest_fee']) > 0.00){
                            $secodary[0] = $loan->secondaryJsonList($loanconfig['pfmmm'], $detail['interest_fee'],'利息管理费');  
                        }
                        $secodary && $secodary = json_encode($secodary);
                        $money = $detail['capital']+$detail['interest'];
						$orders = 'TH'.date("YmdHi").$detail['invest_id'];
                        $loanList[] = $loan->loanJsonList($borrow_qdd['qdd_marked'], $invest_qdd['qdd_marked'], $orders, 'T_'.$v['id'], $money, '','还款',"对{$borrow_id}号企业直投".date("Y-m-d",$time)."日还款",$secodary); 
                        $secodary = "";
                       
                   }
			
                    $loanJsonList = json_encode($loanList);
                    $returnURL = C('WEB_URL').U("detailReturn");
                    $notifyURL = C('WEB_URL').U("/member/notify/edetail");
                    $data =  $loan->transfer($loanJsonList, $returnURL , $notifyURL, 2, 2, 2, 1, $v['id'].'_'.$time);
                                 
                    $result = $loan->postDate($data,$loan->url_arr['transfer']); 
					$arr_data = json_decode($result, true);
					
                    $strOut .= '第'.$v['id'].'号企业投标还款:'.$arr_data['Message'];
                }
            }
            
        }
	$data = $strOut."\r\n".date("Y-m-d H:i:s",time());//服务器时间
	echo $data;
	}
}
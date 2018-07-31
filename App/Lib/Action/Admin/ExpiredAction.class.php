<?php
// 全局设置
class ExpiredAction extends ACommonAction
{
    /**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
    public function index()
    {
		$map=array();
		$map['d.status'] = array("neq",0);
		$map['d.repayment_time'] = 0;
		$map['d.deadline'] = array("between","100000,".time());


		if($_REQUEST['uid'] && $_REQUEST['uname']){
			$map['d.borrow_uid'] = $_REQUEST['uid'];
			$search['uid'] = $map['d.borrow_uid'];	
			$search['uname'] = urldecode($_REQUEST['uname']);	
		}
		
		if($_REQUEST['uname'] && !$search['uid']){
			$map['m.user_name'] = array("like",urldecode($_REQUEST['uname'])."%");
			$search['uname'] = urldecode($_REQUEST['uname']);	
		}
		
		if($_REQUEST['status']){
			if($_REQUEST['status']==1) $map['d.substitute_money'] = array("gt",0);
			elseif($_REQUEST['status']==2) $map['d.substitute_money'] = array("elt",0);
			$search['status'] = intval($_REQUEST['status']);	
		}

		if(!empty($_REQUEST['bj']) && !empty($_REQUEST['money'])){
			$map['capital'] = array($_REQUEST['bj'],$_REQUEST['money']);
			$search['bj'] = $_REQUEST['bj'];	
			$search['money'] = $_REQUEST['money'];	
		}

		if(!empty($_REQUEST['start_time']) && !empty($_REQUEST['end_time'])){
			$timespan = strtotime(urldecode($_REQUEST['start_time'])).",".strtotime(urldecode($_REQUEST['end_time']));
			$map['d.deadline'] = array("between",$timespan);
			$search['start_time'] = urldecode($_REQUEST['start_time']);	
			$search['end_time'] = urldecode($_REQUEST['end_time']);	
		}elseif(!empty($_REQUEST['start_time'])){
			$xtime = strtotime(urldecode($_REQUEST['start_time']));
			$map['d.deadline'] = array("between",$xtime.",".time());
			$search['start_time'] = $xtime;	
		}elseif(!empty($_REQUEST['end_time'])){
			$xtime = strtotime(urldecode($_REQUEST['end_time']));
			$map['d.deadline'] = array("between",time().",".$xtime);
			$search['end_time'] = $xtime;	
		}


		//if(session('admin_is_kf')==1)	$map['m.customer_id'] = session('admin_id');
		//分页处理
		import("ORG.Util.Page");
		$buildSql = M('investor_detail d')->field("d.id")->join("{$this->pre}borrow_info b ON b.id=d.borrow_id")->join("{$this->pre}members m ON m.id=b.borrow_uid")->where($map)->group('d.sort_order,d.borrow_id')->buildSql();
		$newsql = M()->query("select count(*) as tc from {$buildSql} as t");
		$count = $newsql[0]['tc'];
		$p = new Page($count, C('ADMIN_PAGE_SIZE'));
		$page = $p->show();
		$Lsql = "{$p->firstRow},{$p->listRows}";
		//分页处理
		
		$field = "m.user_name,d.borrow_id as id,b.borrow_name,d.status,d.total,d.borrow_id,b.borrow_uid,d.sort_order,sum(d.capital) as capital,sum(d.interest) as interest,sum(d.substitute_money) as substitute_money,d.deadline,b.borrow_duration";
		$list = M('investor_detail d')->field($field)->join("{$this->pre}borrow_info b ON b.id=d.borrow_id")->join("{$this->pre}members m ON m.id=b.borrow_uid")->where($map)->group('d.sort_order,d.borrow_id')->order('d.borrow_id,d.sort_order')->limit($Lsql)->select();
		$list = $this->_listFilter($list);
		
        $this->assign("bj", array("gt"=>'大于',"eq"=>'等于',"lt"=>'小于'));
        $this->assign("status", array("1"=>'已代还',"2"=>'未代还'));
        $this->assign("list", $list);
        $this->assign("pagebar", $page);
        $this->assign("search", $search);
        $this->assign("query", http_build_query($search));
		
        $this->display();
    }


    public function member()
    {
		$map=array();
		//$map['_string'] = ' (d.repayment_time=0 AND d.deadline<'.time().' AND d.status=0)  OR ( d.substitute_time >0 ) ';
		$map['_string'] = ' (d.repayment_time=0 AND d.deadline <'.time().' AND d.status=7)';
		if($_REQUEST['uname']){
			if($_REQUEST['uid']){
				$map['d.borrow_uid'] = $_REQUEST['uid'];
				$search['uid'] = $map['d.borrow_uid'];	
				$search['uname'] = urldecode($_REQUEST['uname']);	
			}else{
				$uid = M("members")->getFieldByUserName(urldecode($_REQUEST['uname']),"id");
				$map['d.borrow_uid'] = $uid;
				$search['uid'] = $map['d.borrow_uid'];	
				$search['uname'] = urldecode($_REQUEST['uname']);	
			}
		}
		//if(session('admin_is_kf')==1)	$map['m.customer_id'] = session('admin_id');
		
		//分页处理
		import("ORG.Util.Page");
		$xcount = M('investor_detail d')->field("d.id")->where($map)->group('d.borrow_uid')->buildSql();
		$newxsql = M()->query("select count(*) as tc from {$xcount} as t");
		$count = $newxsql[0]['tc'];
		$p = new Page($count, C('ADMIN_PAGE_SIZE'));
		$page = $p->show();
		$Lsql = "{$p->firstRow},{$p->listRows}";
		//分页处理
		
		$buildSql = M('investor_detail d')->field("count(*) as num,sum(d.capital) as capital_all,borrow_uid")->where($map)->group('d.sort_order,d.borrow_id')->buildSql();
		$list = M()->query("select count(*) as tc,sum(t.capital_all) as total_expired,t.borrow_uid,t.borrow_uid as id,m.user_name  from {$buildSql} as t  left join {$this->pre}members m ON m.id=t.borrow_uid group by t.borrow_uid limit {$Lsql}");
		$list = $this->_listFilter($list);
		
        $this->assign("bj", array("gt"=>'大于',"eq"=>'等于',"lt"=>'小于'));
        $this->assign("status", array("1"=>'已代还',"2"=>'未代还'));
        $this->assign("list", $list);
        $this->assign("pagebar", $page);
        $this->assign("search", $search);
        $this->assign("query", http_build_query($search));
		
        $this->display();
    }


	public function doexpired(){
        $limit = 200;
        $post = array();
		$borrow_id = intval($_GET['id']);
		$sort_order = intval($_GET['sort_order']);
        $binfo = M("borrow_info")->field('id,batch_no')->where("id={$borrow_id}")->find();
		$vo = M('investor_detail')->where("borrow_id={$borrow_id} AND sort_order={$sort_order} AND substitute_money>0 and pay_status=1 and repay_status=1")->find();
		if(is_array($vo)) $this->error("已代还过了");

        $secodary = '';
        $loanconfig = FS("Webconfig/loanconfig");
        
        
        import("ORG.Loan.Escrow");
        $loan = new Escrow();
		$secodary = "";
         
        $detail_num = M("investor_detail")
                    ->where("borrow_id={$borrow_id} and sort_order={$sort_order} and pay_status=1 and repay_status=0")
                    ->count('id');
        $sec = ceil($detail_num/$limit);
        
        for($i=1; $i<= $sec; $i++){ 
            $repayment = $this->repaymentList($borrow_id, $sort_order, $limit);   // 还款列表
            
            if(is_array($repayment) && count($repayment)){
                foreach($repayment['list'] as $k=> $val){
                    $invest_info = M("borrow_investor")->field("order_no")->where("id={$val['invest_id']}")->find();
                    if(floatval($val['interest_fee'])){
                        $secodary[0] = $loan->secondaryJsonList($loanconfig['pfmmm'], $val['interest_fee'],'利息管理费');  
                    }
                    $secodary && $secodary = json_encode($secodary);
                    $money = $val['capital']+$val['interest'];
                    $orders = $invest_info['order_no'].'_DH'.$sort_order;
                    $loanList[] = $loan->loanJsonList($loanconfig['pfmmm'], $val['qdd_marked'], $orders,  $binfo['batch_no'], $money, '','还款',"对{$vo['batch_no']}号标第{$sort_order}期还款",$secodary); 
                    $secodary = "";
                }  
                $loanJsonList = json_encode($loanList);
                $returnURL = C('WEB_URL').U("detailReturn");
                $notifyURL = C('WEB_URL').U("home/notify/bDetail");
                $data =  $loan->transfer($loanJsonList, $returnURL , $notifyURL, 2, 2, 2, 1, $binfo['batch_no'].'_'.$sort_order);
                $result = $loan->postDate($data,$loan->url_arr['transfer']);
                $result_arr = json_decode($result, true);
                isset($result_arr[0]) ? $post = $result_arr[0]:$post = $result_arr;
                if(intval($post['ResultCode'])==88){
                   foreach($repayment['list'] as $v){
                       M('investor_detail')->where("id={$v['id']}")->save(array('repay_status'=>1));
                   } 
                }else{
                    break;
                }
            }         
            
        }
        if(intval($post['ResultCode'])==88){
            $this->success("代还款成功！",'/admin/tborrow/repayment.html');
        }else{
            if($sec){
                $this->error($post['Message'],'/admin/tborrow/repayment.html');    
            }else{
                $this->error('没有需要还款的项目','/admin/tborrow/repayment.html');
            }
        }

	}

	private function _listFilter($list){
		$row=array();
		foreach($list as $key=>$v){
			$v['breakday'] = getExpiredDays($v['deadline']);
			$v['expired_money'] = getExpiredMoney($v['breakday'],$v['capital'],$v['interest']);
			$v['call_fee'] = getExpiredCallFee($v['breakday'],$v['capital'],$v['interest']);
			$row[$key]=$v;
		}
		return $row;
	}
    
    /**
    * 计算还款金额
    * 
    * @param int $borrow_id  借款id
    * @param int $sort_order   还款期数
    * @param int $type=1 自己还款 2网站带还
    */
    private function repaymentList($borrow_id, $sort_order,$limit=200)
    {
        $pre = C('DB_PREFIX');
        $loanconfig = FS("Webconfig/loanconfig"); 
        $detail = array();
        
        $borrowDetail = D('investor_detail');
        $binfo = M("borrow_info")->field("id,borrow_uid, borrow_type, borrow_money, borrow_duration,repayment_type,has_pay,total,deadline")->find($borrow_id);
        $b_member=M('members')->field("user_name")->find($binfo['borrow_uid']);
        if( $binfo['has_pay']>=$sort_order) $this->error("本期已还过，不用再还");
        if( $binfo['has_pay'] == $binfo['total'])  $this->error("此标已经还完，不用再还");
        if( ($binfo['has_pay']+1)<$sort_order) $this->error("对不起，此借款第".($binfo['has_pay']+1)."期还未还，请先还第".($binfo['has_pay']+1)."期") ;
        if( $binfo['deadline']>time() && $type==2)  $this->error("此标还没逾期，不用代还"); 

        $vo = $borrowDetail
                    ->field('id,invest_id, investor_uid, sort_order,capital, interest, interest_fee , deadline,substitute_time')
                    ->where("borrow_id={$borrow_id} and sort_order={$sort_order} and pay_status=1 and repay_status=0")
                    ->limit($limit)
                    ->select();
        foreach($vo as $k=>$v){
            $escrow = M('escrow_account')->field('qdd_marked')->where("uid={$v['investor_uid']}")->find();
            $v['qdd_marked'] = $escrow['qdd_marked'];
            $detail['list'][$k] = $v;
        }
        return $detail;
        
    }
    
    /**
    * 还款后台通知地址
    * 
    */
    public function detailReturn()
    {  
        import("ORG.Loan.Escrow");
        $loan = new Escrow();
        $lang = L('invest'); 
        $msg = $lang[$_POST['ResultCode']];
        if($loan->loanVerify($_POST)){
            
            if(intval($_POST['ResultCode'])==88){
                $this->success($msg, U('index'));
                exit;
            }
        }
        $this->error($msg, U('index'));
    }
	
	
	
}
?>
<?php
// 本类由系统自动生成，仅供测试用途
class TRepaymentAction extends ACommonAction{
	
    public function index(){
		//for($i=0; $i<100; $i++){
			
		//	$end = strtotime(date('Y-m-d', strtotime('+'.$i.' day')).' 23:59:59');
			$end =time()+7*3600*24;	
			
			//$map['d.deadline'] = array('lt',$end);
		//	$map['d.status'] =7;
			//$arr =M()->query("SELECT SUM(d.interest) AS interest,SUM(d.capital) AS capital,d.borrow_id,b.is_jijin,b.borrow_name,m.user_name  FROM lzh_transfer_investor_detail d,lzh_members m,lzh_transfer_borrow_info b WHERE d.borrow_id=b.id and d.borrow_uid=m.id and d.deadline < {$end} AND d.status = 7  GROUP BY d.borrow_id");
		   // $this->assign('list', $arr);
        import("ORG.Util.Page");
		$map['d.deadline']=array('between',array(time(),$end));
///array("lt",$end);
		$map['d.status']  =7;
		$map['d.pay_status'] =1;
		$search=array();
		if(!empty($_REQUEST['borrow_name'])){
			$map['b.borrow_name']  =array('like',"%".text($_REQUEST['borrow_name']."%"));
			$search['borrow_name']=text($_REQUEST['borrow_name']);
		}
		if(!empty($_REQUEST['user_name'])){
			$map['m.user_name']  =array('like',"%".text($_REQUEST['user_name']."%"));
			$search['user_name']=text($_REQUEST['user_name']);
		}
        if(!empty($_REQUEST['borrow_type'])){
			if($_REQUEST['borrow_type']=='1'){
				$map['b.borrow_type']  =array('lt',6);
			    $search['borrow_type']=1;
			}else{
				$map['b.borrow_type']  =array('eq',intval($_REQUEST['borrow_type']));
			    $search['borrow_type'] =intval($_REQUEST['borrow_type']);
			}			
		}
		$field="SUM(d.interest) AS interest,SUM(d.capital) AS capital,d.borrow_id,b.borrow_name,m.user_name,b.borrow_type";
		$count = M('investor_detail d')->field($field)->join("{$this->pre}members m ON m.id=d.borrow_uid")->join("{$this->pre}borrow_info b ON d.borrow_id=b.id")->where($map)->count();
		$p = new Page($count, C('ADMIN_PAGE_SIZE'));
		$page = $p->show();
		$Lsql = "{$p->firstRow},{$p->listRows}";
        $list=M('investor_detail d')->field($field)->join("{$this->pre}members m ON m.id=d.borrow_uid")->join("{$this->pre}borrow_info b ON d.borrow_id=b.id")->where($map)->group('d.borrow_id')->select();
        $this->assign('search',$search);
		$this->assign('list',$list);
		$this->assign("pagebar", $page);
		$this->display();
	}
	public function repayment(){
		$borrow_id= intval($_GET['borrow_id']);
		$end =time()+7*3600*24;	
		$map['deadline']=array('lt',$end);
		$map['status']  = 7;
		$map['borrow_id'] =$borrow_id;
		$map['pay_status'] =1;
        import("ORG.Util.Page");
		$count = M('investor_detail')->where($map)->count();
		$p = new Page($count, C('ADMIN_PAGE_SIZE'));
		$page = $p->show();
		$Lsql = "{$p->firstRow},{$p->listRows}";
        $list=M('investor_detail')->where($map)->limit($Lsql)->select();

       
		$this->assign('list',$list);
		 $this->assign("pagebar", $page);
		$this->display();
	}
}
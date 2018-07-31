<?php
// 本类由系统自动生成，仅供测试用途
class TendoutAction extends MCommonAction {

    public function index(){
		$this->display();
    }
	 public function tindex(){
		$this->display();
    }
    public function summary(){
		$uid = $this->uid;
		$pre = C('DB_PREFIX');
		
		$this->assign("dc",M('investor_detail')->where("investor_uid = {$this->uid}")->sum('substitute_money'));
		$this->assign("mx",getMemberBorrowScan($this->uid));
		$data['html'] = $this->fetch();
		exit(json_encode($data));
    }
	
	public function tending(){
		$Bconfig = require C("APP_ROOT")."Conf/borrow_config.php";
		$borrowtype = $Bconfig['BORROW_TYPE'];
		$this->assign('borrow_type',$borrowtype);

		if($_GET['start_time']&&$_GET['end_time']){
			$_GET['start_time'] = strtotime($_GET['start_time']." 00:00:00");
			$_GET['end_time'] = strtotime($_GET['end_time']." 23:59:59");
			
			if($_GET['start_time']<$_GET['end_time']){
				$map['add_time']=array("between","{$_GET['start_time']},{$_GET['end_time']}");
				$search['start_time'] = $_GET['start_time'];
				$search['end_time'] = $_GET['end_time'];
			}
		}
		if(!empty($_GET['borrow_type'])){
				$map['borrow_type'] = intval($_GET['borrow_type']);
				$search['borrow_type'] = intval($_GET['borrow_type']);
		}

		$map['investor_uid'] = $this->uid;
		$map['status'] = 1;
		
		$list = getTenderList($map,15);

		$this->assign('search',$search);
		$this->assign("list",$list['list']);
		$this->assign("pagebar",$list['page']);
		$this->assign("total",$list['total_money']);
		$this->assign("num",$list['total_num']);
		$this->assign("query", http_build_query($search));
		$data['html'] = $this->fetch();
		exit(json_encode($data));
	}

	public function tendbacking(){
		$Bconfig = require C("APP_ROOT")."Conf/borrow_config.php";
		$borrowtype = $Bconfig['BORROW_TYPE'];
		$this->assign('borrow_type',$borrowtype);

		if($_GET['start_time']&&$_GET['end_time']){
			$_GET['start_time'] = strtotime($_GET['start_time']." 00:00:00");
			$_GET['end_time'] = strtotime($_GET['end_time']." 23:59:59");
			
			if($_GET['start_time']<$_GET['end_time']){
				$map['borrow_time']=array("between","{$_GET['start_time']},{$_GET['end_time']}");
				$search['start_time'] = $_GET['start_time'];
				$search['end_time'] = $_GET['end_time'];
			}
		}
		if(!empty($_GET['borrow_type'])){
				$map['borrow_type'] = intval($_GET['borrow_type']);
				$search['borrow_type'] = intval($_GET['borrow_type']);
		}

		$map['investor_uid'] = $this->uid;
		$map['status'] = 4;
        
        
		$list = getTenderList($map,15);
        $this->assign('search',$search);
		$this->assign("list",$list['list']);
		$this->assign("pagebar",$list['page']);
		$this->assign("total",$list['total_money']);
		$this->assign("num",$list['total_num']);
		$this->assign("query", http_build_query($search));

        $this->assign('uid', $this->uid);
		$data['html'] = $this->fetch();
		exit(json_encode($data));
	}

    public function getTendBacking()
    {
        import("ORG.Util.Page"); 
       $map = "(investor_uid={$this->uid} or debt_uid={$this->uid}) and status=4"; 
       $count = M("borrow_investor")->where($map)->count("id");
       $Page = new Page($count, 14);
       $list['list'] = M("borrow_investor i")
            ->join(C('DB_PREFIX')."borrow_info b ON i.borrow_id=b.id")
            ->join(C('DB_PREFIX')."members m ON i.investor_uid=m.id")
            ->join(C('DB_PREFIX')."invest_detb d ON i.id=d.invest_id")
            ->field("i.borrow_id, b.borrow_name, m.user_name as borrow_user, 
                     i.investor_capital, b.borrow_interest_rate, i.receive_interest, i.receive_capital,
                     b.total, b.has_pay, i.id, d.period, d.status, i.debt_uid")
            ->where("(i.investor_uid={$this->uid} or i.debt_uid={$this->uid}) and i.status=4")
            ->limit($Page->firstRow.','.$Page->listRows)
            ->select();
       $list['page']=$Page->show();
       return $list;
    }

	public function tenddone(){
		$Bconfig = require C("APP_ROOT")."Conf/borrow_config.php";
		$borrowtype = $Bconfig['BORROW_TYPE'];
		$this->assign('borrow_type',$borrowtype);

		if($_GET['start_time']&&$_GET['end_time']){
			$_GET['start_time'] = strtotime($_GET['start_time']." 00:00:00");
			$_GET['end_time'] = strtotime($_GET['end_time']." 23:59:59");
			
			if($_GET['start_time']<$_GET['end_time']){
				$map['add_time']=array("between","{$_GET['start_time']},{$_GET['end_time']}");
				$search['start_time'] = $_GET['start_time'];
				$search['end_time'] = $_GET['end_time'];
			}
		}
		if(!empty($_GET['borrow_type'])){
				$map['borrow_type'] = intval($_GET['borrow_type']);
				$search['borrow_type'] = intval($_GET['borrow_type']);
		}
		$map['investor_uid'] = $this->uid;
		$map['status'] = array("in","5,6");

		$list = getTenderList($map,15);
		 $this->assign('search',$search);
		$this->assign("list",$list['list']);
		$this->assign("pagebar",$list['page']);
		$this->assign("total",$list['total_money']);
		$this->assign("num",$list['total_num']);
		//$this->display("Public:_footer");

		$data['html'] = $this->fetch();
		exit(json_encode($data));
	}

	public function tendbreak(){
		$Bconfig = require C("APP_ROOT")."Conf/borrow_config.php";
		$borrowtype = $Bconfig['BORROW_TYPE'];
		$this->assign('borrow_type',$borrowtype);

		if($_GET['start_time']&&$_GET['end_time']){
			$_GET['start_time'] = strtotime($_GET['start_time']." 00:00:00");
			$_GET['end_time'] = strtotime($_GET['end_time']." 23:59:59");
			
			if($_GET['start_time']<$_GET['end_time']){
				$map['add_time']=array("between","{$_GET['start_time']},{$_GET['end_time']}");
				$search['start_time'] = $_GET['start_time'];
				$search['end_time'] = $_GET['end_time'];
			}
		}
		if(!empty($_GET['borrow_type'])){
				$map['borrow_type'] = intval($_GET['borrow_type']);
				$search['borrow_type'] = intval($_GET['borrow_type']);
		}
		$map['d.status'] = array('neq',0);
		$map['d.repayment_time'] = array('eq',"0");
		$map['d.deadline'] = array('lt',time());
		$map['d.investor_uid'] = $this->uid;
		
		$list = getMBreakInvestList($map,15);
		$this->assign("list",$list['list']);
		 $this->assign('search',$search);
		$this->assign("pagebar",$list['page']);
		$this->assign("total",$list['total_money']);
		$this->assign("num",$list['total_num']);
		//$this->display("Public:_footer");
	
		$data['html'] = $this->fetch();
		exit(json_encode($data));
	}

    public function tendoutdetail(){
		$pre = C('DB_PREFIX');
		$status_arr =array('还未还','已还完','已提前还款','迟还','网站代还本金','逾期还款','','等待还款');
		$investor_id = intval($_GET['id']);
		$vo = M("borrow_investor i")->field("b.borrow_name")->join("{$pre}borrow_info b ON b.id=i.borrow_id")->where("i.investor_uid={$this->uid} AND i.id={$investor_id}")->find();
		if(!is_array($vo)) $this->error("数据有误");
		$map['invest_id'] = $investor_id;
		$list = M('investor_detail')->field(true)->where($map)->select();
		$this->assign("status_arr",$status_arr);
		$this->assign("list",$list);
		$this->assign("name",$vo['borrow_name'].$investor_id);
		$this->display();
    }

///////////////////////////////////////////////////fans 2014-11-07///////////////////////////////////
	
	public function export(){
		import("ORG.Io.Excel");

		$Bconfig = require C("APP_ROOT")."Conf/borrow_config.php";
		$borrowtype = $Bconfig['BORROW_TYPE'];
		$this->assign('borrow_type',$borrowtype);

		if($_GET['start_time']&&$_GET['end_time']){
			$_GET['start_time'] = strtotime($_GET['start_time']." 00:00:00");
			$_GET['end_time'] = strtotime($_GET['end_time']." 23:59:59");
			
			if($_GET['start_time']<$_GET['end_time']){
				$map['borrow_time']=array("between","{$_GET['start_time']},{$_GET['end_time']}");
				$search['start_time'] = $_GET['start_time'];
				$search['end_time'] = $_GET['end_time'];
			}
		}
		if(!empty($_GET['borrow_type'])){
				$map['borrow_type'] = intval($_GET['borrow_type']);
				$search['borrow_type'] = intval($_GET['borrow_type']);
		}

		$map['investor_uid'] = $this->uid;
		$map['status'] = 4;
        
        
		$list = getTenderList($map,15);
		$row=array();
		$row[0]=array('借款标号','借入人','类型','投资金额','已还本息','年化利率');
		$i=1;
		foreach($list['list'] as $v){
				$row[$i]['i'] = $i;
				$row[$i]['uid'] = $v['borrow_user'];
				$row[$i]['borrow_type'] = $borrowtype[$v['borrow_type']];
				$row[$i]['investor_capital'] = $v['investor_capital'];
				$row[$i]['receive_money'] = $v['receive_capital'] + $v['receive_interest'];
				$row[$i]['borrow_interest_rate'] = $v['borrow_interest_rate'];
				$i++;
		}
		
		$xls = new Excel_XML('UTF-8', false, 'receiveMoney');
		$xls->addArray($row);
		$xls->generateXML("receiveMoney");
	}


/////////////////////////////////////////////////fans  2014-11-07//////////////////////////////////

}
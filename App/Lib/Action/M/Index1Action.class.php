<?php
    /**
    * 手机版(wap)默认首页
    * @author  sxh 
    * @time 2015-04-1
    */
    class IndexAction extends HCommonAction
    {
        public function index()
        {   $search=array();
		    $parm=array();
			$search['b.repayment_type']=array("neq",10);
			$search['borrow_type']=array('in','1,2,3,4,5');   //获取散标
            $search['b.borrow_status']=array("in","2,4,6,7");
			$parm['map'] = $search;
			$search['b.repayment_type']=array("neq",10);
			$parm['orderby']="b.borrow_status ASC,b.id DESC";
			$parm['limit'] = 5;
		    $parm['pagesize'] = 10;
			$list = getSanbiaolist($parm);
			$this->assign("list",$list);
			$this->display();
        }
        
  public function seeinvest(){
		   $id=intval($_GET['id']);
		     //判断借款是否到期 到期发站内信
		   $borr = M('borrow_info')->where("id = ".$_GET['id'])->field("borrow_duration,add_time")->select();
		   $tim = $borr[0]["add_time"]+$borr[0]["borrow_duration"]*24*60*60;
		   if("time()"<$tim ){
			   $borr = M('inner_msg')->where("title = '您的{$_GET[id]}号借款已到期'")->count();
			if($borr<=0){
				$inn = M("inner_msg"); // 实例化inner_msg对象
				$data['uid'] = $this->uid;
				$data['title'] = "您的{$_GET['id']}号借款已到期";
				$data['msg'] = "您的{$_GET['id']}号借款已到期";
				$data['send_time'] = time();
				$inn->add($data);
			        }
		     }
		 $pre = C('DB_PREFIX');
		 $Bconfig = require C("APP_ROOT")."Conf/borrow_config.php"; 
		 
		  //发表信息开始
		  $borrowinfo = M("borrow_info bi")->field('bi.*,ac.title,ac.id as aid')->join('lzh_article ac on ac.id= bi.danbao')->where('bi.id='.$id)->find();
	   if(!is_array($borrowinfo) || ($borrowinfo['borrow_status']==0 && $this->uid!=$borrowinfo['borrow_uid']) ) $this->error("数据有误");
		 $borrowinfo['biao'] = $borrowinfo['borrow_times'];
		 $borrowinfo['need'] = $borrowinfo['borrow_money'] - $borrowinfo['has_borrow'];
		 $borrowinfo['lefttime'] =$borrowinfo['collect_time'] - time();
		 $borrowinfo['progress'] = getFloatValue($borrowinfo['has_borrow']/$borrowinfo['borrow_money']*100,2);
		 $this->assign("vo",$borrowinfo);  
		 //发表信息结束
		 //会员信息start
		$memberinfo = M("members m")->field("m.id,m.customer_name,m.customer_id,m.user_name,m.reg_time,m.credits,fi.*,mi.*,mm.*")->join("{$pre}member_financial_info fi ON fi.uid = m.id")->join("{$pre}member_info mi ON mi.uid = m.id")->join("{$pre}member_money mm ON mm.uid = m.id")->where("m.id={$borrowinfo['borrow_uid']}")->find();
		$areaList = getArea();
		$memberinfo['location'] = $areaList[$memberinfo['province']].$areaList[$memberinfo['city']];
		$memberinfo['location_now'] = $areaList[$memberinfo['province_now']].$areaList[$memberinfo['city_now']];
		$memberinfo['zcze']=$memberinfo['account_money']+$memberinfo['back_money']+$memberinfo['money_collect']+$memberinfo['money_freeze'];
		$this->assign("minfo",$memberinfo);    
		 //获取借款者名称以及他的信用值 （借款者详细信息）（留着）end
		 //帐户资金情况
		$this->assign("investInfo", getMinfo($this->uid,true));  //投资者信息...........................................
		$this->assign("mainfo", getMinfo($borrowinfo['borrow_uid'],true)); //借款者信息..................................
		$this->assign("capitalinfo", getMemberBorrowScan($borrowinfo['borrow_uid'])); //借款者借款信息列表.................
		//帐户资金情况 
		$this->assign("Bconfig",$Bconfig);
		$this->display();
		
		} 
		

     /**
    * ajax 获取投资记录
    * 
    */
    public function investRecord()
    {
        $p=$_GET['p'];
	   $borrow_id=$_GET['id'];
	   $p=intval($p);
	   $borrow_id=intval($borrow_id);
	   $pagesize=5;
	   $start=0;
	   if($p>0)
	    $start=$pagesize*($p-1);
	   if(!$p)
	     $p=1;
	  $end=$p*$pagesize;
	  $count=M("borrow_investor")->where("id={$borrow_id}")->order("id")->count("id");
	  $maxp=ceil($count/$pagesize);
	   if($p>=$maxp){
	       $p="";
	      }
	  $end=$pagesize;
	  $Lsql="{$start},{$end}";
	 $list=M("borrow_investor as b")->join(C(DB_PREFIX)."members as m on  b.investor_uid = m.id")->join(C(DB_PREFIX)."borrow_info as i on  b.borrow_id = i.id")->field('i.borrow_interest_rate, i.repayment_type, b.investor_capital, b.add_time, b.is_auto, m.user_name')->where('b.borrow_id='.$borrow_id)->order('b.id')->limit($Lsql)->select();
	  $str="";
	  foreach($list as $k=>$v){
	    $type=$v['is_auto']?'自动':'手动'; 
	    $str.="<ul class='investlistcontent' ><li class='listtime timebg'>".date("Y-m-d H:i:s",$v['add_time'])." </li>";
	    $str.="<li class='listtime' >投资者：".hidecard($v['user_name'],4)."&nbsp;&nbsp;投资类型：".$type."</li>"; 
		$str.="<li class='listtime'>投资金额：".Fmoney($v['investor_capital'])."</li>";
		$str.="</ul>";
	  }
	   if(!empty($str))
	   $this->ajaxReturn($str,$p,1);
	    else
	   $this->ajaxReturn("暂时没有人投资",0,0);
        	
    }

     		
		
    }
?>

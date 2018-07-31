<?php
    /**
    * 手机版(wap)默认首页
    * @author  石新会 
    * @time 2015-04-14
    */
    class IndexAction extends HCommonAction
    {
        public function index()
        {   
			$search=array();
			$search['borrow_type']=array('in','1,2,3,4,5');   //获取散标
			$search['b.repayment_type']=array("neq",1);

			if($search['b.borrow_status']==0){
				$search['b.borrow_status']=array("in","2,4,6,7");
			}

			$search['b.repayment_type']=array("neq",1);
			if($search['b.borrow_duration'][1][0]==0){
				$search['b.repayment_type']=array("eq",1);
			}
			if(!isset($search['b.borrow_duration'])){
				$search['b.repayment_type']=array("neq",10);
			}

			$search['b.id']=array("not in",'2,3');//排除不要显示的标
			$parm['map'] = $search;
			$parm['orderby']="b.borrow_status ASC,b.id DESC";

			$list = getBorrowList($parm);
			//dump($list);exit;
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

        $endtime = strtotime("+{$borrowinfo['collect_day']} day",$borrowinfo['add_time']);
		$this->assign('endtime',$endtime);
		$this->assign('time',time());


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
	   $count = M("borrow_investor")->where('borrow_id='.$borrow_id)->count('id');
	  $maxp=ceil($count/$pagesize);
	   if($p>=$maxp){
	       $p="";
	      }
	  $end=$pagesize;
	  $Lsql="{$start},{$end}";
	 $list=M("borrow_investor as b")->join(C(DB_PREFIX)."members as m on  b.investor_uid = m.id")->join(C(DB_PREFIX)."borrow_info as i on  b.borrow_id = i.id")->field('i.borrow_interest_rate, i.repayment_type, b.investor_capital, b.add_time, b.is_auto, b.loanno, m.user_name')->where("b.borrow_id=".$borrow_id." AND b.loanno != ''")->order('b.id')->limit($Lsql)->select();
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

     
  	 
   public function buyinvest(){
              if(!$this->uid){
                   $this->error('请先登录',U('m/pub/login')); 
                }
                $borrow_id = $this->_get('bid');
				$this->assign("bid",$borrow_id);
                $borrow_info = M("borrow_info")
                    ->field('id,borrow_uid,borrow_duration, borrow_money, borrow_interest, borrow_interest_rate, has_borrow,
                             borrow_min, borrow_max, password, repayment_type')
                    ->where("id='{$borrow_id}'")
                    ->find();
                $this->assign('borrow_info', $borrow_info);   
                $user_info = M('member_money')
                                ->field("account_money+back_money as money ")
                                ->where("uid='{$this->uid}'")
                                ->find();
                $this->assign('user_info', $user_info);
                $this->assign("uid",$this->uid);
                $this->display();   
         
       }


   	public function investmoney(){

		if(!$this->uid) {
            $this->error('请先登录');
        }
		checkAuthorize($this->uid,array('invest_auth','secondary_percent','phone_investmoney')); // 这里要检测二次分配和投标授权 
        /****** 防止模拟表单提交 *********/
        $cookieKeyS = cookie(strtolower(MODULE_NAME)."-invest");
        if($cookieKeyS!=$_REQUEST['cookieKey']){
            $this->error("数据校验有误");
        }
        /****** 防止模拟表单提交 *********/
		$borrow_id = intval($_POST['borrow_id']);
		session("borrow_id",$borrow_id);
		$borrow_info = M("borrow_info")->field('id,password')->where("id='{$borrow_id}'")->find();
		if(!empty($borrow_info['password'])){
			if(empty($_POST['borrow_pass'])) $this->error("此标是定向标，必须验证投标密码");
			else if($borrow_info['password']<>md5($_POST['borrow_pass'])) $this->error("投标密码不正确");
		}

        $money = intval($_POST['invest_money']);
		session("Amount",$money);
        $borrow_id = intval($_POST['borrow_id']);
        $m = M("member_money")->field('account_money,back_money,money_collect')->find($this->uid);
        $amoney = $m['account_money']+$m['back_money'];
        $uname = session('u_user_name');
        //if($amoney<$money) $this->error("尊敬的{$uname}，您准备投标{$money}元，但您的账户可用余额为{$amoney}元，请先去充值再投标.",__APP__."/m/bank/charge");
        
        $vm = getMinfo($this->uid,'m.pin_pass,mm.account_money,mm.back_money,mm.money_collect');


        $binfo = M("borrow_info")->field('borrow_money,borrow_max,has_borrow,borrow_type,borrow_min,money_collect, borrow_uid, batch_no')->find($borrow_id);
        
        ////////////////////////////////////待收金额限制 2013-08-26  fan///////////////////
        if($binfo['money_collect']>0){
            if($m['money_collect']<$binfo['money_collect']) {
                $this->error("此标设置有投标待收金额限制，您账户里必须有足够的待收才能投此标");
            }
        }
        $need = $binfo['borrow_money'] - $binfo['has_borrow'];
        ////////////////////////////////////待收金额限制 2013-08-26  fan///////////////////
        
        //投标总数检测
        $capital = M('borrow_investor')->where("borrow_id={$borrow_id} AND investor_uid={$this->uid} and loanno<>''")->sum('investor_capital');
        if($need >= $binfo['borrow_min']*2 && ($capital+$money)>$binfo['borrow_max']&&$binfo['borrow_max']>0){
            $xtee = $binfo['borrow_max'] - $capital;
            $this->error("您已投标{$capital}元，此投上限为{$binfo['borrow_max']}元，你最多只能再投{$xtee}");
        }
        //if($binfo['has_vouch']<$binfo['borrow_money'] && $binfo['borrow_type'] == 2) $this->error("此标担保还未完成，您可以担保此标或者等担保完成再投标");
        
        $caninvest = $need - $binfo['borrow_min'];
        if( $money>$caninvest && ($need-$money)<>0 ){
            $msg = "尊敬的{$uname}，此标还差{$need}元满标,如果您投标{$money}元，将导致最后一次投标最多只能投".($need-$money)."元，小于最小投标金额{$binfo['borrow_min']}元，所以您本次可以选择<font color='#FF0000'>满标</font>或者投标金额必须<font color='#FF0000'>小于等于{$caninvest}元</font>";
            if($caninvest<$binfo['borrow_min']) $msg = "尊敬的{$uname}，此标还差{$need}元满标,如果您投标{$money}元，将导致最后一次投标最多只能投".($need-$money)."元，小于最小投标金额{$binfo['borrow_min']}元，所以您本次可以选择<font color='#FF0000'>满标</font>即投标金额必须<font color='#FF0000'>等于{$need}元</font>";

            $this->error($msg);
        }
        if(($binfo['borrow_min']-$money)>0 ){
            $this->error("尊敬的{$uname}，本标最低投标金额为{$binfo['borrow_min']}元，请重新输入投标金额");
        }
		if($money % $binfo['borrow_min']){
		    $this->error("投标金额必须为最小投资的整数倍！");
	    }
        if(($need-$money)<0 ){
            $this->error("尊敬的{$uname}，此标还差{$need}元满标,您最多只能再投{$need}元");
        }else{
            $invest_id = investMoney($this->uid,$borrow_id,$money);
        }
        $loanconfig = FS("Webconfig/loanconfig");
        if($invest_id) {
            // 发送到乾多多
            $orders = date("YmdHi").$invest_id;
            $invest_qdd = M("escrow_account")->field('*')->where("uid={$this->uid}")->find();
            $borrow_qdd = M("escrow_account")->field('*')->where("uid={$binfo['borrow_uid']}")->find();
            $invest_info = M("borrow_investor")->field("order_no, reward_money, borrow_fee")->where("id={$invest_id}")->find();
            $secodary = '';
            import("ORG.Loan.Escrow");
            $loan = new Escrow();
            if($invest_info['reward_money']>0.00){  // 投标奖励
                $secodary[] = $loan->secondaryJsonList($invest_qdd['qdd_marked'], $invest_info['reward_money'],'二次分配', '支付投标奖励'); 
            }
            if($invest_info['borrow_fee']>0.00){  // 借款管理费
                $secodary[] = $loan->secondaryJsonList($loanconfig['pfmmm'], $invest_info['borrow_fee'],'二次分配', '支付平台借款管理费'); 
            }
            //dump($secodary);exit;
            $secodary && $secodary = json_encode($secodary);
            // 投标奖励
            $loanList[] = $loan->loanJsonList($invest_qdd['qdd_marked'], $borrow_qdd['qdd_marked'], $invest_info['order_no'], $binfo['batch_no'], $money, $binfo['borrow_money'],'投标',"对{$borrow_id}号投标",$secodary);
			//print_r($loanList);exit;
            $loanJsonList = json_encode($loanList);
            $returnURL = C('WEB_URL').U("m/index/investReturn");
            $notifyURL = C('WEB_URL').U("/invest/notify");
            $data =  $loan->transfer($loanJsonList, $returnURL , $notifyURL);
            $form =  $loan->setForm($data, 'transfer');
            echo $form;
            exit; 

        }else{
            $this->error("对不起，投标失败，请重试!");
        }
	}

	/**
    * 托管投标 前台返回地址
    * 
    */
    public function authorizereturn()
    {
        $open = $_POST["AuthorizeTypeOpen"];
		$close = $_POST["AuthorizeTypeClose"];
		
		import("ORG.Loan.Escrow");
		$loan = new Escrow();
		if($loan->Authorizereturn($_POST)){
		    $msg = L($_REQUEST['ResultCode']);
			if($_REQUEST['ResultCode'] == 88  && $msg = '授权成功'){
				$this->success($msg, U('index'));
			}else{
				$this->error($msg, U('index'));
			}
		}else{
			$msg='未知错误';
		}
		
    }
	 
   /**
    * 托管投标 前台返回地址
    * 
    */
    public function investReturn()
    {	
		//$smsTxt = FS("Webconfig/smstxt");
		//$smsTxt = de_xie($smsTxt);
        import("ORG.Loan.Escrow");
        $loan = new Escrow();
        if($loan->loanVerify($_POST)){
            $lang = L('invest');  
            $msg = $lang[$_POST['ResultCode']];
            if($_POST['ResultCode']!=88){
				$this->investormessage($msg);
                $this->error($msg, U('index')); 
            }else{
				$this->investormessage($msg);
                $this->success($msg, U('index'));
            }
        }
      //  $msg = "返回信息被篡改";
       // $this->success($msg,U("index"));
    }	 
	
	public function investormessage($msg){
		$borrow_id = session("borrow_id");
		$vo = M('members')->field('id,user_name,user_phone')->where("id={$this->uid}")->find();
		$vo1 = M('borrow_info')->field('id,borrow_name')->where("id={$borrow_id}")->find();
		$date = date("Y-m-d,h:i:s",time());
		//$res = sendsms($vo['user_phone'],str_replace(array("#UserName#","#time#","#borrow_name#","#Money#","#Message#"), array($vo['user_name'],$date,$Amount,$vo1['user_name'],$msg),$smsTxt['withdraw']));
		SMStip("investmoney",$vo['user_phone'],array("#USERANEM#","#TIME#","#NAME#","#MONEY#","#MESSAGE#"),array($vo['user_name'],$date,$vo1['borrow_name'],session("Amount"),$msg));
	}
	 		
		
    }
?>

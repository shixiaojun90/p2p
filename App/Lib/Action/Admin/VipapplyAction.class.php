<?php
// 全局设置
class VipapplyAction extends ACommonAction
{
    /**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
    public function index()
    {
		$map=array();
		if($_REQUEST['uid'] && $_REQUEST['uname']){
			$map['v.uid'] = $_REQUEST['uid'];
			$search['uid'] = $map['v.uid'];	
			$search['uname'] = urldecode($_REQUEST['uname']);	
		}
		
		if($_REQUEST['uname'] && !$search['uid']){
			$map['m.user_name'] = array("like",urldecode($_REQUEST['uname'])."%");
			$search['uname'] = urldecode($_REQUEST['uname']);	
		}
		
		if($_REQUEST['realname']){
			$map['mi.real_name'] = urldecode($_REQUEST['realname']);
			$search['real_name'] = $map['mi.real_name'];	
		}
		
		if($_REQUEST['customer_id']){
			$map['v.kfid'] = $_REQUEST['customer_id'];
			$search['customer_id'] = $map['v.kfid'];	
			//$search['customer_name'] = urldecode($_REQUEST['customer_name']);	
		}
		
		if($_REQUEST['customer_name'] && !$search['customer_id']){
			$cusname = urldecode($_REQUEST['customer_name']);
			$kfid = M('ausers')->getFieldByUserName($cusname,'id');
			$map['v.kfid'] = $kfid;
			$search['customer_name'] = $cusname;	
			$search['customer_id'] = $kfid;	
		}
		
		if(isset($_REQUEST['status'])){
			$map['v.status'] = $_REQUEST['status'];
			$search['status'] = $map['v.status'];	
		}

		if(!empty($_REQUEST['start_time']) && !empty($_REQUEST['end_time'])){
			$timespan = strtotime(urldecode($_REQUEST['start_time'])).",".strtotime(urldecode($_REQUEST['end_time']));
			$map['v.add_time'] = array("between",$timespan);
			$search['start_time'] = urldecode($_REQUEST['start_time']);	
			$search['end_time'] = urldecode($_REQUEST['end_time']);	
		}elseif(!empty($_REQUEST['start_time'])){
			$xtime = strtotime(urldecode($_REQUEST['start_time']));
			$map['v.add_time'] = array("gt",$xtime);
			$search['start_time'] = $xtime;	
		}elseif(!empty($_REQUEST['end_time'])){
			$xtime = strtotime(urldecode($_REQUEST['end_time']));
			$map['v.add_time'] = array("lt",$xtime);
			$search['end_time'] = $xtime;	
		}
		//if(session('admin_is_kf')==1)	$map['v.kfid'] = session('admin_id');
		//$map['loanno']=array("neq",'');
		//分页处理
		import("ORG.Util.Page");
		$count = M('vip_apply v')->join("lzh_members m ON v.uid=m.id")->join("lzh_member_info mi ON mi.uid=m.id")->where($map)->count('m.id');
		$p = new Page($count, C('ADMIN_PAGE_SIZE'));
		$page = $p->show();
		$Lsql = "{$p->firstRow},{$p->listRows}";
		//分页处理
		
		$field= 'v.*,m.user_name as uname,mi.real_name';
		$list = M('vip_apply v')->field($field)->join("{$this->pre}members m ON m.id=v.uid")->join("{$this->pre}member_info mi ON mi.uid=v.uid")->where($map)->limit($Lsql)->order('v.id DESC')->select();
		$list = $this->_listFilter($list);

        $this->assign("status", array('待审核','已通过审核','未通过审核'));
        $this->assign("list", $list);
        $this->assign("pagebar", $page);
        $this->assign("search", $search);
        $this->display();
    }
	public function edit(){
		setBackUrl();
		$id=intval($_GET['id']);
		$aUser = get_admin_name();
		$vo = M('vip_apply')->find($id);
		if($vo['status']!=0) $this->error("审核过的不能再次审核");
		$vo['kfuname'] = $aUser[$vo['kfid']];
		$vo['uname'] = M('members')->getFieldById($vo['uid'],'user_name');
		$this->assign("vo",$vo);
		$this->display();
	}

	public function doEdit(){
		
        $model = D(ucfirst($this->getActionName()));
        $vip_id = intval($_POST['id']);
        $deal_info = '操作人员('.session('admin_id').'):'.$_POST['deal_info'];
        $status = $_POST['status'];
		$info = $model->field('deal_time, loanno, vip_fee')->where('id='.$vip_id)->find();
		
        if($info['deal_time']){
            $this->error("此申请已处理过，请不要重复提交！");   
        }
		
        if($info['vip_fee']>0 || $info['vip_fee']>0.00){
            import("ORG.Loan.Escrow");
            $loan = new Escrow();
            $returnURL = C('WEB_URL').U("auditreturn");
            $notifyURL = C('WEB_URL').U("member/notify/auditvip");
            $data = $loan->loanAudit($info['loanno'], $status, $returnURL, $notifyURL, $deal_info);
            $form =  $loan->setForm($data, 'audit');
            echo $form;
            exit; 
        }else{
            $save['deal_time'] = time();
            $save['deal_user'] =  session('admin_id');
            $save['status'] = $status;
            $save['deal_info'] =  $deal_info; 
            if(auditVIP($vip_id, $status, $save)){
                $this->success("处理完成",U("/Admin/index"));
            }else{
                $this->success("保存失败",U("/Admin/index"));
            }
        }
        
	}

	
	public function _listFilter($list){
		$row=array();
		$aUser = get_admin_name();
		foreach($list as $key=>$v){
			$v['a_kfName'] = $aUser[$v['kfid']];
			$row[$key]=$v;
		}
		return $row;
	}
	
	public function getusername(){
		$uname = M("members")->getFieldById(intval($_POST['uid']),"user_name");
		if($uname) exit(json_encode(array("uname"=>"<span style='color:green'>".$uname."</span>")));
		else exit(json_encode(array("uname"=>"<span style='color:orange'>不存在此会员</span>")));
	}
	
    public function auditreturn()
    {
       import("ORG.Loan.Escrow");
        $loan = new Escrow();
        if($loan->loanAuditVerify($_POST)){
            $lang = L('audit');
            $msg = $lang[$_POST['ResultCode']];   
        }else{
            $msg = '信息被篡改';
        }
        if(intval($_POST['ResultCode'])==88){
            $this->success($msg, U('/admin/index'));
        }else{
            $this->error($msg);
        } 
    }
}
?>
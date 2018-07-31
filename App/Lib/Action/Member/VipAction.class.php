<?php
// 本类由系统自动生成，仅供测试用途
class VipAction extends MCommonAction {

    public function index(){
		checkAuthorize($this->uid);
		$vo = M('members')->field('user_leve,time_limit')->find($this->uid);
		if($vo['user_leve']>0 && $vo['time_limit']>time()){
			$this->assign("vipTime",$vo['time_limit']);
		}
		$vx = M('vip_apply')->where("uid={$this->uid} AND status=0 AND loanno<>''")->count("id");
		if($vx>0) $this->error("您的VIP申请已在处理中，请耐心等待！", U('/member')); 
		$map['is_kf'] = 1;
		$count = M('ausers')->where($map)->count('id');
		if($count==0) unset($map['area_id']);		
		
		//分页处理
		import("ORG.Util.Page");
		$count = M('ausers')->where($map)->count('id');
		$p = new Page($count, $size);
		$page = $p->show();
		$Lsql = "{$p->firstRow},{$p->listRows}";
		//分页处理
		$list = M('ausers')->where($map)->limit($Lsql)->select();
		
		$this->assign("list",$list);
		$this->assign("count",$count);
		$this->assign("page",$page);
		//$data['html'] = $this->fetch();
		//ajaxmsg($data);
		$this->display();
    }
	
	public function getkf(){
		
		$map['is_kf'] = 1;
		$count = M('ausers')->where($map)->count('id');
		if($count==0) unset($map['area_id']);		
		
		//分页处理
		import("ORG.Util.Page");
		$count = M('ausers')->where($map)->count('id');
		$p = new Page($count, $size);
		$page = $p->show();
		$Lsql = "{$p->firstRow},{$p->listRows}";
		//分页处理
		$list = M('ausers')->where($map)->limit($Lsql)->select();
		
		$this->assign("list",$list);
		$this->assign("count",$count);
		$this->assign("page",$page);
		$data['html'] = $this->fetch();
		ajaxmsg($data);
	}

	public function apply(){
		$vx = M('vip_apply')->where("uid={$this->uid} AND status=0")->count("id");
	
		if($vx>0) $this->error("您的VIP申请已在处理中，请耐心等待！", U('/member')); 
		
		$mmdata=M('member_money')->where("uid={$this->uid}")->find();
		$datag = get_global_setting();
		$mmpd=$mmdata['account_money']+$mmdata['back_money']-$datag['fee_vip'];
		if($mmpd<0){
			$this->error("您的余额不足,请充值后再申请",U('/member')); 
		}

		$kfid = intval($_POST['kfid']);
		$des = text($_POST['des']);
		$savedata['kfid'] = $kfid;
		$savedata['uid'] = $this->uid;
		$savedata['des'] = $des;
		$savedata['add_time'] = time();
		$savedata['status'] = 0;
        $savedata['vip_fee'] = $datag['fee_vip'];
	
		$newid = M('vip_apply')->add($savedata);
		if($newid){
            if($datag['fee_vip']>0 || $datag['fee_vip']>0.00){
                import("ORG.Loan.Escrow");
                $loan = new Escrow();
                $loanconfig = FS("Webconfig/loanconfig"); 
                $pay_qdd = M("escrow_account")->field('*')->where("uid={$this->uid}")->find(); 
                $orders = date("YmdHi").$newid;  
                $loanList[] = $loan->loanJsonList($pay_qdd['qdd_marked'], $loanconfig['pfmmm'], $orders, 'VIP_'.$newid , $datag['fee_vip'], '','VIP认证',"VIP认证费用");
                $loanJsonList = json_encode($loanList);
                $returnURL = C('WEB_URL').U("vipReturn");
                $notifyURL = C('WEB_URL').U("member/notify/vip");
                $data =  $loan->transfer($loanJsonList, $returnURL , $notifyURL);
                $form =  $loan->setForm($data, 'transfer');
                echo $form;
                exit;
            }else{
                $this->success("保存成功，等待管理员审核", U('/member'));
            }
        }else{
            $this->success("保存失败，请重试", U('/member'));
        } 
             
	}
    
    public function vipReturn()
    {
        import("ORG.Loan.Escrow");
        $loan = new Escrow();
        if($loan->loanVerify($_POST)){
            $loan_list = json_decode(urldecode($_POST['LoanJsonList']), true);
            isset($loan_list[0]) ? $vip_loan_info = $loan_list[0]:$vip_loan_info = $loan_list;
            $orders = $vip_loan_info['OrderNo'];
            $vip_id = substr($orders, 12);
            $lang = L('invest');  
            $msg = $lang[$_POST['ResultCode']];
            if($_POST['ResultCode']!=88){
                M("vip_apply")->where("id={$vip_id}")->delete();
                $this->error($msg, U('index')); 
            }else{
                $this->success($msg, U('/member'));
				exit;
            }
        }
        $this->error("信息有误", U("index"));
    }
}
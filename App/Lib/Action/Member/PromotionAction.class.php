<?php
// 本类由系统自动生成，仅供测试用途
class PromotionAction extends MCommonAction {

    public function index(){
		$this->display();
    }

    public function promotion(){
		$_P_fee=get_global_setting();
		$this->assign("reward",$_P_fee);	
		$data['html'] = $this->fetch();
		exit(json_encode($data));
    }

    public function promotionlog(){
		$map['uid'] = $this->uid;
		 //分页处理
        import("ORG.Util.Page");
        $count = M('invite_awards')->where($map)->count('id');
        $p = new Page($count, $size);
        $page = $p->show();
        $Lsql = "{$p->firstRow},{$p->listRows}";
        //分页处理
  

        $list = M('invite_awards')->where($map)->order('id DESC')->limit($Lsql)->select();

		
		$totalR = M('invite_awards')->where("uid={$this->uid} and affect_money>0")->sum('affect_money');
		$this->assign("totalR",$totalR);	
        $money = M('member_money')->field("invite_money")->where("uid=".$this->uid)->find();	
		$this->assign("CR", $money['invite_money']);	
	
		$this->assign("list",$list);		
		$this->assign("pagebar",$page);		

		$data['html'] = $this->fetch();
		exit(json_encode($data));
    }

	public function promotionfriend(){
		$pre = C('DB_PREFIX');
		$uid=session('u_id');
		$field = " m.id,m.user_name,m.reg_time,sum(ia.affect_money) jiangli ";
		$field1 = " m.user_name,m.reg_time";
		$vm = M("members m")->field($field)->join(" lzh_invite_awards ia ON m.id = ia.target_uid ")->where(" m.recommend_id ={$uid} ")->group("ia.target_uid")->select();
		$vm1 = M("members m")->field($field1)->where(" m.recommend_id ={$uid}")->group("m.id")->select();
		$this->assign("vm",$vm);	
		$this->assign("vi",$vm1);
		$data['html'] = $this->fetch();
		exit(json_encode($data));
    }
}
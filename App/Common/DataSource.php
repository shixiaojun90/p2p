<?php

//获取特定栏目下文章列表
function getAreaArticleList($parm){
    if(empty($parm['type_id'])) return;
    $map['type_id'] = $parm['type_id'];
    $Osql="id DESC";
    $field="id,title,art_set,art_time,art_url,area_id";
    //查询条件 
    if($parm['pagesize']){
        //分页处理
        import("ORG.Util.Page");
        $count = M('article_area')->
where($map)->count('id');
        $p = new Page($count, $parm['pagesize']);
        $page = $p->show();
        $Lsql = "{$p->firstRow},{$p->listRows}";
        //分页处理
    }else{
        $page="";
        $Lsql="LIMIT {$parm['limit']}";
    }

    $data = M('article_area')->field($field)->where($map)->order($Osql)->limit($Lsql)->select();

    $suffix=C("URL_HTML_SUFFIX");
    $typefix = get_type_leve_area_nid($map['type_id'],$parm['area_id']);

    $typeu = implode("/",$typefix);
    foreach($data as $key=>$v){
        if($v['art_set']==1) $data[$key]['arturl'] = (stripos($v['art_url'],"http://")===false)?"http://".$v['art_url']:$v['art_url'];
        //elseif(count($typefix)==1) $data[$key]['arturl'] = 
        else $data[$key]['arturl'] = MU("Home/{$typeu}","article",array("id"=>"id-".$v['id'],"suffix"=>$suffix));
    }
    $row=array();
    $row['list'] = $data;
    $row['page'] = $page;
    
    return $row;
}

//获取下级或者同级栏目列表
function getAreaTypeList($parm){
    //if(empty($parm['type_id'])) return;
    $Osql="sort_order DESC";
    $field="id,type_name,type_set,add_time,type_url,type_nid,parent_id,area_id";
    //查询条件 
    $Lsql="{$parm['limit']}";
    $pc = D('Aacategory')->where("parent_id={$parm['type_id']} AND area_id={$parm['area_id']}")->count('id');
    if($pc>0){
        $map['is_hiden'] = 0;
        $map['parent_id'] = $parm['type_id'];
        $map['area_id'] = $parm['area_id'];
        $data = D('Aacategory')->field($field)->where($map)->order($Osql)->limit($Lsql)->select();
    }elseif(!isset($parm['notself'])){
        $map['is_hiden'] = 0;
        $map['parent_id'] = D('Aacategory')->getFieldById($parm['type_id'],'parent_id');
        $map['area_id'] = $parm['area_id'];
        $data = D('Aacategory')->field($field)->where($map)->order($Osql)->limit($Lsql)->select();
    }

    //链接处理
    $typefix = get_type_leve_area_nid($parm['type_id'],$parm['area_id']);
    $typeu = $typefix[0];
    $suffix=C("URL_HTML_SUFFIX");
    foreach($data as $key=>$v){
        if($v['type_set']==2){
            if(empty($v['type_url'])) $data[$key]['turl']="javascript:alert('请在后台添加此栏目链接');";
            else $data[$key]['turl'] = $v['type_url'];
        }
        elseif($v['parent_id']==0&&count($typefix)==1) $data[$key]['turl'] = MU("Home/{$v['type_nid']}/index","typelist",array("id"=>$v['id'],"suffix"=>$suffix));
        else $data[$key]['turl'] = MU("Home/{$typeu}/{$v['type_nid']}","typelist",array("id"=>$v['id'],"suffix"=>$suffix));
    }
    $row=array();
    $row = $data;
    
    return $row;
}



/**
* 统计借款信息（借款总额、放款笔数、已还总额、待还总额）
*     
*/
function loan_total_info()
{
    $info = array();
    $info['ordinary_total'] = M( "borrow_info" )->where( "borrow_status in(6,7,8,9)" )->sum( "borrow_money" ); //标的借款总额 
    $info['num_total'] = M( "borrow_info" )->where( "borrow_status in(6,7,8,9)" )->count( "id" ); //标的总笔数
    $info['has_also'] = M("borrow_info")->where("borrow_status in (7,8,9)")->count("borow_money");    //已还款总额
    $info['arrears'] = M("borrow_info")->where("borrow_status = 6")->count("borow_money");   //未还款总额   
    
    //企业直投汇总信息
    /*$transfer_total_money = M('transfer_borrow_investor')->where("loanno<>''")->count('investor_capital');  //总借出
    $transfer_also_money = M('transfer_borrow_investor')->where("status=2 and loanno<>''")->count('investor_capital'); //已还款
    $transfer_arrears_money = M('transfer_borrow_investor')->where("status=1 and loanno<>''")->count('investor_capital'); //未还款
    $transfer_num_total  =   M('transfer_borrow_info')->count('id'); //总数
    
    $info['ordinary_total'] += $transfer_total_money;  //借款总额
    $info['has_also'] += $transfer_also_money; //已还款总额
    $info['arrears'] += $transfer_arrears_money;  //未还款总额
    $info['num_total'] += $transfer_num_total;  //借款笔数*/
    return $info;     
}  

/**
* 获取用户投资收益汇总
* （净赚利息、投标奖励、推广奖励、线下充值奖励、收入总和、代收利息）
* 
* @param int $uid  //用户ID
*/
function get_personal_benefit($uid)
{
    $uid = intval($uid);   
    $total = array();
    //统计回款利息interest、回款总额capital、利息手续费fee
    $investor =  M("investor_detail")
                            ->field("sum(receive_capital) as capital, sum(receive_interest) as interest, sum('interest_fee') as fee")
                            ->where("investor_uid= {$uid}  and status in (1,2,3,4,5) and pay_status=1")->find(); 
    $investor['interest'] -= $investor['fee'];

    //投资奖励 推广奖励 线下充值奖励
    $log = get_money_log($uid);
    
    $benefit['ireward'] = $log['20']['money'];     // 投标奖励
    $benefit['spread_reward'] = $log['13']['money'];  //推广奖励
    $benefit['interest']  = $investor['interest']; //净赚利息
    $benefit['capital'] =  $investor['capital']; // 回款总额
    //$benefit['fee'] =  $investor['fee'] + $transfer_investor['fee'];
    $benefit['total'] = $benefit['ireward']+$benefit['spread_reward']+$benefit['interest']; 
    
    //待收利息
    $interest_collection = M('investor_detail')
							->field('sum(interest) as interest, sum(capital) as capital')
                            ->where("investor_uid={$uid} and status in (6,7) and pay_status=1")
                            ->find();
    
    $benefit['interest_collection'] =  $interest_collection['interest'];//代收利息 
	$benefit['capital_collection'] =  $interest_collection['capital'] ; // 代收本金
    $benefit['capital_interest'] = $benefit['capital_collection'] + $benefit['interest_collection']; //本息
    return $benefit; 
}

function get_money_log($uid)
{
    $uid = intval($uid); 
    $log = array();
    if($uid){
        $list = M("member_moneylog")->field('type,sum(affect_money) as money')->where("uid={$uid}")->group('type')->select();
    }else{
        $list = M("member_moneylog")->field('type,sum(affect_money) as money')->group('type')->select();
    }
    
    foreach($list as $v){
        $log[$v['type']]['money']= ($v['money']>0)?$v['money']:$v['money']*(-1);
        $log[$v['type']]['name']= $name[$v['type']];
    }
    return $log;
}
/**
*   用户借款支出汇总
* 、支付投标奖励、支付利息、提现手续费、借款管理费、会员及认证费用、逾期及催收费用 、 支出总和、待付利息总额
* 
* @param mixed $uid   //用户id
*/
function get_personal_out($uid)
{
    $log = get_money_log($uid);
	$out['bond_manage']=$log['48']['money'];//债券转让手续费
    $out['borrow_manage'] = $log['18']['money']; //借款管理费
    $out['pay_tender'] = $log['21']['money'];                   //支付投标奖励
    $out['overdue'] = $log['30']['money']+ $log['31']['money'];//逾期催收
    $out['authenticate'] = $log['14']['money']+$log['25']['money'] ;// 认证费用
    
    $interest =  M("investor_detail")
							->field('sum(receive_capital) as capital, sum(receive_interest) as interest,sum(interest_fee) as interest_fee')
                            ->where("borrow_uid={$uid} and status in (1,2,3,4,5) and pay_status=1")
							->find();                     
  
    $out['interest'] = $interest['interest'] ;   //支付利息 
	$out['capital'] = $interest['capital']; // 已还本金
    
    //待付利息\本金
    $interest_pay = M('investor_detail')
							->field('sum(interest) as interest, sum(capital) as capital')
                            ->where("borrow_uid={$uid} and status in (6,7) and pay_status=1")
                            ->find();
    $out['interest_pay'] =  $interest_pay['interest']; //待还利息
    $out['capital_pay'] = $interest_pay['capital']; //待还金额

	$czfee = M('member_payonline')->where("uid={$uid} AND status=1")->sum('fee');//在线充值手续费 
	$out['czfee'] = $czfee;
                
    $withdraw = M('member_withdraw')->field('sum(second_fee) as fee, sum(withdraw_money) as withdraw_money')->where("uid={$uid} and withdraw_status=1")->find();
    $out['withdraw_fee'] = $withdraw['fee']; //提现手续费
	$out['withdraw_money'] = $withdraw['withdraw_money'];//提现金额

    $out['total'] = $out['borrow_manage'] + $out['pay_tender']+$out['overdue']+ $out['authenticate']+$out['withdraw_fee']+$out['interest']+$out['bond_manage'];
    return $out;
    
}

/**
* 累计投资金额 \累计款金额\累计充值金额\累计提现金额\累计支付佣金
* 
* @param mixed $uid
*/
function get_personal_count($uid)
{
    $uid = intval($uid);
    $count = array();
    //*********累计投资金额************
    $p_ljtz = M('borrow_investor')->where("investor_uid={$uid} and status in (4,5,6,7) and loanno<>''")->sum('investor_capital');
    $count['ljtz'] = $p_ljtz;
    //**************
    //累计借入金额
    $p_jrje = M('borrow_info')->where("borrow_uid={$uid} and borrow_status in (6,7,8,9,10)")->sum('borrow_money');
    $count['jrje'] = $p_jrje;
    //****************
    //*****累计充值金额***
    $payonline = M('member_payonline')->where("uid={$uid} AND status=1")->sum('money');//累计充值金额 
    $count['payonline'] = $payonline;
    //*****************
    //累计提现金额
    $withdraw = M('member_withdraw')
                    ->where("uid={$uid} and withdraw_status=1")
                    ->sum('withdraw_money');
    $count['withdraw'] = $withdraw;
    //***************
    //  累计支付佣金  包括借款管理费、投资手续费
    $interest_fee = M('investor_detail')->where('investor_uid='.$uid.' and status in (1,2,3,4,5) and pay_status=1' )->sum('interest_fee'); // 普通标投资管理费（统计还款后的管理费）
    
   # $borrow_fee = M('borrow_info')->where("borrow_uid={$uid} AND borrow_status in(6,7,8,9,10)")->sum('borrow_fee');  // 借款管理费 （统计复审通过后的管理费）
    $borrow_fee = M('borrow_investor')->where("borrow_uid={$uid} AND status in(4,5,6,7)")->sum('borrow_fee');  // 借款管理费 （统计复审通过后的管理费）
    $count['commission'] = $interest_fee + $borrow_fee ; //累积支付佣金
 
    //*********************************
    return $count;
    
}

/**
* 借款参数\累计款金额\累计充值金额\累计提现金额\累计支付佣金
* 
* @param mixed $uid
*/

function get_bconf_setting($type){
    $bconf=array();
    if(!S('bconf_setting')){
        $borrowconfig=  require C("ROOT_URL")."Webconfig/borrowconfig.php";
        $bconf=$borrowconfig;
        
        S('bconf_setting',$bconf);
        S('bconf_setting',$bconf,3600*C('TTXF_TMP_HOUR')); 
    }else{
        $bconf = S('bconf_setting');
    }
    
    return $bconf;
}

/**
* 标种小图标展示
* 
* @param mixed 
*/
function getIco($map){
    $str="";
    if($map['borrow_type']==2) $str.='<img src="'.__ROOT__.'/Style/H/images/icon/d.gif" align="absmiddle">';
    elseif($map['borrow_type']==4) $str.='<img src="'.__ROOT__.'/Style/H/images/icon/jing.gif" align="absmiddle">';
    elseif($map['borrow_type']==1) $str.='<img src="'.__ROOT__.'/Style/H/images/icon/xin.gif" align="absmiddle">';
    elseif($map['borrow_type']==5) $str.='<img src="'.__ROOT__.'/Style/H/images/icon/ya.gif" align="absmiddle">';
    elseif($map['borrow_type']==6) $str.='<img src="'.__ROOT__.'/Style/H/images/icon/lbt.gif" align="absmiddle">';
    if($map['repayment_type']==1) $str.='<img src="'.__ROOT__.'/Style/H/images/icon/t.gif" align="absmiddle">';
    if(!empty($map['password'])) $str.='<img src="'.__ROOT__.'/Style/H/images/icon/passw.gif" align="absmiddle">';
    if($map['is_tuijian']==1) $str.='<img src="'.__ROOT__.'/Style/H/images/icon/tuijian.gif" align="absmiddle">';
    if($map['reward_type']>0 &&($map['reward_num']>0 || $map['reward_money']>0)) $str.='<img src="'.__ROOT__.'/Style/H/images/icon/j.gif" align="absmiddle">';
    return $str.'&nbsp;&nbsp;';
}

function ajaxmsg($msg="",$type=1,$is_end=true){
    $json['status'] = $type;
    if(is_array($msg)){
        foreach($msg as $key=>$v){
            $json[$key] = $v;
        }
    }elseif(!empty($msg)){
        $json['message'] = $msg;
    }
    if($is_end){
        echo json_encode($json);
        exit;
    }else{
        echo json_encode($json);
        exit;
    }
}

//字段文字内容隐藏处理方法
function hidecard($cardnum,$type=1,$default=""){
    if(empty($cardnum)) return $default;
    if($type==1) $cardnum = substr($cardnum,0,3).str_repeat("*",12).substr($cardnum,strlen($cardnum)-4);//身份证
    elseif($type==2) $cardnum = substr($cardnum,0,3).str_repeat("*",5).substr($cardnum,strlen($cardnum)-4);//手机号
    elseif($type==3) $cardnum = '**** **** **** '.substr($cardnum,strlen($cardnum)-4);//银行卡
    elseif($type==4) $cardnum = substr($cardnum,0,3).str_repeat("*",strlen($cardnum)-3);//用户名
    elseif($type==5) $cardnum = substr($cardnum,0,3).str_repeat("*",3).substr($cardnum,strlen($cardnum)-3);//新用户名
    return $cardnum;
}

function setmb($size)
{
    $mbsize=$size/1024/1024;
    if($mbsize>0)
    {
        list($t1,$t2)=explode(".",$mbsize);
        $mbsize=$t1.".".substr($t2,0,2);
    }
    
    if($mbsize<1){
        $kbsize=$size/1024;
        list($t1,$t2)=explode(".",$kbsize);
        $kbsize=$t1.".".substr($t2,0,2);
        return $kbsize."KB";
    }else{
        return $mbsize."MB";
    }
    
}

function getMoneyFormt($money){
    if($money>=100000 && $money<=100000000){
        $res = getFloatValue(($money/10000),2)."万";
    }else if($money>=100000000){
        $res = getFloatValue(($money/100000000),2)."亿";
    }else{
        $res = getFloatValue($money,0);
    }
    return $res;
}
function getArea(){
    $area = FS("Webconfig/area");
    if(!is_array($area)){
        $list = M("area")->getField("id,name");
        FS("area",$list,"Webconfig/");
    }else{
        return $area;    
    }
}

//信用等级图标显示
function getLeveIco($num,$type=1){
    $leveconfig = FS("Webconfig/leveconfig");
    foreach($leveconfig as $key=>$v){
        if($num>=$v['start'] && $num<=$v['end']){
            if($type==1) return "/UF/leveico/".$v['icoName'];
            elseif($type==2)  return '<img src="'.__ROOT__.'/UF/leveico/'.$v['icoName'].'" title="'.$v['name'].'"/>';
            elseif($type==3)  return '<a href="'.__APP__.'/member/credit#fragment-1">'.$v['name'].'</a>' ;//手机版使用
            else   return '<img src="'.__ROOT__.'/UF/leveico/'.$v['icoName'].'" title="'.$v['name'].'"/>';
        }
    }
}

//投资等级图标显示
function getInvestLeveIco($num,$type=1){
    $leveconfig = FS("Webconfig/leveinvestconfig");
    foreach($leveconfig as $key=>$v){
        if($num>=$v['start'] && $num<=$v['end']){
            if($type==1){ 
                return "/UF/leveico/".$v['icoName'];
            }elseif($type==2){  
                return '<a target="_blabk" href="'.__APP__.'/member/credit#fragment-2"><img src="'.__ROOT__.'/UF/leveico/'.$v['icoName'].'" title="'.$v['name'].'"/></a>';
            }elseif($type==3){  
                return $v['name'] ;//手机版使用
            }else{   
                return '<a href="'.__APP__.'/member/credit#fragment-2"><img src="'.__ROOT__.'/UF/leveico/'.$v['icoName'].'" title="'.$v['name'].'"/></a>';                                        }
        }
    }
}

function getAgeName($num){
    $ageconfig = FS("Webconfig/ageconfig");
    foreach($ageconfig as $key=>$v){
        if($num>=$v['start'] && $num<=$v['end']){
            return $v['name'];
        }
    }
}

function getLocalhost(){
    $vo['id'] = 1;
    $vo['name'] = "主站";
    $vo['domain'] = "www";
    return $vo;
}

function Fmoney($money){
    if(!is_numeric($money)) return "￥0.00";
    $sb = "";
    if($money<0){
        $sb="-";
        $money = $money*(-1);
    }
    
    $dot = explode(".",$money);
    $tmp_money = strrev_utf8($dot[0]);
    $format_money = ""; 
    for($i = 3;$i<strlen($dot[0]);$i+=3){
        $format_money .= substr($tmp_money,0,3).",";
         $tmp_money = substr($tmp_money,3);
     }
    $format_money .=$tmp_money;
    if(empty($sb)) $format_money = "￥".strrev_utf8($format_money); 
    else $format_money = "￥-".strrev_utf8($format_money); 
    if($dot[1]) return $format_money.".".$dot[1];
    else return $format_money;
}

function strrev_utf8($str) {
    return join("", array_reverse(
        preg_split("//u", $str)
    ));
}

function getInvestUrl($id){
    return __APP__."/invest/{$id}".C('URL_HTML_SUFFIX');
}
function getFundUrl($id){
    return __APP__."/fund/{$id}".C("URL_HTML_SUFFIX");
}
//获取管理员ID对应的名称,以id为键
function get_admin_name($id=false){
    $stype = "adminlist";
    $list = array();
    if(!S($stype)){
        $rule = M('ausers')->field('id,user_name')->select();
        foreach($rule as $v){
            $list[$v['id']]=$v['user_name'];
        }
        
        S($stype,$list,3600*C('HOME_CACHE_TIME')); 
        if(!$id) $row = $list;
        else $row = $list[$id];
    }else{
        $list = S($stype); 
        if($id===false) $row = $list;
        else $row = $list[$id];
    }
    return $row;
}


//添加会员操作记录
function addMsg($from,$to,$title,$msg,$type=1){
    if(empty($from) || empty($to)) return;
    $data['from_uid'] = $from;
    $data['from_uname'] = M('members')->getFieldById($from,"user_name");
    $data['to_uid'] = $to;
    $data['to_uname'] = M('members')->getFieldById($to,"user_name");
    $data['title'] = $title;
    $data['msg'] = $msg;
    $data['add_time'] = time();
    $data['is_read'] = 0;
    $data['type'] = $type;
    $newid = M('member_msg')->add($data);
    return $newid;
}

//注册专用
function rand_string_reg($len=6,$type='1',$utype='1',$addChars='') {
    $str ='';
    switch($type) {
        case 0:
            $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.$addChars;
            break;
        case 1:
            $chars= str_repeat('0123456789',3);
            break;
        case 2:
            $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ'.$addChars;
            break;
        case 3:
            $chars='abcdefghijklmnopqrstuvwxyz'.$addChars;
            break;
        default :
            // 默认去掉了容易混淆的字符oOLl和数字01，要添加请使用addChars参数
            $chars='ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789'.$addChars;
            break;
    }
    if($len>10 ) {//位数过长重复字符串一定次数
        $chars= $type==1? str_repeat($chars,$len) : str_repeat($chars,5);
    }
    $chars   =   str_shuffle($chars);
    $str     =   substr($chars,0,$len);
    session("code_temp",$str);
    session("send_time",time());
        
    return $str;
}
/**
* 设置用户认证状态 处理表为members_status
* 
* @param int $uid  // 用户id
* @param string $type  // 类型的名字 结合数据库字段
* @param int  $status // 状态0 or 1
* @param string $info //类别说明，用户保存增加积分说明
*/
function setMemberStatus($uid, $type, $status, $log_type, $log_info)
{
    $uid = intval($uid);
    $status = intval($status);
    
    $type_status = $type.'_status';
    $type_credits = $type.'_credits';
    $integration = FS('Webconfig/integration');
    $credits = $integration[$type]['fraction'];
    $nid = 0;
    $insert_info = M('members_status')->field('uid,'.$type_status.', '.$type_credits)->where("uid='".$uid."'")->find();
    if(!$insert_info['uid']){  //如果记录不存在
        if($status===1){
            $nid = M('members_status')->data(array('uid' => $uid, $type_status => $status, $type_credits => $credits))->add();  
        }else{
            $nid = M('members_status')->data(array('uid' => $uid, $type_status => $status))->add();
        } 
    }else{ //如果记录存在切积分不存在  判断状态是否为1（不给积分） 为0 （认为是第一次审核给积分）
        if($insert_info[$type_credits] or $insert_info[$type_status]===1 or $status===2){ //状态为 1 or 积分已存在 or 修改状态为2
            $nid = M('members_status')->data(array($type_status => $status))->where('uid='.$uid)->save(); 
        }else{ //状态为 1 （通过送积分）
            $nid = M('members_status')->data(array($type_status => $status, $type_credits => $credits))->where('uid='.$uid)->save();  
        }
    }

    if($status === 1 && $nid){
        memberCreditsLog($uid, $log_type, $credits, $log_info."认证通过,奖励积分{$credits}");
    }
    return $nid;
}

/**
* 过滤上传资料类型
* 
* @param array $arr  // Webconfig/integration 文件
*/
function FilterUploadType($arr)
{
    $uploadType = array();
    if(is_array($arr)){
        foreach($arr as $key=>$val){
            if(is_numeric($key)){
                $uploadType[$key] = $val;
            }
        }
    }
    return $uploadType; 
}

/**
* 获取当前用户没有上传过的上传资料类型
* 
* @param int $uid   // 用户id
*/
function get_upload_type($uid)
{
    $integration = FilterUploadType(FS("Webconfig/integration"));
    $uploadType = M('member_data_info')->field('type')->where("uid='{$uid}' and status in (0,1)")->select();
    foreach($uploadType as $row){
        unset($integration[$row['type']]);
    }
    foreach($integration as $key=>$val){
        $integration[$key] = $val['description'];
    }
    return $integration;
}


/****************************
/*  手机短信接口（整合吉信通www.winic.org、漫道短信www.zucp.net和亿美短信www.zucp.net）
/* 参数：$mob  		手机号码
/*		$content   	短信内容 
*****************************/
function sendsms($mob,$content){
$msgconfig = FS("Webconfig/msgconfig");
$type = $msgconfig['sms']['type'];// type=0 吉信通短信接口   type=1 漫道短信接口   type=2 亿美短信接口 
if($type==0){	
	$uid=$msgconfig['sms']['user1']; //分配给你的账号
	$pwd=$msgconfig['sms']['pass1']; //密码
	$mob=$mob; //发送号码用逗号分隔
	if(PATH_SEPARATOR==':'){//如果是Linux系统，则执行linux短息接口
			$url="http://service.winic.org:8009/sys_port/gateway/?id=%s&pwd=%s&to=%s&content=%s&time=";
			$id = urlencode($uid);
			$pwd = urlencode($pwd);
			$to = urlencode($mob);    
			$content = iconv("UTF-8","GB2312",$content); 
			$rurl = sprintf($url, $id, $pwd, $to, $content);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_URL,$rurl);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			if (time() > $DX_time) {
				return true;
			} else {
				$result = curl_exec($ch);
				curl_close($ch);
	            $status = substr($result, 0,3);
	            if($status==="000"){
	                return true;
	            }else{
	                return true;
	            }
        	}
       
	}else{
		$content=urlencode(auto_charset($content,"utf-8",'gbk'));  //短信内容
		$sendurl="http://service.winic.org:8009/sys_port/gateway/?";
		$sdata="id=".$uid."&pwd=".$pwd."&to=".$mob."&content=".$content."&time=";
		
		$xhr=new COM("MSXML2.XMLHTTP");   
		$xhr->open("POST",$sendurl,false);
		$xhr->setRequestHeader ("Content-type:","text/xml;charset=GB2312");
		$xhr->setRequestHeader ("Content-Type","application/x-www-form-urlencoded");
		$xhr->send($sdata);
		if (time() > $DX_time) {
			return true;
		} else {   
			$data = explode("/",$xhr->responseText);
			if($data[0]=="000") return true;
			else return true;
		}
	}
}elseif($type==1){
/////////////////////////////////////////漫道短信接口 开始///////////////////////////////////////////////////////////// 
	//如果您的系统是utf-8,请转成GB2312 后，再提交、
		$flag = 0; 
		//要post的数据 
		$argv = array( 
		 'sn'=>$msgconfig['sms']['user2'], ////替换成您自己的序列号
		 'pwd'=>$msgconfig['sms']['pass2'], //此处密码需要加密 加密方式为 md5(sn+password) 32位大写

		 'mobile'=>$mob,//手机号 多个用英文的逗号隔开 post理论没有长度限制.推荐群发一次小于等于10000个手机号
		 'content'=>iconv( "UTF-8", "gb2312//IGNORE" ,$content),//短信内容
		 'ext'=>'',		
		 'stime'=>'',//定时时间 格式为2011-6-29 11:09:21
		 'rrid'=>''
		 ); 
	//构造要post的字符串 
		foreach ($argv as $key=>$value) { 
          if ($flag!=0) { 
             $params .= "&"; 
             $flag = 1; 
          } 
         $params.= $key."="; $params.= urlencode($value); 
         $flag = 1; 
	    } 
         $length = strlen($params); 
                 //创建socket连接 
        $fp = fsockopen("sdk2.zucp.net",8060,$errno,$errstr,10) or exit($errstr."--->".$errno); 
         //构造post请求的头 
         $header = "POST /webservice.asmx/mt HTTP/1.1\r\n"; 
         $header .= "Host:sdk2.zucp.net\r\n"; 
         $header .= "Content-Type: application/x-www-form-urlencoded\r\n"; 
         $header .= "Content-Length: ".$length."\r\n"; 
         $header .= "Connection: Close\r\n\r\n"; 
         //添加post的字符串 
         $header .= $params."\r\n"; 
         //发送post的数据 
         fputs($fp,$header);
         if (time() > $DX_time) {
				return true;
		 } else { 
	         $inheader = 1; 
	          while (!feof($fp)) { 
				 $line = fgets($fp,1024); //去除请求包的头只显示页面的返回数据 
				 if ($inheader && ($line == "\n" || $line == "\r\n")) { 
						 $inheader = 0; 
				  } 
				  if ($inheader == 0) { 
						// echo $line; 
				  } 
	          } 
		       $line=str_replace("
	<string xmlns=\"http://tempuri.org/\">","",$line);
	  $line=str_replace("</string>
	","",$line);
			   $result=explode("-",$line);
			    if(count($result)>1){
					return true;
				}else{
					return true;
				}
			}
	/////////////////////////////////////////漫道短信接口 结束///////////////////////////////////////////////////////////// 
}elseif($type==2){
////////////////////////////////////////////////////////亿美短信接口 开始/////////////////////////////////////////////
		$serialNumber=$msgconfig['sms']['user3']; //分配给你的账号
		$pwd=$msgconfig['sms']['pass3']; //密码
		$mob=$mob; //发送号码用逗号分隔
		$content=urlencode(auto_charset($content,"utf-8",'gbk'));  //短信内容
            
        //$sendurl="http://sdk229ws.eucp.b2m.cn:8080/sdkproxy/sendsms.action?";
		$sendurl="http://sdkhttp.eucp.b2m.cn/sdkproxy/sendsms.action?";
        $sendurl.='cdkey='.$serialNumber.'&password='.$pwd.'&phone='.$mob.'&message='.$content.'&addserial=';
        if (time() > $DX_time) {
				return true;
		} else {
	        $d = @file_get_contents($sendurl,false);
	        
			preg_match_all('/
	<response>
	(.*)<\/response>/isU',$d,$arr);
		 
			foreach($arr[1] as $k=>$v){
				preg_match_all('#
	<error>(.*)</error>
	#isU',$v,$ar[$k]);
				$data[]=$ar[$k][1];
			}
		
			if($data[0][0]=="0"){
				return true;
			}else{
				return true;
			}
		} 
////////////////////////////////////////////////////////亿美短信接口 结束/////////////////////////////////////////////
	}else{
		return true;
	}
}

    //手机日志
    function alogsm($type,$tid,$tstatus,$deal_info='',$deal_user='' ){
        $arr = array();
        $arr['type'] = $type;
        $arr['tid'] = $tid;
        $arr['tstatus'] = $tstatus;
        $arr['deal_info'] = $deal_info;
    
        $arr['deal_user'] = session("u_id");
        $arr['deal_ip'] = get_client_ip();
        $arr['deal_time'] = time();
        //dump($arr);exit;
        $newid = M("auser_dologs")->add($arr);
        return $newid;
    }
    
function cancelDebt($borrow_id)
{
    $borrow_id = intval($borrow_id);
    $borrow_info = M("borrow_info")->field("total, has_pay")->where("id={$borrow_id}")->find();
    $result = M("borrow_investor")->field("id")->where(" borrow_id={$borrow_id}")->select();
    D("DebtBehavior");
    $Debt = new DebtBehavior(); 
    foreach($result as $k=>$v){
        $debt_info = M('invest_detb')->field('status')->where("invest_id={$v['id']}")->find();
        if($borrow_info['total'] == $borrow_info['has_pay'] && $debt_info['status'] == 1){ //已经还完更改状态
            M('invest_detb')->where("invest_id={$v['id']}")->save(array('status'=>4));
        }elseif($debt_info['status'] == 2){
            $Debt->cancelDebt($v['id'], 2);
        }              
    }
}

//提取广告
function get_ad($id){
    $stype = "home_ad".$id;
    if(!S($stype)){
        $list=array();
        /*$condition['start_time']=array("lt",time());
        $condition['end_time']=array("gt",time());*/
        $condition['id']=array('eq',$id);
        $_list = M('ad')->field('ad_type,content')->where($condition)->find();
        if($_list['ad_type']==1) $_list['content']=unserialize($_list['content']);
        $list = $_list;
        S($stype,$list,3600*C('HOME_CACHE_TIME')); 
    }else{
        $list = S($stype);
    }
    
    if($list['ad_type']==0 || !$list['content']){
        if(!$list['content']) $list['content'] = "广告未上传或已过期";
        echo $list['content'];
    }
    else return $list['content'];
}


function getVerify($uid){
    $pre = C('DB_PREFIX');
    $vo = M("members m")->field("m.id,m.user_leve,m.time_limit,m.pin_pass,s.id_status,s.phone_status,s.email_status,s.video_status,s.face_status")->join("{$pre}members_status s ON s.uid=m.id")->where("m.id={$uid}")->find();
    $str = "";
    if($vo['id_status']==1) $str.='&nbsp;<img alt="实名认证通过" src="'.__ROOT__.'/Style/H/images/icon/id.gif"/>';
    else  $str.='&nbsp;<img alt="实名认证未通过" src="'.__ROOT__.'/Style/H/images/icon/id_0.gif"/>';
    if($vo['phone_status']==1) $str.='&nbsp;<img alt="手机认证通过" src="'.__ROOT__.'/Style/H/images/icon/phone.gif"/>';
    else  $str.='&nbsp;<img alt="手机认证未通过" src="'.__ROOT__.'/Style/H/images/icon/phone_0.gif"/>';
    if($vo['email_status']==1) $str.='&nbsp;<img alt="邮件认证通过" src="'.__ROOT__.'/Style/H/images/icon/email.gif"/></br>';
    else  $str.='&nbsp;<img alt="邮件认证未通过" src="'.__ROOT__.'/Style/H/images/icon/email_0.gif"/></br>';
    if($vo['user_leve']!=0 && $vo['time_limit']>time()) $str.='&nbsp;<img alt="VIP会员" src="'.__ROOT__.'/Style/H/images/icon/vip.gif"/></a>&nbsp;';
    else  $str.='&nbsp;<img alt="不是VIP会员" src="'.__ROOT__.'/Style/H/images/icon/vip_0.gif"/>';
    if(!empty($vo['pin_pass'])) {
        $str.='<img alt="支付密码已设置" src="'.__ROOT__.'/Style/H/images/icon/mima.gif"/>&nbsp;';
    }else{  
        $str.='<img alt="支付密码未设置" src="'.__ROOT__.'/Style/H/images/icon/mima_0.gif"/>';
    }
    return $str;
} 
function getVerify_ucenter($uid){
    $pre = C('DB_PREFIX');
    $vo = M("members m")->field("m.id,m.user_leve,m.time_limit,m.pin_pass,s.id_status,s.phone_status,s.email_status,s.video_status,s.face_status")->join("{$pre}members_status s ON s.uid=m.id")->where("m.id={$uid}")->find();
    $str = "";
    if($vo['id_status']==1) $str.='<a href="'.__APP__.'/member/verify#fragment-3"><img alt="实名认证通过"   title="实名认证通过" src="'.__ROOT__.'/Style/H/images/icon/id.gif"/></a>&nbsp;';
    else  $str.='<a href="'.__APP__.'/member/verify#fragment-3"><img alt="实名认证未通过"  title="实名认证未通过" src="'.__ROOT__.'/Style/H/images/icon/id_0.gif"/></a>&nbsp;';
    if($vo['phone_status']==1) $str.='<a href="'.__APP__.'/member/verify#fragment-2"><img alt="手机认证通过"   title="手机认证通过" src="'.__ROOT__.'/Style/H/images/icon/phone.gif"/>&nbsp;';
    else  $str.='<a href="'.__APP__.'/member/verify#fragment-2"><img alt="手机认证未通过"   title="手机认证未通过" src="'.__ROOT__.'/Style/H/images/icon/phone_0.gif"/></a>&nbsp;';
    if($vo['email_status']==1) $str.='<a href="'.__APP__.'/member/verify?id=1#fragment-1"><img alt="邮件认证通过"   title="邮件认证通过" src="'.__ROOT__.'/Style/H/images/icon/email.gif"/></a>&nbsp;';
    else  $str.='<a href="'.__APP__.'/member/verify?id=1#fragment-1"><img alt="邮件认证未通过"   title="邮件认证未通过" src="'.__ROOT__.'/Style/H/images/icon/email_0.gif"/></a>&nbsp;';
    if($vo['user_leve']!=0 && $vo['time_limit']>time()) $str.='<img alt="VIP会员"   title="VIP会员" src="'.__ROOT__.'/Style/H/images/icon/vip.gif"/></a>&nbsp;';
    else  $str.='<a href="'.__APP__.'/member/vip"><img alt="不是VIP会员"   title="不是VIP会员" src="'.__ROOT__.'/Style/H/images/icon/vip_0.gif"/></a>&nbsp;';
    
    return $str;
} 


//获得时间天数
function get_times($data=array()){
    if (isset($data['time']) && $data['time']!=""){
        $time = $data['time'];//时间
    }elseif (isset($data['date']) && $data['date']!=""){
        $time = strtotime($data['date']);//日期
    }else{
        $time = time();//现在时间
    }
    if (isset($data['type']) && $data['type']!=""){ 
        $type = $data['type'];//时间转换类型，有day week month year
    }else{
        $type = "month";
    }
    if (isset($data['num']) && $data['num']!=""){ 
        $num = $data['num'];
    }else{
        $num = 1;
    }
    
    if ($type=="month"){
        $month = date("m",$time);
        $year = date("Y",$time);
        $_result = strtotime("$num month",$time);
        $_month = (int)date("m",$_result);
        if ($month+$num>12){
            $_num = $month+$num-12;
            $year = $year+1;
        }else{
            $_num = $month+$num;
        }
        
        if ($_num!=$_month){
        
            $_result = strtotime("-1 day",strtotime("{$year}-{$_month}-01"));
        }
    }else{
        $_result = strtotime("$num $type",$time);
    }
    if (isset($data['format']) && $data['format']!=""){ 
        return date($data['format'],$_result);
    }else{
        return $_result;
    }

}


//企业直投自动投标设置
function autotInvest($borrow_id){
	$datag = get_global_setting();
    $binfo = M("transfer_borrow_info")->field('borrow_money,borrow_uid,per_transfer,borrow_type,borrow_interest_rate,borrow_duration,progress,transfer_total,transfer_out')->find($borrow_id);

    $map['a.is_use'] = 1;
    $map['a.borrow_type'] = 3;
    $map['a.end_time'] = array("gt",time());
    $autolist = M("auto_borrow a")
    ->join(C('DB_PREFIX')."member_money m ON a.uid=m.uid")
    ->field("a.*, m.account_money+m.back_money as money")
    ->where($map)
    ->order("a.invest_time asc")
    ->select();        
    $needMoney=$binfo['borrow_money'] - ($binfo['borrow_money']*$binfo['progress']/100);
    $num_max4 = $binfo['transfer_total']*floatval($datag['pro_auto'])/100;//不能超过百分比
    foreach($autolist as $key=>$v){
        if(!$needMoney) break;
        if( $v['uid']==$binfo['borrow_uid']) continue;
        if($v['money']<=0||$v['money']==NULL){
            continue;
        }
        $num_max1 = floor(($v['money']-$v['account_money'])/$binfo['per_transfer']);//余额最多可购买份数
        $num_max2 = floor($v['invest_money']/$binfo['per_transfer']);//最大投资总额可购买份数
        $num_max3 = $needMoney/$binfo['per_transfer'];//$binfo['transfer_total'] - $binfo['transfer_out'];//剩余多少份
        $num_min = ceil($v['min_invest']/$binfo['per_transfer']);//最少要买多少份
        if($num_max1 > $num_max2){
            $num = $num_max2;
        }else{
            $num = $num_max1;
        }
        if($num > $num_max3){
            $num = $num_max3;
        }
        if($num > $num_max4){
            $num = $num_max4;
        }
        if($v['interest_rate'] > 0){
            if(!($binfo['borrow_interest_rate']>=$v['interest_rate'])){//利率范围
                continue;    
            }
        }
        if($v['duration_from'] > 0 && $v['duration_to'] > 0 && $v['duration_from'] <= $v['duration_to']){//借款期限范围
            if(!(($binfo['borrow_duration']>=$v['duration_from'])&&($binfo['borrow_duration']<=$v['duration_to']))){
                continue;
            }
        }
        if(!($num>=$num_min)){//
            continue;
        }
        if(!(($v['money']-$v['account_money'])>=($num*$binfo['per_transfer']))){//余额限制
            continue;
        }
        if($needMoney <= 0){//可投金额必须大于0
            continue;
        }
        
        $invest_id = TinvestMoney($v['uid'],$borrow_id,$num,$binfo['borrow_duration'],1);//
        if($invest_id){
            $loanconfig = FS("Webconfig/loanconfig");
            // 发送到乾多多
            $invest_qdd = M("escrow_account")->field('*')->where("uid={$v['uid']}")->find();
            $borrow_qdd = M("escrow_account")->field('*')->where("uid={$binfo['borrow_uid']}")->find();
            $invest_info = M("transfer_borrow_investor")->field("reward_money,borrow_fee")->where("id={$invest_id}")->find();
            $secodary = '';
            $loanList = '';
            import("ORG.Loan.Escrow");
            $loan = new Escrow();
            if($invest_info['reward_money']>0.00){  // 投标奖励
                $secodary[] = $loan->secondaryJsonList($invest_qdd['qdd_marked'], $invest_info['reward_money'],'二次分配', '投标奖励'); 
            }
            if($invest_info['borrow_fee']>0.00){  // 借款管理费
                $secodary[] = $loan->secondaryJsonList($loanconfig['pfmmm'], $invest_info['borrow_fee'],'二次分配', '借款管理费'); 
            }
           
            $secodary && $secodary = json_encode($secodary);
            // 投标奖励
            $orders = 'T'.date("YmdHi").$invest_id;  
            $loanList = $loan->loanJsonList($invest_qdd['qdd_marked'], $borrow_qdd['qdd_marked'], $orders, 'T_'.$borrow_id, $num*$binfo['per_transfer'], $binfo['borrow_money'],'投标',"对{$borrow_id}号企业直投（自动）投标",$secodary);
            
            $loanJsonList = json_encode($loanList);
            $returnURL = C('WEB_URL').U("/tinvest/investReturn");
            $notifyURL = C('WEB_URL').U("/tinvest/notify");
            $data =  $loan->transfer($loanJsonList, $returnURL , $notifyURL,1,2,2,1);
            
            $result = $loan->postDate($data,$loan->url_arr['transfer']);
            $post = (array)json_decode($result);
            
            if($loan->loanVerify($post)){
               if($post['ResultCode']=='88'){        
                    $needMoney = $needMoney - $num*$binfo['per_transfer'];   // 减去剩余已投金额
                    $num_max4 = $num_max4 - $num*$binfo['per_transfer'];
                    MTip('chk27',$v['uid'],$borrow_id,$v['id']);//sss
                    M('auto_borrow')->where('id = '.$v['id'])->save(array("invest_time"=>time()));
               }else{ 
                    M('transfer_investor_detail')->where("invest_id={$invest_id} and loanno=''")->delete();
                    M('transfer_borrow_investor')->where("id={$invest_id} and pay_status=0")->delete();
               }
               
            }
        } 

    }
    return true;
}

//普通标自动投标设置
function autoInvest($borrow_id){
	$datag = get_global_setting();
    $binfo = M("borrow_info")->field('borrow_uid,borrow_money,borrow_type,repayment_type,borrow_interest_rate,borrow_duration,has_borrow,borrow_max,borrow_min,can_auto,batch_no')->find($borrow_id);
	if($binfo['can_auto']=='0'){
        return;
    }
    $map['a.is_use'] = 1;
    //$map['a.borrow_type'] = $binfo['borrow_type'];
	if($binfo['borrow_type']<6){
		$map['a.borrow_type']=1;
	}elseif($binfo['borrow_type']=='6'){
		$map['a.borrow_type']=6;
	}else{
		$map['a.borrow_type']=7;
	}
    $map['a.end_time'] = array("gt",time());
    $autolist = M("auto_borrow a")
      ->join(C('DB_PREFIX')."member_money m ON a.uid=m.uid")
      ->field("a.*, m.account_money+m.back_money as money")
      ->where($map)
      ->order("a.invest_time asc")
      ->select();
    $needMoney=$binfo['borrow_money'] - $binfo['has_borrow'];
    $num_max4 = $binfo['borrow_money']*floatval($datag['pro_auto'])/100;//不能超过百分比
	//dump($autolist);exit;
    foreach($autolist as $key=>$v){
        if(!$needMoney) break;
        if( $v['uid']==$binfo['borrow_uid']) continue;
        $num_max1 = intval($v['money']-$v['account_money']);//账户余额-设置的最少剩余金额，即可用的投资金额数
		if($num_max1<=0) continue;     //账户余额不足
		//判断标的最大投资金额
			$maxInvestMoney=  ($v['invest_money'] > $binfo['borrow_max'] && $binfo['borrow_max']>0)? $binfo['borrow_max']: $v['invest_money'] ;
		// 账户可用余额限制	
			$investMoney= ($num_max1 >$maxInvestMoney && $maxInvestMoney>0)? $maxInvestMoney : $num_max1;  

        if($investMoney > $needMoney){
              $investMoney = $needMoney;
        }else if($binfo['borrow_min']){ //设置了最小投标    如果直接满标则不考虑最小投标
          if($investMoney < $binfo['borrow_min']){ // 小于最低投标
                continue;//不符合最低投资金额
          }elseif(($needMoney-$investMoney)>0 && ($needMoney-$investMoney) < $binfo['borrow_min']){ // 剩余金额小于最小投标金额 
              if(($investMoney-$binfo['borrow_min']) >= $binfo['borrow_min']){  // 投资金额- 最小投资金额 大于最小投资金额
                    $investMoney = $investMoney-$binfo['borrow_min'];  // 投资 = 投资-最小投资（保证下次投资金额大于最小投资金额）
              }else{
                    continue;
              }
          }
        }

        if($investMoney > $num_max4){   //投资金额不能大于借款金额的比例
            $investMoney = $num_max4;
        }
        //if($investMoney%$binfo['borrow_min']!=0 && $investMoney%$binfo['borrow_min']>0){//如果当前可投金额不是最小投资金额的整数倍
         // $investMoney = $binfo['borrow_min']*floor($investMoney%$binfo['borrow_min']);
        //  $investMoney = $binfo['borrow_min']*intval($investMoney%$binfo['borrow_min']);
        //}
		//如果当前可投金额不是最小投资金额的整数倍
		$num = intval($investMoney/$binfo['borrow_min']);
		if($num>0){
			$investMoney = $binfo['borrow_min']*$num;
		}
		
        if($v['interest_rate'] > 0){
          if(!($binfo['borrow_interest_rate']>=$v['interest_rate'])){//利率范围
          continue;    
          }
        }
		//`mxl:autoday`
		$MAXMOONS = 180;
		$v['is_auto_day'] = ($v['duration_to'] >= $MAXMOONS) ? 1 : 0;
		$v['duration_to'] = $v['duration_to'] % $MAXMOONS;
		if ($binfo['repayment_type'] == 1){
			if ($v['is_auto_day'] == false) continue;
		}
		else{
			if($v['duration_from'] > 0 && $v['duration_to'] > 0 && $v['duration_from'] <= $v['duration_to']){
				if(!(($binfo['borrow_duration']>=$v['duration_from']) && ($binfo['borrow_duration']<=$v['duration_to']))){
					continue;
				}
			}
		}
		//`mxl:autoday`
        /* if($v['duration_from'] > 0 && $v['duration_to'] > 0 && $v['duration_from'] <= $v['duration_to']){//借款期限范围
          if(!(($binfo['borrow_duration']>=$v['duration_from'])&&($binfo['borrow_duration']<=$v['duration_to']))){
          continue;
          }
        } */
        if(!($investMoney >= $v['min_invest'])){//
        continue;
        }
        if(!($v['money']-$v['account_money']>=$investMoney)){//余额限制
        continue;
        }
        if($needMoney <= 0){//可投金额必须大于0
        continue;
        }   
        $invest_id = investMoney($v['uid'],$borrow_id,$investMoney,1);;
        if($invest_id){
            $loanconfig = FS("Webconfig/loanconfig");
            // 发送到乾多多
            $invest_qdd = M("escrow_account")->field('*')->where("uid={$v['uid']}")->find();
            $borrow_qdd = M("escrow_account")->field('*')->where("uid={$binfo['borrow_uid']}")->find();
            $invest_info = M("borrow_investor")->field("order_no,reward_money, borrow_fee")->where("id={$invest_id}")->find();
            $secodary = '';
            $loanList = '';
            import("ORG.Loan.Escrow");
            $loan = new Escrow();
            if($invest_info['reward_money']>0.00){  // 投标奖励
                $secodary[] = $loan->secondaryJsonList($invest_qdd['qdd_marked'], $invest_info['reward_money'],'二次分配', '支付投标奖励'); 
            }
            if($invest_info['borrow_fee']>0.00){  // 借款管理费
                $secodary[] = $loan->secondaryJsonList($loanconfig['pfmmm'], $invest_info['borrow_fee'],'二次分配', '支付平台借款管理费'); 
            }
           
            $secodary && $secodary = json_encode($secodary);
            // 投标奖励
            $orders = date("YmdHi").$invest_id;
            $loanList[] = $loan->loanJsonList($invest_qdd['qdd_marked'], $borrow_qdd['qdd_marked'],$invest_info['order_no'], $binfo['batch_no'], $investMoney, $binfo['borrow_money'],'投标',"对{$borrow_id}号（自动）投标",$secodary);
            
            $loanJsonList = json_encode($loanList);
            $returnURL = C('WEB_URL').U("/invest/investReturn");
            $notifyURL = C('WEB_URL').U("/invest/notify");
            $data =  $loan->transfer($loanJsonList, $returnURL , $notifyURL,1,2);
            
            $result = $loan->postDate($data,$loan->url_arr['transfer']);
            $post = (array)json_decode($result);
            
            if($loan->loanVerify($post)){
               if($post['ResultCode']=='88'){
                    $needMoney = $needMoney - $investMoney;   // 减去剩余已投金额
                    $num_max4 = $num_max4 - $investMoney;
                    MTip('chk27',$v['uid'],$borrow_id,$v['id']);//sss
                    M('auto_borrow')->where('id = '.$v['id'])->save(array("invest_time"=>time()));
               }else{ 
                    M('investor_detail')->where("invest_id={$invest_id} and loanno=''")->delete();
                    M('borrow_investor')->where("id={$invest_id} and pay_status=0")->delete();
               }
               
            }
        }
    }
    
    return true;
}


/**
* 获取投标的乾多多序列号
* @param intval $borrow_id  借款id
*/
function getInvestLoanNo($borrow_id)
{
    $limit = 200;
    
    $loan_no_list = '';
    $list = M("borrow_investor")->field('loanno')->where("borrow_id={$borrow_id} and loanno<>'' and audit_status=0")->limit($limit)->select();
    if(count($list)){
        foreach($list as $v){
            $loan_no_list .=  $v['loanno'].',';
        }
        $loan_no_list = substr($loan_no_list, 0, -1);
    }
    return $loan_no_list;
}
/**
* 根据乾多多流水号获取标号
* @param string $InvestLoanNo  乾多多流水号
*/
function loanBorrowId($InvestLoanNo)
{
    $loan_no = explode(',', $InvestLoanNo);
    $borrow = M('borrow_investor')->field('borrow_id')->where("loanno='{$loan_no[0]}'")->find();
    if($borrow['borrow_id']){
        return $borrow['borrow_id'];
    }else{
        return 0;
    }
}

/**
* 乾多多银行参数
* 
* @param mixed $id
*/


function get_bank_setting(){
    $bankconf=array();
    if(!S('bank_setting')){
        $bankconf=  require C("ROOT_URL")."Webconfig/bank.php";
        S('bank_setting',$bankconf);
        S('bank_setting',$bankconf,3600*C('TTXF_TMP_HOUR')); 
    }else{
        $bankconf = S('bank_setting');
    }
    
    return $bankconf;
}
/**
**检测是否开启授权
**/
function checkAuthorize($uid,$data)
{
    $authorize=A('member/authorize');
        $row=M("escrow_account")->where("uid=".$uid)->find();
        if(!is_array($row)){
			if(!empty($data[2])){
				echo "<script> 
						alert('绑定托管账号后在操作');
						window.location.href='/m/user/';
					</script>";
			}else{
				 echo "<script> 
						alert('您还未绑定托管账号后在操作');
						window.location.href='/member/bank#fragment-1';
					</script>";
			}
        }
        
        if(is_array($row)){
            foreach($data as $key=>$v){
                //dump($row[$v]);
                if($row[$v]!=1){
                    switch($v){
						case 'invest_auth':
							$auth[]=1;
							break;
						case 'repayment':
							$auth[]=2;
							break;
						case 'secondary_percent':
							$auth[]=3;
							break;
                    }
                 }
             }
        }
            if($auth==null){
                return false;
            }
            //session('authorize_jump', $_SERVER['REQUEST_URI']);
			if(!empty($data[2])){
				session('authorize_jump', U("m/index"));
			}else{
				session('authorize_jump', U("/index"));
			}
            //session('authorize_jump', U("/index"));
            echo $authorize->authorize($auth,$data[2]);
            exit;
       // }
}

/**
* 审核vip会员认证
* 
* @param int $vip_id
* @param int $status
* @param mixed $data
*/
function auditVIP($vip_id, $status, $data)
{
    $status = intval($status);
    $vip_id = intval($vip_id);
    if ($result = M('vip_apply')->where("id='{$vip_id}'")->save($data)) { //保存成功
                      
        $vx = M('vip_apply')->field("uid,kfid")->where("id={$vip_id}")->find();
        $uid = $vx['uid'];
        $datag = get_global_setting();
        $aUser = get_admin_name();
        if($status==1){
            $result = memberMoneyLog($uid,14,-$datag['fee_vip'],"升级VIP成功");
            $newx = setMemberStatus($uid, 'vip', $status, 13, 'vip');  
            
            memberLimitLog($uid,11,$datag['limit_vip'],"VIP审核通过");
            addInnerMsg($uid,"您的VIP申请审核已通过","您的VIP申请审核已通过");
            $vo = M("members")->field("user_phone,user_name,recommend_id")->where("id = {$uid}")->find();
            
            SMStip("vip",$vo['user_phone'],array("#USERANEM#"),array($vo['user_name']));
       
                $vmo = M('members')->field("user_leve,time_limit")->find($vx['uid']);
                $savex['customer_id'] = $vx['kfid'];
                $savex['customer_name'] = $aUser[$vx['kfid']];
                $savex['user_leve'] = 1;
                if($vmo['time_limit']>time()) $savex['time_limit'] = strtotime("+1 year",$vmo['time_limit']);
                else $savex['time_limit'] = strtotime("+1 year");
                M('members')->where("id={$uid}")->save($savex);
            
            alogs("Vipapply",0,1,'VIP申请审核通过！');//管理员操作日志
        }else{
            memberMoneyLog($uid,53,$datag['fee_vip'],"升级VIP未通过,解冻资金");
            addInnerMsg($uid,"您的VIP申请审核未通过","您的VIP申请审核未通过");
            alogs("Vipapply",0,0,'VIP申请审核未通过！');//管理员操作日志
        }
        return true;
    } 
    return false;
}

/**
*  生成订单号
**/
function build_order_no()
{
    return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
}

/**
* 更新邀请奖励金额
* 
* @param mixed $uid  //用户id
* @param mixed $money   // 变动金额 如减少金额则为负数
* @param mixed $info   // 相关信息
*/
function updateInvite($uid, $invite_money, $info, $target_uid=0, $invest_money=0.00)
{
    $uid = intval($uid);
    $invite_money =  floatval($invite_money);
    $info = text($info);
	$target_uid = intval($target_uid);
	$invest_money = floatval($invest_money);
    $MemberMoney =M('member_money');
	if($MemberMoney->where('uid='.$uid)->count('uid')){
		$money_info = $MemberMoney->field("invite_money")->where('uid='.$uid)->find();
	}else{
		$money_info['invite_money'] = 0.00;
		$MemberMoney->add(array('uid'=>$uid));
	}
    $money  =  $money_info['invite_money']+ $invite_money; 
	$invite_arr = array(
					'uid'=>$uid,
					'affect_money'=>$invite_money, 
					'info'=>$info,
					'addtime'=>time(),
					'target_uid'=>$target_uid,
					'invest_money'=>$invest_money
		     );
    if($invite_money){
        $MemberMoney->startTrans(); 
        $money_id = $MemberMoney->where('uid='.$uid)->save(array('invite_money'=>$money));
        $invite_id = M('invite_awards')->add($invite_arr);
		
        if($money_id && $invite_id){
            $MemberMoney->commit(); 
            return true;
        }else{
            $MemberMoney->rollback();
			
        }  
    }
    return false;
}

/**
* 通知数据保存
* 
* @param mixed $type
* @param mixed $data
* @param mixed $url
* @param mixed $status
*/
function notifyMsg($type, $data, $url, $status)
{
	$data = json_encode($data);
    $data_md5 = md5($data);
    $notify = M("notify")->field('id, num')->where("data_md5='{$data_md5}'")->find();
    $arr['last_time'] = time();
    $arr['status'] = text($status);
    if($notify['id']){  // 更新 状态、次数、最后时间
        $arr['num'] = $notify['num']+1;
        M('notify')->where("id=".$notify['id'])->save($arr);
    }else{
        $arr['data_md5'] = $data_md5;
        $arr['notify_url'] = $url;
        $arr['data'] = $data;
        $arr['addtime'] = time();
        $arr['num'] = 1;
        $arr['type'] = $type;
        M('notify')->add($arr);
    }
}

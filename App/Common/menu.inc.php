<?php
/*array(菜单名，菜单url参数，是否显示)*/
$i=0;
$j=0;
$menu_left =  array();
$menu_left[$i]=array('全局','#',1);
$menu_left[$i]['low_title'][$i."-".$j] = array('全局设置','#',1);
$menu_left[$i][$i."-".$j][] = array('欢迎页',U('/admin/welcome/index'),1);
$menu_left[$i][$i."-".$j][] = array('网站设置',U('/admin/global/websetting'),1);
$menu_left[$i][$i."-".$j][] = array('友情链接',U('/admin/global/friend'),1);
$menu_left[$i][$i."-".$j][] = array('广告管理',U('/admin/ad/'),1);

$menu_left[$i][$i."-".$j][] = array('登陆接口管理',U('/admin/loginonline/'),1);
$menu_left[$i][$i."-".$j][] = array("后台操作日志",U("/admin/global/adminlog"),1);
$menu_left[$i][$i."-".$j][] = array("通知地址状态",U("/admin/global/notify"),1); 
$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('缓存管理','#',1);
$menu_left[$i][$i."-".$j][] = array('所有缓存',U('/admin/global/cleanall'),1);


$i++;
$menu_left[$i]= array('借款管理','#',1);
$menu_left[$i]['low_title'][$i."-".$j] = array('借款列表','#',1);
$menu_left[$i][$i."-".$j][] = array('初审待审核借款',U('/admin/borrow/waitverify'),1);
$menu_left[$i][$i."-".$j][] = array('复审待审核借款',U('/admin/borrow/waitverify2'),1);
$menu_left[$i][$i."-".$j][] = array('招标中借款',U('/admin/borrow/waitmoney'),1);
$menu_left[$i][$i."-".$j][] = array('还款中借款',U('/admin/borrow/repaymenting'),1);
$menu_left[$i][$i."-".$j][] = array('已完成的借款',U('/admin/borrow/done'),1);
$menu_left[$i][$i."-".$j][] = array('已流标借款',U('/admin/borrow/unfinish'),1);
$menu_left[$i][$i."-".$j][] = array('初审未通过的借款',U('/admin/borrow/fail'),1);
$menu_left[$i][$i."-".$j][] = array('复审未通过的借款',U('/admin/borrow/fail2'),1);

$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array("一周应还款","#",1);
$menu_left[$i][$i."-".$j][] = array('一周应还款',U('/admin/trepayment/index'),1);


$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array("债权转让管理","#",1);
$menu_left[$i][$i."-".$j][] = array('债权转让',U('/admin/debt/index'),1);

$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('逾期借款管理','#',1);
$menu_left[$i][$i."-".$j][] = array('逾期统计',U('/admin/expired/detail'),0);
$menu_left[$i][$i."-".$j][] = array('已逾期借款',U('/admin/expired/index'),1);
$menu_left[$i][$i."-".$j][] = array('逾期会员列表',U('/admin/expired/member'),1);

$i++;
$menu_left[$i]= array('会员管理','#',1);
$menu_left[$i]['low_title'][$i."-".$j] = array('会员管理','#',1);
$menu_left[$i][$i."-".$j][] = array('会员列表',U('/admin/members/index'),1);
$menu_left[$i][$i."-".$j][] = array('会员资料列表',U('/admin/members/info'),1);
$menu_left[$i][$i."-".$j][] = array('举报信息',U('/admin/jubao/index'),1);
$menu_left[$i][$i."-".$j][] = array('托管信息',U('/admin/members/escrow'),1); 
$j++;

$menu_left[$i]['low_title'][$i."-".$j] = array('认证及申请管理','#',1);
$menu_left[$i][$i."-".$j][] = array('手机认证会员',U('/admin/verifyphone/index'),1);
$menu_left[$i][$i."-".$j][] = array('VIP申请管理',U('/admin/vipapply/index'),1);
$menu_left[$i][$i."-".$j][] = array('会员实名认证申请',U('/admin/memberid/index'),1);
$menu_left[$i][$i."-".$j][] = array('额度申请待审核',U('/admin/members/infowait'),1);
$menu_left[$i][$i."-".$j][] = array('上传资料管理',U('/admin/memberdata/index'),1);
$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('评论管理','#',1);
$menu_left[$i][$i."-".$j][] = array('评论列表',U('/admin/comment/index'),1);
$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('快捷借款管理','#',1);
$menu_left[$i][$i."-".$j][] = array('快捷借款列表',U('/admin/feedback/index'),1);

$i++;
$menu_left[$i]= array('充值提现','#',1);
$menu_left[$i]['low_title'][$i."-".$j] = array('充值管理','#',1);
$menu_left[$i][$i."-".$j][] = array('在线充值',U('/admin/Paylog/paylogonline'),1);


$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('提现管理','#',1);
$menu_left[$i][$i."-".$j][] = array('提现列表 ',U('/admin/Withdrawlog/withdraw2'),1);
$menu_left[$i][$i."-".$j][] = array('提现失败',U('/admin/Withdrawlog/withdraw3'),1);
$menu_left[$i][$i."-".$j][] = array('提现申请总列表',U('/admin/Withdrawlog/index'),1);

$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('转账管理','#',1);
$menu_left[$i][$i."-".$j][] = array('向客户转账 ',U('/admin/transfer/index'),1);
$menu_left[$i][$i."-".$j][] = array('转账记录',U('/admin/transfer/record'),1);

$i++;
$menu_left[$i]= array('文章管理','#',1);
$menu_left[$i]['low_title'][$i."-".$j] = array('文章管理','#',1);
$menu_left[$i][$i."-".$j][] = array('文章列表',U('/admin/article/'),1);
$menu_left[$i][$i."-".$j][] = array('文章分类',U('/admin/acategory/'),1);
$i++;
$menu_left[$i]= array('菜单管理','#',1);
$menu_left[$i]['low_title'][$i."-".$j] = array('菜单管理','#',1);
$menu_left[$i][$i."-".$j][] = array('导航菜单',U('/admin/navigation/index'),1);

$i++;
$menu_left[$i]= array('资金统计','#',1);
$menu_left[$i]['low_title'][$i."-".$j] = array('会员帐户','#',1);
$menu_left[$i][$i."-".$j][] = array('会员帐户',U('/admin/capitalAccount/index'),1);
$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('充值提现','#',1);
$menu_left[$i][$i."-".$j][] = array('充值记录',U('/admin/capitalOnline/charge'),1);
$menu_left[$i][$i."-".$j][] = array('提现记录',U('/admin/capitalOnline/withdraw'),1);
$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('会员资金变动记录','#',1);
$menu_left[$i][$i."-".$j][] = array('资金记录',U('/admin/capitalDetail/index'),1);
$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('网站资金统计','#',1);
$menu_left[$i][$i."-".$j][] = array('网站资金统计',U('/admin/capitalAll/index'),1);
$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('邀请奖励','#',1);
$menu_left[$i][$i."-".$j][] = array('邀请奖励',U('/admin/awards/invite'),1);
$menu_left[$i][$i."-".$j][] = array('邀请奖励记录',U('/admin/awards/invitelog'),1); 

$i++;
$menu_left[$i]= array('权限','#',1);
$menu_left[$i]['low_title'][$i."-".$j] = array('用户权限管理',"#",1);
$menu_left[$i][$i."-".$j][] = array('管理员管理',U('/admin/Adminuser/'),1);
$menu_left[$i][$i."-".$j][] = array('用户组权限管理',U('/admin/acl/'),1);


$i++;
$menu_left[$i]= array('数据库','#',1);
$menu_left[$i]['low_title'][$i."-".$j] = array('数据库管理','#',1);
$menu_left[$i][$i."-".$j][] = array('数据库信息',U('/admin/db/'),1);
$menu_left[$i][$i."-".$j][] = array('备份管理',U('/admin/db/baklist'),1);
$menu_left[$i][$i."-".$j][] = array('清空数据',U('/admin/db/truncate'),1);

$i++;
$menu_left[$i]= array('扩展管理','#',1);
$menu_left[$i]['low_title'][$i."-".$j] = array('参数管理','#',1);
$menu_left[$i][$i."-".$j][] = array('业务参数管理',U('/admin/bconfig/index'),1);
$menu_left[$i][$i."-".$j][] = array('合同居间方资料上传',U('/admin/hetong/index'),1);
$menu_left[$i][$i."-".$j][] = array('信用级别管理',U('/admin/leve/index'),1);
$menu_left[$i][$i."-".$j][] = array('投资级别管理',U('/admin/leve/invest'),1);
$menu_left[$i][$i."-".$j][] = array('会员年龄别称',U('/admin/age/index'),1);

$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('托管设置','#',1);
$menu_left[$i][$i."-".$j][] = array('托管账户设置',U('/admin/trust/index'),1);

$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('在线客服管理','#',1);
$menu_left[$i][$i."-".$j][] = array('QQ客服管理',U('/admin/QQ/index'),1);
$menu_left[$i][$i."-".$j][] = array('QQ群管理',U('/admin/QQ/qun'),1);
$menu_left[$i][$i."-".$j][] = array('客服电话管理',U('/admin/QQ/tel/'),1);

$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('在线通知管理','#',1);
$menu_left[$i][$i."-".$j][] = array('通知信息接口管理',U('/admin/msgonline/'),1);
$menu_left[$i][$i."-".$j][] = array('通知信息模板管理',U('/admin/msgonline/templet/'),1);

$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('百度云推送管理','#',0);
$menu_left[$i][$i."-".$j][] = array('手机客户端云推送',U('/admin/baidupush/'),1);

$j++;
$menu_left[$i]['low_title'][$i."-".$j] = array('安全检测','#',1);
$menu_left[$i][$i."-".$j][] = array('文件管理',U('/admin/mfields/'),1);
$menu_left[$i][$i."-".$j][] = array('木马查杀',U('/admin/scan/'),1);

?>


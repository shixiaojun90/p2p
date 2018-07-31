<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo ($ts['site']['site_name']); ?>管理后台</title>
<link href="__ROOT__/Style/A/css/style.css" rel="stylesheet" type="text/css">
<link href="__ROOT__/Style/A/js/tbox/box.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__ROOT__/Style/A/js/jquery.js"></script>
<script type="text/javascript" src="__ROOT__/Style/A/js/common.js"></script>
<script type="text/javascript" src="__ROOT__/Style/A/js/tbox/box.js"></script>
</head>
<body>
<style type="text/css">
.quxiantu{ margin-top:30px;}
.qleft{ float:left; width:50%; text-align:left;}
.qright{ float:right; width:50%; text-align:right;}

.ssx a{height:30px; line-height:30px}
.lf{
    float:left;
    width:48%; border:1px solid #c7d8ea; margin: 10px;
}
.lf h6{
    border-bottom: 1px solid #c7d8ea;
    color: #3a6ea5;
    height: 26px;
    line-height: 28px;
    padding: 0 10px;
    font-size: 13px;
}
.lf .content{
    padding: 9px 10px;
    line-height: 22px;
}
.lf .content a{
    color:red;
    font-weight:bold;
}
</style>
<script type="text/javascript" src="__ROOT__/Style/Js/highcharts.js"></script>
<script type="text/javascript" src="__ROOT__/Style/Js/exporting.js"></script>
<div class="so_main">
  <div class="page_tit">欢迎页</div>
  <!--列表模块-->
  <div class="Toolbar_inbox">
    <div class="page right">
	当前时间<span id="clock"></span>
    </div>
    <a href="javascript:;" class="btn_a"><span>欢迎登陆</span></a></div>
<script>
function changeClock()
{
	var d = new Date();
	document.getElementById("clock").innerHTML = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate() + " " + d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
}
window.setInterval(changeClock, 1000);
</script>  
<div class="lf">
    <h6>个人信息</h6>
    <div class="content">
        您好，<?php echo ($user["user_name"]); ?>
        <br />
        所属角色：<?php echo ($user["groupname"]); ?> 
        <br />
        上次登录时间：<?php echo (date('Y-m-d H:i:s',$user["last_log_time"])); ?>
        <br />
        上次登录IP：<?php echo ($user["last_log_ip"]); ?>   
 <br />
  <br />
   <br />
    <br />
    </div>
</div>
<div class="lf">
    <h6>开发团队</h6>
    <div class="content">
        版权所有：菏泽市伟王网络科技有限公司
        <br />
        总 策 划：王伟
        <br />
        开发与支持团队：范叶磊、宋绍锐、张继立、赵辉、赵忠祥
        <br />    
        UI 设计：耿杰、都威、李慧、张朝建、张芯慈
		<br />    
        软件测试：辛叶叶
        <br />    
        官方网站：<a href="http://www.lvmaque.com/" target="_blank">http://www.lvmaque.com/</a> 
        <br />    
        网贷点评网：<a href="http://www.wangdaidp.com/" target="_blank">http://www.wangdaidp.com/</a>
    </div>
</div>
<div class="lf">
    <h6>待审核工作</h6>
    <div class="content">
     <div style="float: left; width:300px;">
        等待初审的标[<?php if($row["borrow_1"] > 0): ?><a href="__APP__/admin/borrow/waitverify.html" ><?php echo ($row["borrow_1"]); ?></a><?php else: ?> 0<?php endif; ?>]个
     </div>
	  <br />
    <div style="float: left; width:300px;">
        等待复审的标[<?php if($row["borrow_2"] > 0): ?><a href="__APP__/admin/borrow/waitverify2.html"><?php echo ($row["borrow_2"]); ?></a><?php else: ?> 0<?php endif; ?>]个
     </div>
    
     <br />
	 <div style="float: left; width:300px;">  
        等待VIP认证的[<?php if($row["vip_a"] > 0): ?><a href="__APP__/admin/vipapply/index?status=0"><?php echo ($row["vip_a"]); ?></a><?php else: ?> 0<?php endif; ?>]个
     </div>
	 <br/>
	 <div style="float: left; width:300px;">   
         等待实名认证的[<?php if($row["real_a"] > 0): ?><a href="__APP__/admin/memberid/index?status=3"><?php echo ($row["real_a"]); ?></a><?php else: ?> 0<?php endif; ?>]个
     </div>
	  <br />
     <div style="float: left; width:300px;">
        额度申请等待审核的[<?php if($row["limit_a"] > 0): ?><a href="__APP__/admin/members/infowait.html"><?php echo ($row["limit_a"]); ?></a><?php else: ?> 0<?php endif; ?>]个 
     </div>
	 <br />
     <div style="float: left; width:300px;"> 
        上传资料等待审核的[<?php if($row["data_up"] > 0): ?><a href="__APP__/admin/memberdata/index.html"><?php echo ($row["data_up"]); ?></a><?php else: ?> 0<?php endif; ?>]个
     </div>
    
    
    
	  <br />
	  <br />
	 
    </div>
</div>

<div class="lf" >
    <h6>一周内应还款</h6>
    <div class="content" style="height:155px;  overflow:auto;">
	<?php if(is_array($hlist)): $i = 0; $__LIST__ = $hlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div style="float: left; width:300px;">
        <?php echo date("Y年m月d日H点i分s秒", $vo['deadline']) ?>
		应还借款
		<a href="/admin/trepayment/index.html" style="font-color:#3a6ea5"><?php echo (($vo["money"])?($vo["money"]):0.00); ?></a>
     </div>
	  <br /><?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>

</div>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>
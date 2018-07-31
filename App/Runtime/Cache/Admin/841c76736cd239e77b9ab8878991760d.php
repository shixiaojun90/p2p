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

<div class="so_main">

<div class="page_tit">转账管理</div>
<div class="page_tab"><span data="tab_1"  class="active">向客户转账</span></div>
<div class="form2">
	<form method="post" id="transferForm" action="" enctype="multipart/form-data" target="_blank">
	<!--tab1-->
	<div id="tab_1">
		<dl class="lineD"><dt>用户名：</dt><dd><input name="user" id="user"  class="input" type="text" value="<?php echo ($user_name); ?>" ><span id="tip_user" class="tip">* 注册用户名</span></dd></dl>
		<dl class="lineD"><dt>金额：</dt><dd><input name="money" id="money"  class="input" type="text" value="" ><span id="tip_money" class="tip">* 转账金额</span></dd></dl>
		<dl class="lineD"><dt>备注：</dt><dd><textarea name="remark" id="remark"  class="areabox" ></textarea><span id="tip_remark" class="tip">* 转账金额</span></dd></dl>
	</div>
	<!--tab1-->
	
	
	<div class="page_btm">
	  <input type="button" class="btn_b" value="确定" /><span style="color:#CCCCCC"></span>
	</div>
	</form>
</div>

</div>
<script type="text/javascript">
$(function(){
	$(".btn_b").click(function(){
		var user = $("#user").val();
		var money = $("#money").val();
		var remark = $("#remark").val();
		if(!user){
			ui.error("请输入转向的用户名!"); return false;
		}
		if(money<=0.00){
			ui.error("请输入金额!");return false;
		}
		if(!remark){
			ui.error("备注不能为空!");return false;
		}

		$("#transferForm").submit()
		
	})
})
</script>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>
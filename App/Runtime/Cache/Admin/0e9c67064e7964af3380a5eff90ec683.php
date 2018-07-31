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

<div class="page_tit">托管信息管理</div>
<div class="page_tab"><span data="tab_1"  class="active">托管配置</span></div>
<div class="form2">
	<form method="post" action="__URL__/save" onsubmit="return subcheck();" enctype="multipart/form-data">
	<!--tab1-->
	<div id="tab_1">
		<dl class="lineD"><dt>平台乾多多标识：</dt><dd><input name="loan[pfmmm]" id="loan[pfmmm]"  class="input" type="text" value="<?php echo ($loan["pfmmm"]); ?>" ><span id="tip_loan[pfmmm]" class="tip">开通乾多多平台账号时生成的 以p开头</span></dd></dl>
		<!--dl class="lineD"><dt>网站自有乾多多标识：</dt><dd><input name="loan[zmmm]" id="loan[zmmm]"  class="input" type="text" value="<?php echo ($loan["zmmm"]); ?>" ><span id="tip_loan[zmmm]" class="tip">网站自有账户</span></dd></dl-->
		<dl class="lineD"><dt>公钥：</dt><dd><textarea name="loan[public_key]" id="loan[public_key]"  class="areabox" ><?php echo ($loan["public_key"]); ?></textarea><span id="tip_loan[public_key]" class="tip">*</span></dd></dl>
        <dl class="lineD"><dt>私钥：</dt><dd><textarea name="loan[private_key]" id="loan[private_key]"  class="areabox" ><?php echo ($loan["private_key"]); ?></textarea><span id="tip_loan[private_key]" class="tip">*</span></dd></dl>
	</div>
	<!--tab1-->
	
	
	<div class="page_btm">
	  <input type="submit" class="btn_b" value="确定" /><span style="color:#CCCCCC"></span>
	</div>
	</form>
</div>

</div>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>
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

<div class="page_tit">身份证信息</div>
<div class="page_tab"><span data="tab_1" class="active">身份证代传</span></div>
<div class="form2">
	<form method="post" action="__URL__/doIdcardEdit" onsubmit="return subcheck();" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?php echo ($id); ?>" />
	<input type="hidden" name="uid" value="<?php echo ($vo["id"]); ?>" />
	<div id="tab_1">
	<dl class="lineD"><dt>真实姓名：</dt><dd><input name="real_name" id="real_name"  class="input" type="text" value="<?php echo ($vo["real_name"]); ?>" ></dd></dl>
	<dl class="lineD"><dt>身份证号：</dt><dd><input name="idcard" id="idcard"  class="input" type="text" value="<?php echo ($vo["idcard"]); ?>" ></dd></dl>
	<dl class="lineD"><dt>身份证正面图片：</dt><dd><input type="file" id="imgfile1" name="imgfile[]" class="input" /><div style="text-align:left; clear:both; overflow:hidden; width:290px; height:100px"><div id="imgDiv"></div><?php if($vo["card_img"] == ''): ?>无缩略图<?php else: ?><img src="__ROOT__/<?php echo ($vo["card_img"]); ?>" width="100" height="100" /><?php endif; ?></div>
	</dd></dl>
	<dl class="lineD"><dt>身份证反面图片：</dt><dd><input type="file" id="imgfile2" name="imgfile[]" class="input" /><div style="text-align:left; clear:both; overflow:hidden; width:290px; height:100px"><div id="imgDiv"></div><?php if($vo["card_back_img"] == ''): ?>无缩略图<?php else: ?><img src="__ROOT__/<?php echo ($vo["card_back_img"]); ?>" width="100" height="100" /><?php endif; ?></div>
	</dd></dl>
	
	</div><!--tab1-->
	
	<div class="page_btm">
	  <input type="submit" class="btn_b" value="确定" />
	  <input type="button" class="btn_b" value="返回"  onclick="javascript:history.back();"/>
	</div>
	</form>
</div>

</div>
<script type="text/javascript">
var cansub = true;
function subcheck(){
	if(!cansub){
		alert("请不要重复提交，如网速慢，请等待！");
		return false;	
	}
	
	if($("#imgfile1").val()=="" && $("#imgfile2").val()==""){
		ui.error("如果不做任何修改，请点返回按钮退出！");
		return false;
	}else if(($("#imgfile1").val()!="" && $("#imgfile2").val()=="" )||($("#imgfile1").val()=="" && $("#imgfile2").val()!="" ) ){
		ui.error("身份证正反面必须全部上传！");
		return false;
	}else{
		cansub = false;
		return true;
	}
}
</script>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>
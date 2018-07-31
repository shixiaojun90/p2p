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
	  <div class="page_tit">文件管理</div>

	<div class="list">

	  <div class="Toolbar_inbox">
		<a class="btn_a" href="__URL__/?newpath=/"><span>根目录</span></a>
		<a class="btn_a" href="__URL__/?newpath=<?php echo ($updir); ?>"><span>上级目录</span></a>
		<a onclick="cksize();" class="btn_a" href="javascript:void(0);"><span>空间检查</span></a>
	  </div>

		<table width='100%' border='0' cellspacing='0' cellpadding='2' align='center' style="background:#cfcfcf;">
		<tr height="28" align="center">
		  <th width="28%" class="line_l" background="images/wbg.gif" ><strong>文件名</strong></th>
		  <th width="16%" class="line_l" background="images/newlinebg3.gif"><strong>文件大小</strong></th>
		  <th class="line_l" background="images/wbg.gif"><center><strong>最后修改时间</strong></center></th>
		</tr>
		<?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; echo ($vo); endforeach; endif; else: echo "" ;endif; ?>
		</table>
	
	  <div class="Toolbar_inbox">
		<a class="btn_a" href="__URL__/?newpath=/"><span>根目录</span></a>
		<a class="btn_a" href="__URL__/?newpath=<?php echo ($updir); ?>"><span>上级目录</span></a>
		<a onclick="cksize();" class="btn_a" href="javascript:void(0);"><span>空间检查</span></a>
	  </div>
	</div>
</div>
<script type="text/javascript">
var changeUrl="__URL__/rname";
var delfileUrl="__URL__/deletefile";
var deldirUrl="__URL__/deletedir";
var listdirUrl="__URL__/listdir";
var editUrl="__URL__/editUrl";
var addUrl="__URL__/newdir";
var ckUrl="__URL__/checksize";

//空间检测
function cksize() {
	ui.box.load(ckUrl, {title:'检测空间占用大小'});
}

</script>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>
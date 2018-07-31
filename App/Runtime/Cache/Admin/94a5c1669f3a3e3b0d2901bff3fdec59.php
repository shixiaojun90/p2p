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

<script type="text/javascript">
	var setUrl = '__URL__/set.html';
	var tableUrl = '__URL__/showtable.html';
	var setTitle = '备份参数';
	var strTitle = '查看表结构';
</script>
<div class="so_main">
  <div class="page_tit">清空数据表</div>
  <div style="height:200px; line-height:200px; text-align:center;">
  <form name="xx" method="post" action="__URL__/truncate">
  <input name="ee" value="" style="display:none"/>
  <input type="submit" onclick="javascript:if(confirm('确定要清空数据吗？清空后所有数据都将被删除，并且不可恢复！')) return true;else return false;" value="清空数据" style="height:50px; width:100px" />
  </form>
  </div>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>
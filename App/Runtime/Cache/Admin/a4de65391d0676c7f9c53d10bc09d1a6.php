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
	var delUrl = '__URL__/doDel';
	var addUrl = '__URL__/add';
	var addTitle = '添加分类';
</script>
<div class="so_main">
  <div class="page_tit">通知地址状态</div>

  <div class="Toolbar_inbox" style="height:25px;">
  	<div class="page right"><?php echo ($pagebar); ?></div>
  </div>
  
  <div class="list">
  <table id="area_list" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th style="width:30px;">
        <input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
        <label for="checkbox"></label>
    </th>
    <th class="line_l">ID</th>
    <th class="line_l">接口类型</th>
    <th class="line_l">交易时间</th>
    <th class="line_l">上次返回时间</th> 
    <th class="line_l">返回地址</th> 
    <th class="line_l">数据包</th>
	<th class="line_l">次数</th>
    <th class="line_l">状态</th>
  </tr>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="list_<?php echo ($vo["id"]); ?>">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value='<?php echo ($vo["id"]); ?>'>
            <input type="hidden" id="data_<?php echo ($vo["id"]); ?>" value='<?php echo ($vo["data"]); ?>'>
        </td>
        <td><?php echo ($vo["id"]); ?></td>
        <td><?php echo ($vo["type"]); ?></td>
        <td><?php echo (date('Y-m-d H:i:s',$vo["addtime"])); ?></td>      
        <td><?php echo (date('Y-m-d H:i:s',$vo["last_time"])); ?></td>
        <td><?php echo ($vo["notify_url"]); ?></td>
        <td><?php echo (cnsubstr($vo["data"],15)); ?><a href="#" onclick="copyText('data_<?php echo ($vo["id"]); ?>')">复制</a></td> 
		<td><?php echo ($vo["num"]); ?></td> 
        <td><?php echo ($vo["status"]); ?></td> 
       
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>

  </div>
  
  <div class="Toolbar_inbox" style="height:25px;">
  	<div class="page right"><?php echo ($pagebar); ?></div>
  </div>
</div>
<script type="text/javascript"> 
function copyText(id) 
{ 
var obj=document.getElementById(id);
obj.select();
js=obj.createTextRange();
js.execCommand("Copy")
alert("复制成功!");   

} 
</script> 

<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>
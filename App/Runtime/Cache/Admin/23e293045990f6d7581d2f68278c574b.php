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

<script type="text/javascript" src="__ROOT__/Style/My97DatePicker/WdatePicker.js" language="javascript"></script>
<script type="text/javascript">
	var delUrl = '__URL__/doDel';
	var addUrl = '__URL__/add';
	var editUrl = '__URL__/edit';
	var editTitle = '处理充值';
	var isSearchHidden = 1;
	var searchName = "搜索充值";
</script>
<div class="so_main">
  <div class="page_tit">线上充值列表</div>
<!--搜索-->
  
<!--搜索-->

  <div class="Toolbar_inbox">
  	<div class="page right"><?php echo ($pagebar); ?></div>
    <a onclick="dosearch();" class="btn_a" href="javascript:void(0);"><span class="search_action">搜索充值</span></a>
	
  </div>
  
  <div class="list">
  <table id="area_list" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    
    <th class="line_l">ID</th>
	<th class="line_l">订单号</th>
    <th class="line_l">会员名</th>
    <th class="line_l">转账金额</th>
	<th class="line_l">转账人</th>
    <th class="line_l">转账状态</th>
    <th class="line_l">流水号</th>
    <th class="line_l">转账时间</th>
  </tr>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="list_<?php echo ($vo["id"]); ?>">
        
        <td><?php echo ($vo["id"]); ?></td>
		 <td><?php echo ($vo["orders"]); ?></td>
        <td><a onclick="loadUser(<?php echo ($vo["uid"]); ?>,'<?php echo ($vo["username"]); ?>')" href="javascript:void(0);"><?php echo ($vo["username"]); ?></a></td>
        <td><?php echo ($vo["money"]); ?></td>
		<td><?php echo ($vo["operator"]); ?></td>
        
        <td><?php echo ($status[$vo['status']]); ?></td>
        <td><?php echo ($vo["loanno"]); ?></td>
		<td><?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>

  </div>
  
  <div class="Toolbar_inbox">
  	<div class="page right"><?php echo ($pagebar); ?></div>
    <a onclick="dosearch();" class="btn_a" href="javascript:void(0);"><span class="search_action">搜索充值</span></a>
  </div>
</div>


<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>
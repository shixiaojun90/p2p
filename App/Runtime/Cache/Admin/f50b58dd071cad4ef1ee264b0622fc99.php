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
	var isSearchHidden = 1;
	var searchName = "搜索提现";
</script>
<div class="so_main">
  <div class="page_tit">提现成功列表</div>
<!--搜索-->
    <!-------- 搜索游戏 -------->
  <div id="search_div" style="display:none">
  	<div class="page_tit"><script type="text/javascript">document.write(searchName);</script> [ <a href="javascript:void(0);" onclick="dosearch();">隐藏</a> ]</div>
	
	<div class="form2">
	<form method="get"  action="__URL__/index">
	 <?php if($search["uid"] > 0): ?><input type="hidden" name="uid" value="<?php echo ($search["uid"]); ?>" /><?php endif; ?>
    <dl class="lineD">
      <dt>会员名：</dt>
      <dd>
        <input name="uname" style="width:190px" id="title" type="text" value="<?php echo ($search["uname"]); ?>">
        <span>不填则不限制</span>
      </dd>
    </dl>
	
     <dl class="lineD">
      <dt>提现金额：</dt>
      <dd>
	   <select name="bj" id="bj" style="width:80px"  class="c_select"><option value="">--请选择--</option><?php foreach($bj as $key=>$v){ if($search["bj"]==$key && $search["bj"]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select>
      <input name="money" id="money" style="width:100px" class="input" type="text" value="<?php echo ($search["money"]); ?>" >
        <span>不填则不限制</span>
      </dd>
    </dl>
	
	<dl class="lineD"><dt>提现时间(开始)：</dt><dd><input onclick="WdatePicker({maxDate:'#F{$dp.$D(\'end_time\')||\'2020-10-01\'}',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true});" name="start_time" id="start_time"  class="input Wdate" type="text" value="<?php echo (mydate('Y-m-d H:i:s',$search["start_time"])); ?>"><span id="tip_start_time" class="tip">只选开始时间则查询从开始时间往后所有</span></dd></dl>
	<dl class="lineD"><dt>提现时间(结束)：</dt><dd><input onclick="WdatePicker({minDate:'#F{$dp.$D(\'start_time\')}',maxDate:'2020-10-01',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true});" name="end_time" id="end_time"  class="input Wdate" type="text" value="<?php echo (mydate('Y-m-d H:i:s',$search["end_time"])); ?>"><span id="tip_end_time" class="tip">只选结束时间则查询从结束时间往前所有</span></dd></dl>
	
    <dl class="lineD">
      <dt>提现状态：</dt>
      <dd>
      <select name="status" id="status" style="width:150px"  class="c_select"><option value="">--请选择--</option><?php foreach($status as $key=>$v){ if($search["status"]==$key && $search["status"]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select>
        <span>不填则不限制</span>
      </dd>
    </dl>
	
    <dl class="lineD">
      <dt>处理人：</dt>
      <dd>
        <input name="deal_user" style="width:190px" id="title" type="text" value="<?php echo ($search["deal_user"]); ?>">
        <span>不填则不限制</span>
      </dd>
    </dl>

    <div class="page_btm">
      <input type="submit" class="btn_b" value="确定" />
    </div>
	</form>
  </div>
  </div>
<!--搜索-->

  <div class="Toolbar_inbox">
  	<div class="page right"><?php echo ($pagebar); ?></div>
    <a onclick="dosearch();" class="btn_a" href="javascript:void(0);"><span class="search_action">搜索提现</span></a>

  </div>
	<div class="list">
  <table id="area_list" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th style="width:30px;">
        <input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
        <label for="checkbox"></label>
    </th>
    <th class="line_l">ID</th>
    <th class="line_l">会员名</th>
	<th class="line_l">真实姓名</th>
    <th class="line_l">提现金额</th>
	<th class="line_l">提现手续费</th>
	<th class="line_l">应到账金额</th>
    <th class="line_l">提现时间</th>
    <th class="line_l">提现状态</th>
    <th class="line_l">处理人</th>
    <th class="line_l">处理时间</th>
    <th class="line_l">处理说明</th>
   <th class="line_l">操作</th>
  </tr>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="list_<?php echo ($vo["id"]); ?>">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($vo["id"]); ?>"></td>
        <td><?php echo ($vo["id"]); ?></td>
        <td><a onclick="loadUser(<?php echo ($vo["uid"]); ?>,'<?php echo ($vo["user_name"]); ?>')" href="javascript:void(0);"><?php echo ($vo["user_name"]); ?></a></td>
		<td><?php echo ($vo["real_name"]); ?></td>
        <td><?php echo (($vo["withdraw_money"])?($vo["withdraw_money"]):0); ?>元</td>
		 <td><?php echo (($vo["second_fee"])?($vo["second_fee"]):0); ?>元</td>
		<td><?php if($vo['withdraw_status'] == 3): ?>0
		 <?php else: ?>
		 <?php echo ($vo['withdraw_money']-$vo['second_fee']); endif; ?>元</td>
        <td><?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?></td>
        <td>
            <?php if($vo["withdraw_status"] == 0): ?>提现失败
            <?php elseif($vo["withdraw_status"] == 1): ?>提现成功
            <?php elseif($vo["withdraw_status"] == 2): ?>资金退回
            <?php elseif($vo["withdraw_status"] == 3): ?>审核未通过
            <?php elseif($vo["withdraw_status"] == 4): ?>待审核<?php endif; ?>
        </td>
        <td><?php echo (($vo["deal_user"])?($vo["deal_user"]):"无"); ?></td>
        <td><?php if($vo["deal_time"] == 0): ?>无<?php else: echo (date("Y-m-d H:i:s",$vo["deal_time"])); endif; ?></td>
        <td><?php echo (($vo["deal_info"])?($vo["deal_info"]):"无"); ?></td>
		<td> ---- </td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>
  </div>
 
  
  
  <div class="Toolbar_inbox">
  	<div class="page right"><?php echo ($pagebar); ?></div>
    <a onclick="dosearch();" class="btn_a" href="javascript:void(0);"><span class="search_action">搜索提现</span></a>
  </div>
</div>


<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>
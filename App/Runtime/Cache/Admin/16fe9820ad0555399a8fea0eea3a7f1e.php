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
	var isSearchHidden = 1;
</script>
<div class="so_main">
<div class="page_tit">还款明细</div> 
<!--搜索/筛选会员-->
  <script type="text/javascript" src="__ROOT__/Style/My97DatePicker/WdatePicker.js" language="javascript"></script>
<script type="text/javascript">
	var searchName = "搜索/筛选借款";
</script>
  <div id="search_div" style="display:none">
  	<div class="page_tit"><script type="text/javascript">document.write(searchName);</script> [ <a href="javascript:void(0);" onclick="dosearch();">隐藏</a> ]</div>
	
	<div class="form2">
	<form method="get" action="__URL__/index">
   <dl class="lineD">
      <dt>会员名：</dt>
      <dd>
        <input name="user_name" style="width:190px" id="title" type="text" value="<?php echo ($search["user_name"]); ?>">
        <span>不填则不限制</span>
      </dd>
    </dl>
    <dl class="lineD">
      <dt>借款标题：</dt>
      <dd>
        <input name="borrow_name" style="width:190px" id="title" type="text" value="<?php echo ($search["borrow_name"]); ?>">
        <span>不填则不限制</span>
      </dd>
    </dl>
	<dl class="lineD">
      <dt>标种：</dt>
      <dd>
        <input name="borrow_type" style="width:50px" id="title" type="radio" value="1" <?php if($search["borrow_type"] < 6): ?>"checked"<?php endif; ?>>散标
		<input name="borrow_type" style="width:50px" id="title" type="radio" value="6"  <?php if($search["borrow_type"] == 6): ?>"checked"<?php endif; ?>>企业直投
		<input name="borrow_type" style="width:50px" id="title" type="radio" value="7"  <?php if($search["borrow_type"] == 7): ?>"checked"<?php endif; ?>>定投宝
        <span>不填则不限制</span>
      </dd>
    </dl>
	<!-- <dl class="lineD"><dt>借款时间(开始)：</dt><dd><input onclick="WdatePicker({maxDate:'#F{$dp.$D('end_time')||'2020-10-01'}',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true});" name="start_time" id="start_time"  class="input Wdate" type="text" value="<?php echo (mydate('Y-m-d H:i:s',$search["start_time"])); ?>"><span id="tip_start_time" class="tip">只选开始时间则查询从开始时间往后所有</span></dd></dl>
	<dl class="lineD"><dt>借款时间(结束)：</dt><dd><input onclick="WdatePicker({minDate:'#F{$dp.$D('start_time')}',maxDate:'2020-10-01',dateFmt:'yyyy-MM-dd HH:mm:ss',alwaysUseStartDate:true});" name="end_time" id="end_time"  class="input Wdate" type="text" value="<?php echo (mydate('Y-m-d H:i:s',$search["end_time"])); ?>"><span id="tip_end_time" class="tip">只选结束时间则查询从结束时间往前所有</span></dd></dl> -->

    <div class="page_btm">
      <input type="submit" class="btn_b" value="确定" />
    </div>
	</form>
  </div>
  </div>
<!--搜索/筛选会员-->

  <div class="Toolbar_inbox">
  	<div class="page right"><?php echo ($pagebar); ?></div>
    <!-- <a onclick="" class="btn_a" href="javascript:void(0);"><span class="search_action">还款明细</span></a> -->
	<a class="btn_a" href="javascript:history.go(-1);">
	  <span class="search_action">返回</span>
	</a>
  </div>
  
  <div class="list">
  <table id="area_list" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th style="width:30px;">
        <input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
        <label for="checkbox"></label>
    </th>
	<th class="line_l">借款标号</th>
    <th class="line_l">待还本金</th>
    <th class="line_l">待还利息</th>
    <th class="line_l">待付总金额</th>
    <th class="line_l">当前/总（期）</th>
	 <th class="line_l">应还日期</th>
  </tr>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="list_<?php echo ($vo["id"]); ?>">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($vo["bid"]); ?>"></td>
        <td><?php echo ($vo["borrow_id"]); ?></td>
        <td><?php echo ($vo["capital"]); ?></td>
        <td><?php echo ($vo["interest"]); ?></td>
        <td><?php echo ($vo['capital']+$vo['interest']); ?></td>
        <td><?php echo ($vo["sort_order"]); ?>/<?php echo ($vo["total"]); ?></td>
		<th><?php echo (date("Y-m-d H:i",$vo["deadline"])); ?></th>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>

  </div>
  
  <div class="Toolbar_inbox">
  	<div class="page right"><?php echo ($pagebar); ?></div>
     <a class="btn_a" href="javascript:history.go(-1);">
	  <span class="search_action">返回</span>
	</a>
  </div>
</div>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>
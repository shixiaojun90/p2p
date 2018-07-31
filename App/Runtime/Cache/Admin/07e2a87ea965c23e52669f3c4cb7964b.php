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
	var editUrl = '__URL__/edit';
	var editTitle = '修改会员类型';
	var isSearchHidden = 1;
	var searchName = "搜索/筛选会员";
</script>
<div class="so_main">
  <div class="page_tit">会员托管账户信息</div>
<!--搜索/筛选会员-->
    <div id="search_div" style="display:none">
  	<div class="page_tit"><script type="text/javascript">document.write(searchName);</script> [ <a href="javascript:void(0);" onclick="dosearch();">隐藏</a> ]</div>
	
	<div class="form2">
	<form method="post" action="">
    <?php if($search["customer_id"] > 0): ?><input type="hidden" name="customer_id" value="<?php echo ($search["customer_id"]); ?>" /><?php endif; ?>
  
   
    <dl class="lineD">
      <dt>真实姓名：</dt>
      <dd>
        <input name="real_name" style="width:190px" id="title" type="text" value="<?php echo ($search["real_name"]); ?>">
        <span>不填则不限制</span>
      </dd>
    </dl>
    <dl class="lineD">
      <dt>身份证号：</dt>
      <dd>
        <input name="id_card" style="width:190px" id="title" type="text" value="<?php echo ($search["id_card"]); ?>">
        <span>不填则不限制</span>
      </dd>
    </dl>
    <dl class="lineD">
      <dt>手机号：</dt>
      <dd>
        <input name="mobile" style="width:190px" id="title" type="text" value="<?php echo ($search["mobile"]); ?>">
        <span>不填则不限制</span>
      </dd>
    </dl>
    
    <div class="page_btm">
      <input type="submit" class="btn_b" value="确定" />
    </div>
	</form>
  </div>
  </div>
<!--搜索/筛选会员-->

  <div class="Toolbar_inbox">
  	<div class="page right"><?php echo ($pagebar); ?></div>
    <a onclick="dosearch();" class="btn_a" href="javascript:void(0);"><span class="search_action">搜索/筛选会员</span></a>
  </div>
  
  <div class="list">
  <table id="area_list" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>

    <th class="line_l">UID</th>
    <th class="line_l">用户名</th>
    <th class="line_l">真实姓名</th>
	<th class="line_l">身份证号</th>
    <th class="line_l">数字账户</th>
    <th class="line_l">手机号</th>
    <th class="line_l">EMAIL</th>
    <th class="line_l">乾多多标识</th>
    <th class="line_l">投标授权</th>
    <th class="line_l">还款授权</th>
    <th class="line_l">二次分配</th>
  </tr>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
        <td><?php echo ($vo["uid"]); ?></td>
        <td><a onclick="loadUser(<?php echo ($vo["uid"]); ?>,'<?php echo ($vo["user_name"]); ?>')" href="javascript:void(0);"><?php echo ($vo["user_name"]); ?></a></td>
        <td><?php echo (($vo["real_name"])?($vo["real_name"]):"&nbsp;"); ?></td>
		<td><?php echo ($vo["id_card"]); ?></td>
        <td><?php echo ($vo["account"]); ?></td>
        <td><?php echo ($vo["mobile"]); ?></td>
        <td><?php echo ($vo["email"]); ?></td>
        <td><?php echo ($vo["qdd_marked"]); ?></td>
        <td><?php echo ($status[$vo['invest_auth']]); ?></td>
        <td><?php echo ($status[$vo['repayment']]); ?></td>
        <td>
             <?php echo ($status[$vo['secondary_percent']]); ?>
             
        </td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>

  </div>
  
  <div class="Toolbar_inbox" style="height: 20px;">
  	<div class="page right"><?php echo ($pagebar); ?></div>
    
    <!--<a onclick="del();" class="btn_a" href="javascript:void(0);"><span>删除会员(谨慎操作)</span></a>-->
  </div>
</div>
<script type="text/javascript">
function showurl(url,Title){
	ui.box.load(url, {title:Title});
}
</script>

<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>
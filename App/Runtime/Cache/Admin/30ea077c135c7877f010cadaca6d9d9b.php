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
</script>
<div class="so_main">
  <div class="page_tit">会员列表</div>

  <div class="Toolbar_inbox">
  	<div class="page right"><?php echo ($pagebar); ?></div>
    <a onclick="void(0);" class="btn_a" href="javascript:void(0);"><span>会员列表</span></a>
  </div>
  
  <div class="list">
  <table id="area_list" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th style="width:30px;">
        <input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
        <label for="checkbox"></label>
    </th>
    <th class="line_l">ID</th>
    <th class="line_l">用户名</th>
    <th class="line_l">个人资料</th>
    <th class="line_l">联系方式</th>
    <th class="line_l">单位资料</th>
    <th class="line_l">财务状况</th>
    <th class="line_l">房产信息</th>
    <th class="line_l">上传的资料</th>
    <th class="line_l">联保情况</th>
    <th class="line_l">申请类型</th>
    <th class="line_l">申请时间</th>
    <th class="line_l">操作</th>
  </tr>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="list_<?php echo ($vo["id"]); ?>">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($vo["id"]); ?>"></td>
        <td><?php echo ($vo["id"]); ?></td>
        <td><a onclick="loadUser(<?php echo ($vo["uid"]); ?>,'<?php echo ($vo["user_name"]); ?>')" href="javascript:void(0);"><?php echo ($vo["user_name"]); ?></a></td>
        <td><?php echo ($vo["mi"]); ?></td>
        <td><?php echo ($vo["mci"]); ?></td>
        <td><?php echo ($vo["mdpi"]); ?></td>
        <td><?php echo ($vo["mfi"]); ?></td>
        <td><?php echo ($vo["mhi"]); ?></td>
        <td><?php echo ($vo["mdi"]); ?></td>
        <td><?php echo ($vo["mei"]); ?></td>
        <td><?php echo ($aType[$vo['apply_type']]); ?></td>
        <td><?php echo (date("Y-m-d H:i",$vo["add_time"])); ?></td>
        <td>
            <a href="__URL__/viewinfo?id=<?php echo ($vo['id']); ?>">查看</a> 
        </td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </table>

  </div>
  
  <div class="Toolbar_inbox">
  	<div class="page right"><?php echo ($pagebar); ?></div>
    <a onclick="void(0);" class="btn_a" href="javascript:void(0);"><span>会员列表</span></a>
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
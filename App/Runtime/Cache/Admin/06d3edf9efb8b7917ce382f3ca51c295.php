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
	var delUrl = '__URL__/delbak';
	var zipUrl = '__URL__/dozip';
	var zipdownUrl = '__URL__/downzip';
	var zipdownTitle = '下载压缩包';
</script>
<div class="so_main">
  <div class="page_tit">数据库管理</div>

  <div class="Toolbar_inbox">
    <a onclick="javascript:del();" class="btn_a" href="javascript:void(0);"><span>删除所选备份</span></a>
  </div>
  
  <div class="list">
  <table id="area_list" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th style="width:30px;">
        <input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
        <label for="checkbox"></label>
    </th>
    <th class="line_l">序号</th>
    <th class="line_l">文件夹名称</th>
    <th class="line_l">备份时间</th>
    <th class="line_l">备份说明</th>
    <th class="line_l">大小</th>
    <th class="line_l">操作</th>
  </tr>
  <?php if(is_array($baklist)): $i = 0; $__LIST__ = $baklist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="list_<?php echo ($vo["dirname"]); ?>">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($vo["dirname"]); ?>"></td>
        <td><?php echo ($key); ?></td>
        <td><?php echo ($vo["dirname"]); ?></td>
        <td width="130px"><?php echo ($vo["baktime"]); ?></td>
        <td width="350px"><?php echo (($vo["bakdetail"])?($vo["bakdetail"]):'无'); ?></td>
        <td><?php echo getMb($vo['baksize']);$total_szie+=$vo['baksize']; ?></td>
        <td>
            <a href="__URL__/restore?path=<?php echo ($vo["dirname"]); ?>" onclick="if(confirm('确定要恢复吗？\r\n恢复会覆盖掉以前的信息，请先做好备份！')) return true;else return false;">恢复</a> &nbsp;
            <a href="javascript:del('<?php echo ($vo["dirname"]); ?>');">删除</a> &nbsp;
            <a href="javascript:downloadzip('<?php echo ($vo["dirname"]); ?>');">打包下载</a> &nbsp;			
        </td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  <tr><td colspan="7" align="right">备份总大小：<?php echo getMb($total_szie); ?></td></tr>
  </table>

  </div>
  
  <div class="Toolbar_inbox">
    <a onclick="javascript:del();" class="btn_a" href="javascript:void(0);"><span>删除所选备份</span></a>
  </div>
</div>
<script type="text/javascript">
function downloadzip(dirname){
	//提交修改
	var datas = {'bakup':dirname};
	$.post(zipUrl, datas, zipResponse,'json');
}
function zipResponse(res){
	if(res.status == '0') {
		ui.error(res.info);
	}else {
		ui.box.load(zipdownUrl+"?url="+res.data+"&zipname="+res.info, {title:zipdownTitle});
	}
}
</script>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>
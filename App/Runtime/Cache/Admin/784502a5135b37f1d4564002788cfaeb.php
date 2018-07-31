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
<style type="text/css">
.dirBox{
	width:300px; 
	height:230px;
	overflow:auto;
}
.dirBox input, .dirBox img{
	vertical-align: middle;
}
</style>
<div class="so_main">
  <div class="page_tit">木马查杀</div>

  <div class="Toolbar_inbox">
      <div class="page right"></div>
    <a onclick="addWebSetting();" class="btn_a" href="<?php echo U('index');?>">
        <span class="searchUser_action">木马查杀</span>
    </a>
    <a onclick="addWebSetting();" class="btn_a" href="<?php echo U('scanReport');?>">
        <span class="searchUser_action">查杀报告</span>
    </a>
  </div>
  
  <div class="form2">
      <form method="post" action="__URL__/updateConfig">
    <dl class="lineD" >
      <dt>查杀目录：</dt>
      <dd>
        <ul class="dirBox">
        	<?php if(is_array($dirs)): $i = 0; $__LIST__ = $dirs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
            	<input type="checkbox" name="dir[]" value="<?php echo ($vo["dir"]); ?>" <?php if($vo["selected"] == 1): ?>checked="checked"<?php endif; ?> >
                <?php if($vo["type"] == 'dir'): ?><img src="__ROOT__/Style/A/images/ico/dir.png">
                <?php else: ?>
                <img src="__ROOT__/Style/A/images/ico/php.png"><?php endif; ?>
                <?php echo ($vo["file"]); ?>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </dd>
    </dl>
    <dl class="lineD" >
      <dt>文件类型：</dt>
      <dd>
        <input type="text" name="info[type]" id="type" value="<?php echo ($info["type"]); ?>" size="100">
      </dd>
    </dl>
    <dl class="lineD" >
      <dt>特征函数：</dt>
      <dd>
        <input type="text" name="info[func]" id="func" value="<?php echo ($info["func"]); ?>" size="100">
      </dd>
    </dl>
    <dl class="lineD" >
      <dt>特征代码：</dt>
      <dd>
        <input type="text" name="info[code]" id="code" value="<?php echo ($info["code"]); ?>" size="100">
      </dd>
    </dl>


    <div class="page_btm">
      <input type="submit" class="btn_b" value="提交" />
    </div>
    </form>
    
  </div>

</div>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>
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
<script type="text/javascript" charset="utf-8" src="__ROOT__/Style/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="__ROOT__/Style/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" charset="utf-8" src="__ROOT__/Style/ueditor/lang/zh-cn/zh-cn.js"></script>

<div class="so_main">

<div class="page_tit">编辑文章</div>
<div class="page_tab"><span data="tab_1" class="active">基本设置</span><span data="tab_2">高级设置</span></div>
<div class="form2">
	<form method="post" action="__URL__/doEdit" onsubmit="return subcheck();" enctype="multipart/form-data">
	<input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>" />
	<div id="tab_1">
	
	<dl class="lineD"><dt>文章标题：</dt><dd><input name="title" id="title"  class="input" type="text" value="<?php echo ($vo["title"]); ?>" maxlength='30'><span id="tip_title" class="tip">*标题最大长度30个字</span></dd></dl>
	<dl class="lineD"><dt>所属栏目：</dt><dd><select name="type_id" id="type_id"   class="c_select"><option value="">--请选择--</option><?php foreach($type_list as $key=>$v){ if("id" && $v["id"]==$vo["type_id"]){ ?><option value="<?php echo ($v["id"]); ?>" selected="selected"><?php echo ($v["type_name"]); ?></option><?php }else{ ?><option value="<?php echo ($v["id"]); ?>"><?php echo ($v["type_name"]); ?></option><?php }} ?></select><span id="tip_type_id" class="tip">*</span></dd></dl>

	<dl class="lineD"><dt>文章关键字：</dt><dd><input name="art_keyword" id="art_keyword"  class="input" type="text" value="<?php echo ($vo["art_keyword"]); ?>" ><span id="tip_art_keyword" class="tip">SEO元素</span></dd></dl>
	<dl class="lineD"><dt>文章简介：</dt><dd><textarea name="art_info" id="art_info"  class="areabox" ><?php echo ($vo["art_info"]); ?></textarea><span id="tip_art_info" class="tip">SEO元素</span></dd></dl>
	<dl class="lineD"><dt>文章顺序：</dt><dd><input name="sort_order" id="sort_order"  class="input" type="text" value="<?php echo ($vo["sort_order"]); ?>" ><span id="tip_sort_order" class="tip">越大越靠前</span></dd></dl>
	
	<dl class="lineD" style="overflow:hidden"><dt>缩略图：</dt>
		<dd>
			<input type="file" id="imgfile" name="imgfile" style="float:left"/>
			<span style="float:left"><div style="text-align:left; clear:both; overflow:hidden; width:290px; height:40px"><div id="imgDiv"></div><?php if($vo["art_img"] == ''): ?>无缩略图<?php else: ?><img src="__ROOT__/<?php echo ($vo["art_img"]); ?>" width="100" height="100" /><?php endif; ?></div></span>
		</dd>
	</dl>
	<dl class="lineD"><dt>是否抓取远程图片：</dt><dd><?php $i=0;$___KEY=array ( 0 => '否', 1 => '是', ); foreach($___KEY as $k=>$v){ if(strlen("1")==1 && $i==0){ ?><input type="radio" name="is_remote" value="<?php echo ($k); ?>" id="is_remote_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("1"=="key1"&&$_X["_Y"]==$k)||(""=="value"&&$_X["_Y"]==$v)){ ?><input type="radio" name="is_remote" value="<?php echo ($k); ?>" id="is_remote_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="is_remote" value="<?php echo ($k); ?>" id="is_remote_<?php echo ($i); ?>" /><?php } ?><label for="is_remote_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?><span id="tip_is_remote" class="tip">抓取远程图片时保存时间可能会稍长，请耐心等待</span></dd></dl>
	<dl class="lineD"><dt>文章内容：</dt>
	  <dd>
	  	<textarea name="art_content" id="art_content" type="text/plain" style="width:780px;height:360px;"><?php echo ($vo["art_content"]); ?></textarea>
	  </dd>
	</dl>
	
	</div><!--tab1-->
	
	<div id="tab_2" style="display:none">
	
	<dl class="lineD"><dt>文章属性：</dt><dd><?php $i=0;$___KEY=array ( 0 => '普通', 1 => '跳转', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="art_set" value="<?php echo ($k); ?>" id="art_set_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["art_set"]==$k)||("key"=="value"&&$vo["art_set"]==$v)){ ?><input type="radio" name="art_set" value="<?php echo ($k); ?>" id="art_set_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="art_set" value="<?php echo ($k); ?>" id="art_set_<?php echo ($i); ?>" /><?php } ?><label for="art_set_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?></dd></dl>
	<dl class="lineD"><dt>文章作者：</dt><dd><input name="art_writer" id="art_writer"  class="input" type="text" value="<?php echo ($vo["art_writer"]); ?>" ></dd></dl>
	<dl class="lineD"><dt>文件名称：</dt><dd><input name="art_url" id="art_url"  class="input" type="text" value="<?php echo ($vo["art_url"]); ?>" ><span id="tip_art_url" class="tip">仅在文章属性为跳转时有效</span></dd></dl>
	
	</div><!--tab2-->
	<div class="page_btm">
	  <input type="submit" class="btn_b" value="确定" />
	</div>
	</form>
</div>

</div>
<script type="text/javascript">
function subcheck() {
        var title = $('#title').val();
        var type_id = $('#type_id').val();

        if (title == '') {
            ui.error("标题不能为空!");
            return false;
        }
		if (type_id == '') {
            ui.error("所属分类不能为空");
            return false;
        }
       
        return true;
    }
</script>
<script type="text/javascript">

    var ue = UE.getEditor('art_content');

    function isFocus(e){
        alert(UE.getEditor('art_content').isFocus());
        UE.dom.domUtils.preventDefault(e)
    }
    function setblur(e){
        UE.getEditor('art_content').blur();
        UE.dom.domUtils.preventDefault(e)
    }
    function insertHtml() {
        var value = prompt('插入html代码', '');
        UE.getEditor('art_content').execCommand('insertHtml', value)
    }
    function createEditor() {
        enableBtn();
        UE.getEditor('art_content');
    }
    function getAllHtml() {
        alert(UE.getEditor('art_content').getAllHtml())
    }
    function getContent() {
        var arr = [];
        arr.push("使用editor.getContent()方法可以获得编辑器的内容");
        arr.push("内容为：");
        arr.push(UE.getEditor('art_content').getContent());
        alert(arr.join("\n"));
    }
    function getPlainTxt() {
        var arr = [];
        arr.push("使用editor.getPlainTxt()方法可以获得编辑器的带格式的纯文本内容");
        arr.push("内容为：");
        arr.push(UE.getEditor('art_content').getPlainTxt());
        alert(arr.join('\n'))
    }
    function setContent(isAppendTo) {
        var arr = [];
        arr.push("使用editor.setContent('欢迎使用ueditor')方法可以设置编辑器的内容");
        UE.getEditor('art_content').setContent('欢迎使用ueditor', isAppendTo);
        alert(arr.join("\n"));
    }
    function setDisabled() {
        UE.getEditor('art_content').setDisabled('fullscreen');
        disableBtn("enable");
    }

    function setEnabled() {
        UE.getEditor('art_content').setEnabled();
        enableBtn();
    }

    function getText() {
        //当你点击按钮时编辑区域已经失去了焦点，如果直接用getText将不会得到内容，所以要在选回来，然后取得内容
        var range = UE.getEditor('art_content').selection.getRange();
        range.select();
        var txt = UE.getEditor('art_content').selection.getText();
        alert(txt)
    }

    function getContentTxt() {
        var arr = [];
        arr.push("使用editor.getContentTxt()方法可以获得编辑器的纯文本内容");
        arr.push("编辑器的纯文本内容为：");
        arr.push(UE.getEditor('art_content').getContentTxt());
        alert(arr.join("\n"));
    }
    function hasContent() {
        var arr = [];
        arr.push("使用editor.hasContents()方法判断编辑器里是否有内容");
        arr.push("判断结果为：");
        arr.push(UE.getEditor('art_content').hasContents());
        alert(arr.join("\n"));
    }
    function setFocus() {
        UE.getEditor('art_content').focus();
    }
    function deleteEditor() {
        disableBtn();
        UE.getEditor('art_content').destroy();
    }
    function disableBtn(str) {
        var div = document.getElementById('btns');
        var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            if (btn.id == str) {
                UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
            } else {
                btn.setAttribute("disabled", "true");
            }
        }
    }
    function enableBtn() {
        var div = document.getElementById('btns');
        var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
        }
    }

    function getLocalData () {
        alert(UE.getEditor('art_content').execCommand( "getlocaldata" ));
    }

    function clearLocalData () {
        UE.getEditor('art_content').execCommand( "clearlocaldata" );
        alert("已清空草稿箱")
    }
</script>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>
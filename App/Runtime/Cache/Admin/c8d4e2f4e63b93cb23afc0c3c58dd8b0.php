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
<div class="so_main">
  <div class="page_tit"><?php echo ($position); ?>管理</div>


  <!-------- 添加编辑qq -------->
  <div id="addAttr_div" style="display:none;">
  	<div class="page_tit">添加qq群 [ <a href="javascript:void(0);" onclick="addWebSetting();">隐藏</a> ]</div>
	
	<div class="form2">
	<form method="post" action="<?php echo U('qq/addqun');?>" onsubmit="return addNewFriend();" enctype="multipart/form-data">
    <dl class="lineD">
      <dt>qq群标题：</dt>
      <dd>
        <input name="qq_title" class="input" id="qq_title" type="text" value="">
        <span>前台显示的qq群标题文字</span>
      </dd>
    </dl>
	
    <dl class="lineD">
      <dt>qq群：</dt>
      <dd>
        <input name="qq_num" class="input" id="qq_num" type="text" value="">
        <span>qq群</span>
      </dd>
    </dl>
    

    
	
    <dl class="lineD">
      <dt>显示顺序：</dt>
      <dd>
        <input name="qq_order" class="input" id="qq_order" type="text" value="0">
        <span>数字越大顺序越靠前</span>
      </dd>
    </dl>
	
    
	
    <dl class="lineD">
      <dt>是否显示：</dt>
      <dd style="overflow:hidden;">
	  	<input type="radio" name="is_show" id="yes" value="1" checked="checked" /><label for="yes">是</label>&nbsp;&nbsp;&nbsp;<input type="radio" name="is_show" id="no" value="0" /><label for="no">否</label>
        <span></span>
      </dd>
    </dl>
		 
    <div class="page_btm">
	  <input type="hidden" name="fid" id="fid" value="" disabled="disabled" />
      <input type="hidden" name="type" id="type" value="1"  />
      <input type="submit" class="btn_b" id="showwait" onclick="addNewSetting();" value="添加" />
    </div>
	</form>
  </div>
  </div>
  
<div class="suggestion_wrap" id="suggestion_wrap" style="display:none">
	<div class="suggestion_box">
		<ul id="suggestion_con">
		</ul>
	</div>
</div>
<script type="text/javascript">
var show_sn;
</script>
 <script type="text/javascript">

 
 function addNewFriend(){
 	var title=$("#qq_title").val();
 	var num=$("#qq_num").val();
	
	if(title==""){
		ui.error('qq群标题不能为空');
		$("#qq_title").focus();
		return false;
	}else if(num==""){
		ui.error('qq群不能不填');
		$("#link_href").focus();
		return false;
	}else{
		return true;
	}
}

var isSearchHidden = 1;
function addWebSetting(s) {

	if(!arguments[0]){
		F_isSearchHidden = 0;
		searchFriend(4);
	}

	if(isSearchHidden == 1) {
		$("#addAttr_div").slideDown("fast");
		$(".addAttr_action").html("添加完毕");
		isSearchHidden = 0;
	}else {
		$("#addAttr_div").slideUp("fast");
		$(".addAttr_action").html("添加qq群");
		isSearchHidden = 1;
	}
}
</script> 
  
<!--添加友情链接-->

  <!-------- 搜索友情链接 -------->
  
<script type="text/javascript">
var F_isSearchHidden = 1;
function searchFriend(s) {
	
	if(!arguments[0]){
		isSearchHidden = 0;
		addWebSetting(4);
	}
	
	if(F_isSearchHidden == 1) {
		$("#searchFriend_div").slideDown("fast");
		$(".searchFriend_action").html("搜索完毕");
		F_isSearchHidden = 0;
	}else {
		$("#searchFriend_div").slideUp("fast");
		$(".searchFriend_action").html("搜索qq群");
		F_isSearchHidden = 1;
	}
}
</script>

  <div class="Toolbar_inbox">
  	<div class="page right"><?php echo ($pagebar); ?></div>
	<a onclick="addWebSetting();" class="btn_a" href="javascript:void(0);">
		<span class="addAttr_action">添加qq群</span>
	</a>
	
  </div>
  
  <div class="list">
  <table id="area_list" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th style="width:30px;">
        <input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
        <label for="checkbox"></label>
    </th>
    <th class="line_l">ID</th>
    <th class="line_l">qq群标题</th>
    <th class="line_l">qq群号码</th>
    
    <th class="line_l">是否显示</th>
    <th class="line_l">排序</th>
    <th class="line_l">操作</th>
  </tr>
  	<?php $_REQUEST['p'] = isset($_REQUEST['p'])?$_REQUEST['p']:0; $cpage = (intval($_REQUEST['p'])<=1)?0:intval($_REQUEST['p']); $j=($cpage*C('ADMIN_PAGE_SIZE') + 1); ?>
  <?php if(is_array($qq_list)): $i = 0; $__LIST__ = $qq_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr overstyle='on' id="area_<?php echo ($vo["id"]); ?>">
        <td><input type="checkbox" name="checkbox" id="checkbox2" onclick="checkon(this)" value="<?php echo ($vo["id"]); ?>"></td>
        <td><?php echo $j; ?></td>
        <td><span id="title_<?php echo ($vo['id']); ?>"><?php echo ($vo["qq_title"]); ?></span></td>
        <td><span id="num_<?php echo ($vo['id']); ?>"><?php echo ($vo["qq_num"]); ?></span></td>
       
		<td><span id="is_show_<?php echo ($vo['id']); ?>"><?php echo ($vo["is_show"]); ?></span></td>
		<td><span id="qq_order_<?php echo ($vo['id']); ?>"><?php echo ($vo["qq_order"]); ?></span></td>
        <td>
            <a href="javascript:void(0);" onclick="edit_f(<?php echo ($vo['id']); ?>);">编辑</a> 
            <a href="javascript:void(0);" onclick="del_f(<?php echo ($vo['id']); ?>);">删除</a>  
        </td>
      </tr>
	<?php $j++; endforeach; endif; else: echo "" ;endif; ?>
  </table>

  </div>
  <div class="Toolbar_inbox">
  	<div class="page right"><?php echo ($pagebar); ?></div>
	<a onclick="addWebSetting();" class="btn_a" href="javascript:void(0);">
		<span class="addAttr_action">添加qq群</span>
	</a>
	
  </div>
</div>
<script type="text/javascript">

	var ps = '<?php echo ($position); ?>';
	var type = '<?php echo ($type); ?>';
    //编辑地区
    function edit_f(par_id) {
		$("#fid").attr("disabled","");
		var title = $("#title_"+par_id).html();
		var num = $("#num_"+par_id).html();
		var is_show = $("#is_show_"+par_id).html();
		var qq_order = $("#qq_order_"+par_id).html();
		
		
		if(is_show=="是") s_r = 1;
		else s_r = 0;
		
		$("#fid").val(par_id);
		$("#qq_title").val(title);
		$("#qq_num").val(num);
		$("#qq_order").val(qq_order);
		$("input:[type=radio]:[value='"+s_r+"']").attr("checked",true);
		
		$("#area_"+par_id).remove();
		isSearchHidden = 1;
		addWebSetting();
		
    }
    
    //删除
    function del_f(aid) {
        aid = aid ? aid : getChecked();
        aid = aid.toString();
        if(aid == '') return false;

		//提交修改
		var datas = {'idarr':aid,'type':type};
		$.post('__URL__/doDeletequn', datas,delResponseF,'json');
    }
	
	function delResponseF(res){
				if(res.success == '0') {
					ui.error('删除失败');
				}else {
					aid = res.aid.split(',');
					$.each(aid, function(i,n){
						$('#area_'+n).remove();
					});
					ui.success('删除成功');
				}
	}	
    //鼠标移动表格效果
    $(document).ready(function(){
        $("tr[overstyle='on']").hover(
          function () {
            $(this).addClass("bg_hover");
          },
          function () {
            $(this).removeClass("bg_hover");
          }
        );
    });
    
    function checkon(o){
        if( o.checked == true ){
            $(o).parents('tr').addClass('bg_on') ;
        }else{
            $(o).parents('tr').removeClass('bg_on') ;
        }
    }
    
    function checkAll(o){
        if( o.checked == true ){
            $('input[name="checkbox"]').attr('checked','true');
            $('tr[overstyle="on"]').addClass("bg_on");
        }else{
            $('input[name="checkbox"]').removeAttr('checked');
            $('tr[overstyle="on"]').removeClass("bg_on");
        }
    }

    //获取已选择用户的ID数组
    function getChecked() {
        var gids = new Array();
        $.each($('input:checked'), function(i, n){
            gids.push( $(n).val() );
        });
        return gids;
    }
</script>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>
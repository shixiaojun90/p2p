<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript" src="__ROOT__/Style/Js/ajaxfileupload.js"></script>
<style type="text/css">
	.alertDiv { margin: 0px auto; background-color: #FEFACF; border: 1px solid green; line-height: 25px; background-image: url(__ROOT__/Style/M/images/info/001_30.png); background-position: 20px 4px; background-repeat: no-repeat; }
	.btnsave { background-image: url(__ROOT__/Style/M/images/btnsave.jpg); background-repeat: no-repeat; cursor: pointer; width: 74px; height: 26px; border: none; }
	.alertDiv li { margin: 5px 0; list-style-type: decimal; color: #005B9F; padding: 0px; line-height: 20px; }
	.alertDiv ul { text-align: left; list-style-type: decimal; display: block; padding: 0px; margin: 0px 0px 0px 75px; }
	.tdContent { text-align: left; border-bottom: dashed 1px #ccc; font-size: 12px; height: 32px; color: #000; text-indent: 20px; line-height: 32px; }
	.tdEven { background-color: #E8F9F9; }
	.tdHeard { text-align: center; vertical-align: middle; font-size: 12px; font-weight: bold;  height: 25px;  background-color: #F5F5F5; border: 1px #FFF solid; }
	.upfile { width: 195px; border: 1px solid #ccc; background-color: #f9f9f9; margin-right: 4px; vertical-align: middle; height: 22px; cursor: default; line-height: 24px; }
	.trBg { border-top: 1px solid #dedede; border-bottom: 1px solid #dedede; background-color: #f6f6f6; width: 100%; }
	.tdHeard { border: 0px; border-bottom: 1px solid #dedede; border-top: 1px solid #dedede; }
	.tdContent { border: 0px; border-bottom: 1px solid #dedede; height: 32px; }
	.dv_header_8 { background-image: url(); }
	.dv_account_0 { margin-top: 10px; }
	.tdContent{padding-left:0px}
</style>


<div style="text-align: left; padding: 2px 0px 0px 8px; width: 100%;">
	上传文件
	<input name="uploadFile" id="uploadFile" class="upfile" type="file"><br />
    请输入文件名字：
<input style="height:20px;border: 1px solid #ccc; margin:5px 0 5px 17px; padding-right:4px; background-color: #f9f9f9; line-height:20px" type="text" id="filetxt"  /><br />
<select name="data_type" id="data_type" style="padding:3px"  class="c_select"><option value="">--请选择--</option><?php foreach($to_upload_type as $key=>$v){ if($_X[""]==$key && $_X[""]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select><span id="tip_data_type" class="tip">资料分类</span>&nbsp;&nbsp;&nbsp;
	<input id="btnUpload" value=" " class="thickbox" title="上传文件" style="width: 55px;	border: none; background-image: url(__ROOT__/Style/M/images/account/fileupload.jpg);border: none; cursor: pointer; height: 20px; margin-right:0px;" type="button" onclick="upfile();"><span style="margin-left:10px; margin-right:0px"><img id="loading_makeclub" style="visibility:hidden" src="__ROOT__/Style/Js/loading.gif" /></span>
</div>
<div style="height:auto; margin-top: 10px; float: left; display: inline-block;text-align: left;">
	<table id="content" style="width: 803px; margin-top: 2px;
		border-collapse: collapse; " cellpadding="0" cellspacing="1">
		<tbody><tr class="trBg">
			<th scope="col" class="tdHeard" style="width: 180px; height: 36px; text-align: left;padding-left: 20px;">
				文件名
			</th>
			<th scope="col" class="tdHeard">
				文件类型
			</th>
			<th scope="col" class="tdHeard">
				大小
			</th>
			<th scope="col" class="tdHeard">
				资料分类
			</th>
			<th scope="col" class="tdHeard">
				审核状态
			</th>
			<th scope="col" class="tdHeard">
				操作(说明)
			</th>
		</tr>
		
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vx): $mod = ($i % 2 );++$i;?><tr class="tdEven" id="xf_<?php echo ($vx["id"]); ?>">
		<td class="tdContent" style="width: 350px;text-align:left;text-indent:10px;" title="<?php echo ($vx["data_name"]); ?>"><?php echo (cnsubstr($vx["data_name"],8)); ?></td>
		<td class="tdContent"><?php echo ($vx["ext"]); ?></td>
		<td class="tdContent"><?php echo (setmb($vx["size"])); ?></td>
		<td class="tdContent"><?php echo ($Bconfig['DATA_TYPE'][$vx['type']]); ?></td>
		<td class="tdContent"><?php echo ($Bconfig['DATA_STATUS'][$vx['status']]); ?></td>
		<td class="tdContent">
        <?php if($vx["status"] == 0): ?><input id="btndel" value=" " style="width: 55px; height: 20px; border: none;background-image: url(__ROOT__/Style/M/images/account/filedelete.jpg);cursor: pointer; border: none;" type="button" onclick="delfile(<?php echo ($vx["id"]); ?>);">
    	<?php elseif($vx["status"] == 1): ?>
        加<?php echo (($vx["deal_credits"])?($vx["deal_credits"]):0); ?>个积分
        <?php else: ?>
	<input title="<?php echo ($vx["deal_info"]); ?>" id="btndel" value=" " style="width: 55px; height: 20px; border: none;background-image: url(__ROOT__/Style/M/images/account/filedelete.jpg);cursor: pointer; border: none;" type="button" onclick="delfile(<?php echo ($vx["id"]); ?>);"><?php endif; ?> | <a href="__ROOT__/<?php echo ($vx["data_url"]); ?>" target="_blank">查看</a>
		</td>
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	<tr><td colspan="6" class="ajaxpagebar"  data="info6"><?php echo ($page); ?></td></tr>
	</tbody>
	</table>

</div>
<script type="text/javascript">
$('.ajaxpagebar a').click(function(){
	try{	
		var geturl = $(this).attr('href');
		var id = $(this).parent().attr('data');
		var x={};
        $.ajax({
            url: geturl,
            data: x,
            timeout: 5000,
            cache: false,
            type: "get",
            dataType: "json",
            success: function (d, s, r) {
              	if(d) $("#"+id).html(d.content);//更新客户端竞拍信息 作个判断，避免报错
            }
        });
	}catch(e){};
	return false;
})

function delfile(id){
	if(!confirm("删除后不可恢复，确定要删除吗?")) return;
        $.ajax({
            url: "__URL__/delfile",
            data: {"id":id},
            timeout: 5000,
            cache: false,
            type: "post",
            dataType: "json",
            success: function (d, s, r) {
              	if(d){
					if(d.status==1){
						$.jBox.tip("删除成功",'success');
						$("#xf_"+id).remove();
					}else{
						$.jBox.tip(d.message,'fail');
					}
				}
            }
        });
}

function upfile()
{
	$("#loading_makeclub").ajaxStart(function(){	$(this).css("visibility","visible");	}).ajaxComplete(function(){	$(this).css("visibility","hidden");	});
	var name = $("#filetxt").val();
	var fname = $("#uploadFile").val();
	var data_type = $("#data_type").val();
	if(fname==""){
		$.jBox.tip("请先选择要上传的文件",'tip');
		return;
	}
	if(data_type==""){
		$.jBox.tip("请选择资料分类",'tip');
		return;
	}
	if(name=="文件名称" || name==""){
		$.jBox.tip("请输入此上传文件的文件名",'tip');
		return;
	}
	$.jBox.tip("上传中......","loading");
	$.ajaxFileUpload({
			url:'__URL__/editdata/?name='+name+'&data_type='+data_type,
			secureuri:false,
			fileElementId:'uploadFile',
			dataType: 'json',
			success: function (data, status)
			{
				if(data.status==1){
					$("#uploadFile").val('');
					$("#filetxt").val('');
					$.jBox.tip(data.message,'success');
					updatedata();
				}
				else  $.jBox.tip(data.message,'fail');
			}
		})
}

function updatedata(){
        $.ajax({
            url: "__URL__/editdata/",
            data: {},
            timeout: 5000,
            cache: false,
            type: "get",
            dataType: "json",
            success: function (d, s, r) {
              	if(d) $("#fragment-7").html(d.html);//更新客户端信息 作个判断，避免报错
            }
        });
}
</script>
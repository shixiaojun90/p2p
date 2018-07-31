<?php if (!defined('THINK_PATH')) exit();?>
<style type="text/css">
.tdHeard, .tdContent { border: solid 1px #ccc; }
#pager { margin: 10px 4px 3px 0px; }
.notes_frame { width: 785px; overflow: hidden; margin: 0 auto; height: 50px; margin-top: 10px; }
.notes_frame div { padding-top: 15px; }
.operaframe { width: 100%; overflow: hidden; line-height: 27px; padding-left: 25px; margin-top: 20px; }
.operaframe ul { padding: 0px; margin: 0px; text-align: left; overflow: hidden; line-height: 25px; }
.operaframe ul li { float: left; line-height: 25px; }
</style>

<div class="notes_frame">
	<div>
		信用积分:<font style="color:red;font-size:18px; font-weight:bolder"><?php echo (($user['credits'])?($user['credits']):0); ?>分</font>,信用等级:<font style="color:red;font-size:18px; font-weight:bolder"><?php echo (getleveico($user["credits"],3)); ?>级</font>
	</div>
</div>
<div style="margin-top: 20px; overflow: hidden; text-align: left;">
	<table id="content" style="width: 787px; border-collapse: collapse;margin-left: 8px;" cellspacing="0">
		<tbody><tr>
			<th scope="col" class="tdHeard" style="width: 150px;">发生日期</th>
			<th scope="col" class="tdHeard" style="width: 100px;">影响积分</th>
			<th scope="col" class="tdHeard" style="width: 100px;">剩余积分</th>
			<th scope="col" class="tdHeard" style="width: 80px;">说明</th>
		</tr>
	
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="nodatashowtr">
		<td class="tdContent"><?php echo (date("Y-m-d H:i",$vo["add_time"])); ?></td>
		<td class="tdContent"><?php echo ($vo["affect_credits"]); ?></td>
		<td class="tdContent"><?php echo ($vo["account_credits"]); ?></td>
		<td class="tdContent"><?php echo ($vo["info"]); ?></td>
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</tbody></table>
	<div data="fragment-1" id="pager" style="float: right; text-align: right; width: 500px; padding-right: 3px;" class="yahoo2 ajaxpagebar"><?php echo ($pagebar); ?></div>
</div>
<div style="clear: both; float: none;">
</div>

<script type="text/javascript">
//返回数字
function NumberCheck(t){
	var num = t.value;
	var re=/^\d+\.?\d*$/;
	if(!re.test(num)){
		isNaN(parseFloat(num))?t.value=0:t.value=parseFloat(num);
	}
}

function sdetail(){
	
	x = makevar(['log_type','start_time','end_time']);
	$.ajax({
		url: "__URL__/integraldetail",
		data: x,
		timeout: 5000,
		cache: false,
		type: "get",
		dataType: "json",
		success: function (d, s, r) {
			if(d) $("#fragment-2").html(d.html);//更新客户端竞拍信息 作个判断，避免报错
		}
	});
}

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
              	if(d) $("#"+id).html(d.html);//更新客户端竞拍信息 作个判断，避免报错
            }
        });
	}catch(e){};
	return false;
})
</script>
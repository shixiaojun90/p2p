<?php if (!defined('THINK_PATH')) exit();?>
<style type="text/css">
.tdHeard, .tdContent { border: solid 1px #ccc; }
#pager { margin: 10px 4px 3px 0px; }
.notes_frame { width: 715px; overflow: hidden; margin: 0 auto; height: 20px; margin-top: 10px; }
.notes_frame div { padding-top: 13px; }
.operaframe { width: 720px; overflow: hidden; line-height: 27px; padding-left: 25px; margin-top: 20px; }
.operaframe ul { padding: 0px; margin: 0px; text-align: left; overflow: hidden; line-height: 25px; }
.operaframe ul li { float: left; line-height: 25px; }
</style>

<!--选择操作-->
<div class="operaframe">
	<ul id="formTb">
		<li style="width: 70px;"><strong>投资类别：</strong> </li>
		<li style="width: 180px;">
			<select name="borrow_type" id="borrow_type"   class="c_select Wdate timeInput_Day"><option value="">--请选择--</option><?php foreach($borrow_type as $key=>$v){ if($search["borrow_type"]==$key && $search["borrow_type"]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select>
		</li>
		<li style="width: 70px;"><strong>起止日期：</strong> </li>
		<li style="width: 240px;">
			<input type="text" id="start_time2" value="<?php if($search['start_time2']){echo date('Y-m-d',$search['start_time2']);} ?>" readonly="readonly" class="Wdate timeInput_Day" onFocus="WdatePicker({maxDate:'#F{$dp.$D(\'end_time2\')||\'2020-10-01\'}'})"/>
			至
			<input type="text" value="<?php if($search['end_time2']){echo date('Y-m-d',$search['end_time2']);} ?>" id="end_time2" readonly="readonly" class="Wdate timeInput_Day" onFocus="WdatePicker({minDate:'#F{$dp.$D(\'start_time2\')||\'2020-10-01\'}'})"/>
		</li>
		<li style="width: 120px;">
			<img alt="" src="__ROOT__/Style/M/images/chakan.jpg" id="btn_search" onclick="sdetail2()" style="cursor: pointer;">
		</li>
	</ul>
</div>
<div style="margin-top: 20px; overflow: hidden; text-align: left;">
	<table id="content" style="width: 785px; border-collapse: collapse;
		margin-left: 8px;" cellspacing="0">
		<tbody><tr>
			<th scope="col" class="tdHeard" style="width: 150px;">
				借款标号
			</th>
			<th scope="col" class="tdHeard" style="width: 160px;">
				还款方式
			</th>
			<th scope="col" class="tdHeard" style="width: 100px;">
				借款金额
			</th>
			<th scope="col" class="tdHeard" style="width: 100px;">
				借款进度
			</th>
			<th scope="col" class="tdHeard" style="width: 120px;">
				借款时间
			</th>
			<th scope="col" class="tdHeard" style="width: 80px;">
				操作
			</th>
		</tr>
	
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="nodatashowtr">
		<td class="tdContent"><a href="/invest/<?php echo ($vo["id"]); ?>.html" title="<?php echo ($vo["borrow_name"]); ?>"><?php echo ($vo["id"]); ?></a></td>
		<td class="tdContent"><?php echo ($vo["repayment_type"]); ?></td>
		<td class="tdContent"><?php echo ($vo["borrow_money"]); ?></td>
		<td class="tdContent"><?php echo ($vo["progress"]); ?>%</td>
		<td class="tdContent"><?php echo (date("Y-m-d H:i",$vo["add_time"])); ?></td>
		<td class="tdContent"><a href="javascript:;" onclick="cancel(<?php echo ($vo["id"]); ?>,this);">撤消</a></td>
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</tbody></table>
	<div data="fragment-2" id="pager" style="float: right; text-align: right; width: 500px; padding-right: 0px;" class="yahoo2 ajaxpagebar"><?php echo ($pagebar); ?></div>
</div>
<div style="clear: both; float: none;">
</div>

<script type="text/javascript">
function cancel(id,obj){
	if(!confirm("您确定要撤消此借款吗？")) return;
	$.ajax({
		url: "__URL__/cancel",
		data: {"id":id},
		timeout: 5000,
		cache: false,
		type: "post",
		dataType: "json",
		success: function (d, s, r) {
			if(d){
				if(d.status==1){
					$.jBox.tip(d.message,'success');	
					$(obj).replaceWith("已撤消");
				}else{
					$.jBox.tip(d.message,'fail');	
				}
			}
		}
	});
}
function sdetail2(){
	x = makevar(['borrow_type','start_time2','end_time2']);
	$.ajax({
		url: "__URL__/borrowing",
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
<?php if (!defined('THINK_PATH')) exit();?>
<style type="text/css">
.tdHeard, .tdContent { border: solid 1px #ccc; }
#pager { margin: 10px 4px 3px 0px; }
.notes_frame { width: 715px; overflow: hidden; margin: 0 auto; height: 30px; margin-top: 10px; }
.notes_frame div { padding-top: 13px; }
.operaframe { width: 735px; overflow: hidden; line-height: 27px; padding-left: 25px; margin-top: 20px; }
.operaframe ul { padding: 0px; margin: 0px; text-align: left; overflow: hidden; line-height: 25px; }
.operaframe ul li { float: left; line-height: 25px; }
</style>

<div class="notes_frame">
	<div style="">
		<span>资金历史记录了您各种交易产生的支出和收入的明细，请选择事件类型和时间，然后点击“查看”按钮浏览。</span>
	</div>
</div>
<!--选择操作-->
<div class="operaframe">
	<ul id="formTb">
		<li style="width: 70px;"><strong>事件类型：</strong> </li>
		<li style="width: 180px;">
			<select name="log_type" id="log_type"   class="c_select"><option value="">--请选择--</option><?php foreach($log_type as $key=>$v){ if($search["log_type"]==$key && $search["log_type"]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select><span id="tip_log_type" class="tip">*</span>
		</li>
		<li style="width: 70px;"><strong>起止日期：</strong> </li>
		<li style="width: 240px;">
			<input type="text" id="start_time" value="<?php if($search['start_time']){echo date('Y-m-d',$search['start_time']);} ?>" readonly="readonly" class="Wdate timeInput_Day" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'end_time\')||\'2020-10-01\'}'})"/>
			至
			<input type="text" value="<?php if($search['end_time']){echo date('Y-m-d',$search['end_time']);} ?>" id="end_time" readonly="readonly" class="Wdate timeInput_Day" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'start_time\')||\'2020-10-01\'}'})"/>
		</li>
		<li style="width: 100px;">
			<img alt="" src="__ROOT__/Style/M/images/chakan.jpg" id="btn_search" onclick="sdetail()" style="cursor: pointer;" />
		</li>
		<li><a href="__URL__/export?<?php echo ($query); ?>" style="vertical-align: bottom;line-height: 20px;">下载</a> </li>
	</ul>
</div>
<div style="margin-top: 20px; overflow: hidden; text-align: left;">
	<table id="content" style="width: 764px; border-collapse: collapse;margin-left: 19px;" cellspacing="0">
		<tbody><tr>
			<th scope="col" class="tdHeard" style="width: 130px;">发生日期</th>
			<th scope="col" class="tdHeard" style="width: 100px;">类型</th>
			<th scope="col" class="tdHeard" style="width: 100px;">影响金额</th>
			<th scope="col" class="tdHeard" style="width: 100px;">可用余额</th>
			<th scope="col" class="tdHeard" style="width: 100px;">冻结金额</th>
			<th scope="col" class="tdHeard" style="width: 100px;">待收金额</th>
			<th scope="col" class="tdHeard" style="width: 80px;">说明</th>
		</tr>
	
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="nodatashowtr">
		<td class="tdContent"><?php echo (date("Y-m-d H:i",$vo["add_time"])); ?></td>
		<td class="tdContent"><?php echo ($vo["type"]); ?></td>
		<td class="tdContent"><?php if($vo["affect_money"] < 0): ?><font color="#FF0000"><?php else: ?><font color="#009900"><?php endif; echo ($vo["affect_money"]); ?></font></font></td>
		<td class="tdContent"><?php echo ($vo['account_money']+$vo['back_money']); ?></td>
		<td class="tdContent"><?php echo ($vo["freeze_money"]); ?></td>
		<td class="tdContent"><?php echo ($vo["collect_money"]); ?></td>
		<td class="tdContent"><?php echo ($vo["info"]); ?></td>
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</tbody></table>
	<div data="fragment-2" id="pager" style="float: right; text-align: right; width: 700px; padding-right: 0px;" class="yahoo2 ajaxpagebar"><?php echo ($pagebar); ?></div>
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
		url: "__URL__/detail",
		data: x,
		timeout: 5000,
		cache: false,
		type: "get",
		dataType: "json",
		success: function (d, s, r) {
			if(d) $("#fragment-2").html(d.html);//更新客户端信息 作个判断，避免报错
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
              	if(d) $("#"+id).html(d.html);//更新客户端信息 作个判断，避免报错
            }
        });
	}catch(e){};
	return false;
})
</script>
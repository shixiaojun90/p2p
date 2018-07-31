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
<!--选择操作-->
<div class="operaframe">
	<ul id="formTb">
		<li style="width: 70px;"><strong>投资类别：</strong> </li>
		<li style="width: 180px;">
			<select name="borrow_type" id="borrow_type"   class="c_select Wdate timeInput_Day"><option value="">--请选择--</option><?php foreach($borrow_type as $key=>$v){ if($search["borrow_type"]==$key && $search["borrow_type"]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select>
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
<div style="margin: 10px 0px; overflow: hidden; text-align: left; clear: both; float: left;padding-left: 8px;">
	<table id="content" style="width: 785px; border-collapse: collapse;" cellspacing="0">
		<tbody>
	<tr>
		<th style="width: 63px;" class="tdHeard" scope="col">
			借款标号
		</th>
		<th style="width: 103px;" class="tdHeard" scope="col">
			借入人
		</th>
		<th style="width: 93px;" class="tdHeard" scope="col">
			投资金额
		</th>
		<th style="width: 63px;" class="tdHeard" scope="col">
			已还本息
		</th>
		<th style="width: 73px;" class="tdHeard" scope="col">
			年化利率
		</th>
		<th style="width: 163px;" class="tdHeard" scope="col">
			已还/总期数(还款期)
		</th>
		<th class="tdHeard" style="width: 50px;" scope="col">
			备注
		</th>
	</tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="noinfotip" style="">
			<td class="tdContent"><a href="<?php echo (getinvesturl($vo["borrow_id"])); ?>" title="<?php echo ($vo["borrow_name"]); ?>" target="_blank"><?php echo ($vo["borrow_id"]); ?></a></td>
			<td class="tdContent"><?php echo ($vo["borrow_user"]); ?></td>
			<td class="tdContent"><?php echo ($vo["investor_capital"]); ?></td>
			<td class="tdContent"><?php echo ($vo['receive_capital'] + $vo['receive_interest']); ?></td>
			<td class="tdContent"><?php echo ($vo["borrow_interest_rate"]); ?>%</td>
			<td class="tdContent"><?php echo (($vo["back"])?($vo["back"]):"0"); ?>/<?php echo ($vo["total"]); ?>(<?php echo (date("Y-m-d",$vo["repayment_time"])); ?>)(<a href="__URL__/tendoutdetail?id=<?php echo ($vo["id"]); ?>" target="_blank">详情</a>)</td>
			<td class="tdContent">
            <?php if($vo["period"] > 0 and $vo["detb_status"] == 1 and $vo["debt_uid"] == $uid): ?>购买 <?php echo ($vo["period"]); ?>期债权
            <?php elseif($vo["period"] > 0 and $vo["detb_status"] == 1): ?>
            转让 <?php echo ($vo["period"]); ?>期债权
            
            <?php else: ?>
            <a href="__APP__/member/agreement/downfile?id=<?php echo ($vo["id"]); ?>" target="_blank">合同</a><?php endif; ?>
            </td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</tbody></table>
<div data="fragment-3" id="pager" style="float: right; text-align: right; width: 500px; padding-right: 0px;" class="yahoo2 ajaxpagebar"><?php echo ($pagebar); ?></div>
</div>
<div style="clear: both;">
</div>

<script type="text/javascript">
function sdetail(){
	x = makevar(['borrow_type','start_time','end_time']);
	$.ajax({
		url: "__URL__/tendbacking",
		data: x,
		timeout: 5000,
		cache: false,
		type: "get",
		dataType: "json",
		success: function (d, s, r) {
			if(d) $("#fragment-3").html(d.html);//更新客户端竞拍信息 作个判断，避免报错
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
              	if(d) $("#"+id).html(d.html);//更新客户端 作个判断，避免报错
            }
        });
	}catch(e){};
	return false;
})
</script>
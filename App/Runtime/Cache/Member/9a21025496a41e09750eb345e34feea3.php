<?php if (!defined('THINK_PATH')) exit();?>
<style type="text/css">
.fontred { color: #005B9F; }
.infolist { margin: 5px 0 10px 20px; border: solid 1px #ddd; padding: 2px; width: 715px; text-align: left; }
.infolist table td { height: 28px; }
.infolist .myfont { color: #ff6500; font-weight: bold; }
#pager a.current { background-color: #ddd; border: solid 1px #ccc; color: #fff; }
#pager a:hover { background-color: #ddd; border: solid 1px #ccc; color: red; }
.tdHeard, .tdContent { border: solid 1px #ccc; }
.tdHeard { background-image: url(__ROOT__/Style/H/images/thbg.jpg); height: 29px; }
.divtitle { height: 20px; line-height: 30px; text-align: left; padding-left: 20px; font-size: 12px; text-indent: 25px; margin-top: 8px; margin-bottom: 1PX; }
#noinfotip .tdContent{width:auto}
.tdContent a{color:#06F; text-decoration:none}
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
<div style="margin: 20px 0px; overflow: hidden; text-align: left; clear: both; float: left;
	padding-left: 8px; width: 785px;">
	<table id="content" style="width: 785px; border-collapse: collapse;" cellspacing="0">
		<tbody>
		<tr style="height:30px; background:#F6F6F6; font-weight:bold;">
        <th class="tdHeard">借款标号</th>
        <!-- <th class="tdHeard">借款标题</th> -->
        <th class="tdHeard">借入人</th>
        <th class="tdHeard">年化利率</th>
        <th class="tdHeard">逾期天数</th>
        <th class="tdHeard">待收本金</th>
        <th class="tdHeard">待收利息</th>
        <th class="tdHeard">当前/总(期)</th>
        </tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr id="noinfotip" style="">
			<td class="tdContent"><a href="<?php echo (getinvesturl($vo["borrow_id"])); ?>" title="<?php echo ($vo["borrow_name"]); ?>" target="_blank"><?php echo ($vo["borrow_id"]); ?></a></td>
			<!-- <td class="tdContent"><a href="<?php echo (getinvesturl($vo["borrow_id"])); ?>" target="_blank"><?php echo ($vo["borrow_name"]); ?></a></td> -->
			<td class="tdContent"><?php echo ($vo["borrow_user"]); ?></td>
			<td class="tdContent"><?php echo ($vo["borrow_interest_rate"]); ?>%</td>
			<td class="tdContent"><?php echo ($vo["breakday"]); ?></td>
			<td class="tdContent"><?php echo ($vo["capital"]); ?></td>
			<td class="tdContent"><?php echo ($vo["interest"]); ?></td>
			<td class="tdContent"><?php echo ($vo["sort_order"]); ?>/<?php echo ($vo["total"]); ?></td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</tbody></table>
<div data="fragment-4" id="pager" style="float: right; text-align: right; width: 500px; padding-right:0px;" class="yahoo2 ajaxpagebar"><?php echo ($pagebar); ?></div>
</div>
<div style="clear: both;">
</div>

<script type="text/javascript">
function sdetail(){
	x = makevar(['borrow_type','start_time','end_time']);
	$.ajax({
		url: "__URL__/tendbreak",
		data: x,
		timeout: 5000,
		cache: false,
		type: "get",
		dataType: "json",
		success: function (d, s, r) {
			if(d) $("#fragment-4").html(d.html);//更新客户端竞拍信息 作个判断，避免报错
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
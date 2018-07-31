<?php if (!defined('THINK_PATH')) exit();?>
<style type="text/css">
.tdHeard, .tdContent { border: solid 1px #ccc; }
#pager { margin: 10px 4px 3px 0px; }
.notes_frame { width: 715px; overflow: hidden; margin: 0 auto; height: 30px; margin-top: 10px; }
.notes_frame div { padding-top: 13px; }
.operaframe { width: 100%; overflow: hidden; line-height: 27px; padding-left: 25px; margin-top: 20px; }
.operaframe ul { padding: 0px; margin: 0px; text-align: left; overflow: hidden; line-height: 25px; }
.operaframe ul li { float: left; line-height: 25px; }
</style>

<div class="top_account_bg" style="overflow:hidden; height:50px; line-height:25px">
	<img src="__ROOT__/Style/H/images/ministar.gif" style="margin-right: 5px;">‘<?php echo ($list["name"]); ?>’的还款明细
</div>
<!--选择操作-->
<div style="margin-top: 10px; overflow: hidden; text-align: left;">
	<table id="content" style="width: 720px; border-collapse: collapse;margin-left: 6px;" cellspacing="0">
		<tbody><tr>
			<th scope="col" class="tdHeard" style="width: 150px;">
				计划还款日期
			</th>
			<th scope="col" class="tdHeard" style="width: 160px;">
				计划还款本金
			</th>
			<th scope="col" class="tdHeard" style="width: 100px;">
				计划还款利息
			</th>
			<th scope="col" class="tdHeard" style="width: 80px; text-align:center">
				实还本息
			</th>
			<th scope="col" class="tdHeard" style="width: 80px; text-align:center">
				需还本息
			</th>
			<th scope="col" class="tdHeard" style="width: 80px;">
				还款状态
			</th>
			<th scope="col" class="tdHeard" style="width: 80px; text-align:center">
				还款
			</th>
		</tr>
	
	<?php if(is_array($list["list"])): $i = 0; $__LIST__ = $list["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="nodatashowtr">
		<td class="tdContent"><?php echo (date("Y-m-d H:i",$vo["deadline"])); ?></td>
		<td class="tdContent"><?php echo ($vo["capital"]); ?></td>
		<td class="tdContent"><?php echo ($vo["interest"]); ?></td>
		<td class="tdContent"><?php if($vo['needpay'] == 0): echo ($vo["paid"]); else: ?>0<?php endif; ?></td>
		<td class="tdContent"><?php if($vo['needpay'] == 0): ?>0<?php else: echo ($vo['needpay']+$vo['paid']); endif; ?></td>
		<td class="tdContent"><?php echo ($vo["status"]); ?></td>
		<td class="tdContent">
            <?php if($vo['needpay'] == 0): ?>---
            <?php else: ?>
            <a href="javascript:;" onclick="repayment(<?php echo ($vo["borrow_id"]); ?>,<?php echo ($vo["sort_order"]); ?>)">还款</a>
            <!--a href="__URL__/repayment?bid=<?php echo ($vo["borrow_id"]); ?>&sort_order=<?php echo ($vo["sort_order"]); ?>&<?php echo rand(100,999);?>" target="_self">还款</a--><?php endif; ?>
            
        </td>
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</tbody></table>
	<div data="fragment-2" id="pager" style="float: right; text-align: right; width: 550px; padding-right: 8px;margin-right: 24px;" class="yahoo2 ajaxpagebar"><?php echo ($pagebar); ?></div>
</div>
<div style="clear: both; float: none;">
</div>

<script type="text/javascript">
function myrefresh()
{
	var geturl = $(this).attr('href');
	var id = $(this).parent().attr('data');
    window.location.reload();
	//window.location.href="/member/borrowdetail?id="+id+"#fragment-1";
}
function repayment(bid,sort_order){
    x = {"bid":bid,"sort_order":sort_order};
    $.jBox.tip("还款中......",'loading');
    $.ajax({
        url: "__URL__/repayment",
        data: x,
        timeout: 15000,
        cache: false,
        type: "get",
        dataType: "json",
        success: function (d, s, r) {
            if(d){
                if(d.status==1){
                    $.jBox.tip("还款成功",'success');
                }else{
                    $.jBox.tip(d.message,'fail');
                }
            }
        },
        complete:function(XMLHttpRequest, textStatus){
            setTimeout('myrefresh()',3000); //指定3秒刷新,系统提示停留时间
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
              	if(d) $("#"+id).html(d.html);//更新
            }
        });
	}catch(e){};
	return false;
})

</script>
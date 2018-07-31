<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
	.tdTitle { text-align: right; padding-left: 10px; font-size: 12px; height: 40; line-height: 40px; vertical-align: middle; width: 160px; font-weight: bold; background-color: #F9F9F9; }
	.tdContent1 { text-align: left; padding-left: 10px; font-size: 12px; height: 40; line-height: 40px; vertical-align: middle; width: 535px; }
	.tdContent { line-height: 20px; border: 1px solid #ccc; }
	.tdHeard { border: 1px solid #ccc; }
</style>
<div style="height: 25px; line-height: 25px; padding: 16px 0px; width: 640px; margin-left: 56px;text-align: left; float: left;"> 截止<span class="fontred">
  <?php echo date("Y-m-d H:i:s",time()); ?>
  </span>您目前的奖金余额是：<span class="fontred"> ￥<?php echo (($CR)?($CR):0.00); ?></span>，您历史上累计获得奖金总额是：<span class="fontred"> ￥<?php echo (($totalR)?($totalR):0.00); ?></span>。 </div>
<div style="width: 100%;">
  <table id="content" style="width: 755px; margin-left: 24px; float: left;
		border-collapse: collapse;" cellspacing="0">
    <tbody>
      <tr id="tdHead">
        <th scope="col" class="tdHeard"> 编号 </th>
        <th scope="col" class="tdHeard"> 发生日期 </th>
        <th scope="col" class="tdHeard"> 奖金金额 </th>
        <th scope="col" class="tdHeard" > 余额变动事由 </th>
      </tr>
      <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="nodatashowtr">
          <td class="tdContent"><?php echo ($vo["id"]); ?></td>
          <td class="tdContent"><?php echo (date("Y-m-d H:i:s",$vo["addtime"])); ?></td>
          <td class="tdContent"><?php echo ($vo["affect_money"]); ?></td>
          <td class="tdContent"><?php echo ($vo["info"]); ?></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
  </table>
  <div style="clear: both; height: 0px;"> </div>
  <div data="fragment-2" id="pager" style="float: right; text-align: right; width: 500px; padding-right: 0px;" class="yahoo2 ajaxpagebar"><?php echo ($pagebar); ?></div>
  <div style="clear: both; height: 0px;"> </div>
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
              	if(d) $("#"+id).html(d.html);//更新客户端竞拍信息 作个判断，避免报错
            }
        });
	}catch(e){};
	return false;
})
</script>
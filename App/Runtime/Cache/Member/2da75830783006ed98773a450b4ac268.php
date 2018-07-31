<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
	.tdTitle { text-align: right; padding-left: 10px; font-size: 12px; height: 40; line-height: 40px; vertical-align: middle; width: 160px; font-weight: bold; background-color: #F9F9F9; }
	.tdContent1 { text-align: left; padding-left: 10px; font-size: 12px; height: 40; line-height: 40px; vertical-align: middle; width: 535px; }
	.tdContent { line-height: 28px; border: 1px solid #ccc; }
	.tdHeard { border: 1px solid #ccc; }
</style>
<div style="height: 25px; line-height: 25px; padding: 16px 0px; width: 708px; margin-left: 24px;text-align: left; float: left;border-bottom:#eb790d 0px solid"> 截止<span class="fontred">
  <?php echo date("Y-m-d H:i:s",time()); ?>
  </span>您成功邀请的会员有： </div>
<div style="width: 100%;">
  <table id="content" style="width: 755px; margin-left: 24px; float: left;
		border-collapse: collapse;" cellspacing="0">
    <tbody>
      <tr id="tdHead">
        <th scope="col" class="tdHeard"> 会员名单 </th>
        <th scope="col" class="tdHeard"> 注册时间 </th>
      </tr>
      <?php if(is_array($vi)): $i = 0; $__LIST__ = $vi;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vi): $mod = ($i % 2 );++$i;?><tr class="nodatashowtr">
          <td class="tdContent"><?php echo ($vi["user_name"]); ?></td>
          <td class="tdContent"><?php echo (date("Y-m-d H:i",$vi["reg_time"])); ?></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
  </table>
</div>
<div style="height: 25px; line-height: 25px; padding: 16px 0px; width: 708px; margin-left: 24px;text-align: left; float: left;border-bottom:#eb790d 0px solid"> 截止<span class="fontred">
  <?php echo date("Y-m-d H:i:s",time()); ?>
  </span>对您有投标奖励的会员有： </div>
<div style="width: 100%;">
  <table id="content" style="width: 755px; margin-left: 24px; float: left;
		border-collapse: collapse;" cellspacing="0">
    <tbody>
      <tr id="tdHead">
        <th scope="col" class="tdHeard"> 会员名单 </th>
        <th scope="col" class="tdHeard"> 奖金贡献 </th>
      </tr>
      <?php if(is_array($vm)): $i = 0; $__LIST__ = $vm;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="nodatashowtr">
          <td class="tdContent"><?php echo ($vo["user_name"]); ?></td>
          <td class="tdContent"><?php echo (($vo["jiangli"])?($vo["jiangli"]):0); ?></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
  </table>
</div>
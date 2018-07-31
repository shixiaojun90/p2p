<?php if (!defined('THINK_PATH')) exit();?><div style="margin-top: 10px;" class="tool_title" id="resultList">
	<div class='fun_title'><div>借款概述</div></div>
	<div class='funframe'>
		<ul class='rslist' style="float: left;width:340px;">
			<li><span style='width: 100px;'>综合年利率：</span> <span style='width: 180px;' class='value'><?php echo ($repay_detail["year_apr"]); ?>%</span> </li>
			<li><span style='width: 100px;'>综合月利率：</span> <span style='width: 180px;' class='value'><?php echo ($repay_detail["month_apr"]); ?>%</span> </li>
			<li><span style='width: 100px;'>综合天利率：</span> <span style='width: 180px;' class='value'><?php echo ($repay_detail["day_apr"]); ?>%</span> </li>
		</ul>
		<ul class='rslist' style="float: left;width:340px;">
			<li><span style='width: 100px;'>共投资金额：</span> <span class='value'><?php echo ($repay_detail["invest_money"]); ?></span>元</li>
			<li><span style='width: 100px;'>共返还本息：</span> <span class='value' style="font-size:24px;color:red;" style="font-size:24px;color:red;"><?php echo ($repay_detail["repayment_money"]); ?></span>元</li>
			<li style="height: 30px;margin-bottom: 0;">
				<span style='width: 100px;'>共获得利益：</span> 
				<span class='value' style="font-size:24px;color:red;"><?php echo ($repay_detail["total_interest"]); ?></span><span>元
			</li>
			<li style="height: 30px;margin: 0;">
				<span style='width:  50%;'>奖励：<font class='value'><?php echo ($repay_detail["reward_money"]); ?></font> 元</span> 
				<span style='width:  50%;'>利息：<font class='value'><?php echo ($repay_detail["interest"]); ?></font> 元</span>
			</li>
		</ul>
	</div>
</div>
<?php if(in_array(($repayment_type), explode(',',"2,3"))): ?><div style="margin-top: 10px;" class="tool_title" id="backList">
      <div class="fun_title">
        <div> 返还的时间表</div>
      </div>
      <div class="reback">
        <ul>
          <li style="width: 106px;">月份</li>
          <li style="width: 160px;">月返还本金</li>
          <li style="width: 149px;">月返还利息</li>
          <li style="width: 149px;">月返还总额</li>
          <li style="width: 140px; border-right: 0px;">余额</li>
        </ul>
      </div>
      <div class="rslist" id="repaylist"> 
		<ul>
			<li style="width:106px;">&nbsp;</li>
			<li style="width:160px;">&nbsp;</li>
			<li style="width:149px;">&nbsp;</li>
			<li style="width:149px;">&nbsp;</li>
			<li style="width:140px; border-right:0px;"><?php echo ($repay_detail["repayment_money"]); ?></li>
		</ul>

		<?php if(is_array($repay_list)): $i = 0; $__LIST__ = $repay_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul>
			<li style="width:106px;"><?php echo ($key+1); ?></li>
			<li style="width:160px;"><?php echo ($vo["capital"]); ?></li>
			<li style="width:149px;"><?php echo ($vo["interest"]); ?></li>
			<li style="width:149px;"><?php echo ($vo["repayment_money"]); ?></li>
			<li style="width:140px; border-right:0px;"><?php echo ($vo["last_money"]); ?></li>
		</ul><?php endforeach; endif; else: echo "" ;endif; ?>
	  </div>
</div><?php endif; ?>
<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
.divList { height: 35px; line-height: 35px; text-align: left; border-bottom: 1px solid #ededed; vertical-align: middle; width: 680px; color: Gray; float: left; }
.content a { font-size: 12px; color: #092fa9; }
.tdTilte { width: 120px; color: Gray; text-align: right; }
.tdMoneyShow { color: #005B9F;   text-align:right; text-indent: 15px; width: 110px; padding-right: 35px; }
.tdDes { color: Gray; }
.dashed { height: 1px; width: 742px; border-top: 1px dashed #ccc; margin: 0px auto; clear: both; }
.sum { padding: 10px 0px; width: 100%; height: 18px; width: 540px; text-align: left; font-size: 12px; vertical-align: middle; line-height: 18px; font-weight: bold; padding-left: 40PX; float: left; }
</style>

<div style="overflow: hidden; width: 100%;">
	<div style="width: 100%; overflow: hidden; padding-top: 20px;">
		<table style="border: 1px solid #dedede; width: 764px;
			margin-left: 19px; height: 25px;" cellpadding="0" cellspacing="0">
			<tbody><tr style="background-color: #ececec; font-weight: bold; height: 25px;">
				<td style="padding-left: 20px;">
					资金存量
				</td>
			</tr>
			<tr>
				<td>
					<table style="width: 680px; float: left; margin: 0px;
						display: inline; margin: 0px 20px; padding: 0px; border-collapse: collapse; text-align: left;" id="formTb" cellpadding="0" cellspacing="0">
						<tbody><tr class="divList">
							<td class="tdTilte">
								可用现金金额：
							</td>
							<td class="tdMoneyShow">
								<?php echo Fmoney($minfo['account_money']+$minfo['back_money']);?>
							</td>
							<td class="tdDes">
								（可以用来直接提现或投标的金额）
							</td>
						</tr>
						<tr class="divList">
							<td class="tdTilte">
								待收总额：
							</td>
							<td class="tdMoneyShow">
								<?php echo (fmoney($minfo["money_collect"])); ?>
								
							</td>
							<td class="tdDes">
								（已经借出，尚未回收的本金和利息总额，已扣除管理费）
							</td>
						</tr>
						 <tr class="divList">
							<td class="tdTilte">
								冻结总额：
							</td>
							<td class="tdMoneyShow">
								<?php echo (fmoney($minfo["money_freeze"])); ?>
							</td>
							<td class="tdDes">
								（包括投标冻结和提现冻结的资金总额）
							</td>
						</tr>
						   <tr class="divList" style=" font-weight:bold; border-bottom:none;">
							<td class="tdTilte" style=" color:#000;">
								账户资金总额：
							</td>
							<td class="tdMoneyShow">
								<?php echo Fmoney($minfo['account_money']+$minfo['back_money']+$minfo['money_collect']+$minfo['money_freeze']);?>
							</td>
							<td class="tdDes">
								（您在<?php echo ($glo["web_name"]); ?>平台上现有现金资产的总额）
							</td>
						</tr>
					</tbody></table>
				</td>
			</tr>
			  <tr>
			<td>
			<table>
			  <tbody><tr>
			   <td colspan="1" style="color:Gray; margin-bottom:5px; line-height:28px;">
					<img style="margin-top:-3px; margin-left:18px;" src="__ROOT__/Style/M/images/minilogo.gif" alt="">
					帐户资产总额 = 可用现金金额 + 待收总额 + 冻结总额 
					</td>
				</tr>
			</tbody></table>
			</td>
			</tr>
		</tbody></table>
	</div>

	<div style="width: 100%; overflow: hidden; padding-top: 20px;">
		<table style="border: 1px solid #dedede; width: 764px;
			margin-left:19px; height: 25px;" cellpadding="0" cellspacing="0">
			<tbody><tr style="background-color: #ececec; font-weight: bold; height: 25px;">
				<td style="padding-left: 20px;">
					资金损益
				</td>
			</tr>
			<tr>
				<td>
					<table style="width: 680px; float: left; margin: 0px;
						display: inline; margin: 0px 20px; padding: 0px; border-collapse: collapse; text-align: left;" id="Table6" cellpadding="0" cellspacing="0">
					  
						 <tbody><tr class="divList">
							<td class="tdTilte">
								净赚利息：
							</td>
							<td class="tdMoneyShow">
								￥<?php echo (($benefit["interest"])?($benefit["interest"]):"0.00"); ?>
							</td>
							<td class="tdDes">
								（投资净赚的投资利息总和，已扣除管理费）
							</td>
						</tr>
							<tr class="divList">
							<td class="tdTilte">
								净付利息：
							</td>
							<td class="tdMoneyShow">
								￥<?php echo (($out["interest"])?($out["interest"]):"0.00"); ?>
							</td>
							<td class="tdDes">
								（借款支付的借款利息总和）
							</td>
						</tr>
						<tr class="divList">
							<td class="tdTilte">
								支付会员认证费：
							</td>
							<td class="tdMoneyShow">
								￥<?php echo (($out["authenticate"])?($out["authenticate"]):"0.00"); ?>
							</td>
							<td class="tdDes">
								（支付的从<?php echo ($glo["web_name"]); ?>会员费及认证费用总和）
							</td>
						</tr>
						<tr class="divList">
							<td class="tdTilte">
								借款管理费：
							</td>
							<td class="tdMoneyShow">
								￥<?php echo (($out["borrow_manage"])?($out["borrow_manage"]):"0.00"); ?>
							</td>
							<td class="tdDes">
								（支付的从<?php echo ($glo["web_name"]); ?>借款收取的管理费用总和）
							</td>
						</tr>
						<tr class="divList">
							<td class="tdTilte">
								逾期及催收费用：
							</td>
							<td class="tdMoneyShow">
								￥<?php echo (($out["overdue"])?($out["overdue"]):"0.00"); ?>
							</td>
							<td class="tdDes">
								（支付的从<?php echo ($glo["web_name"]); ?>借款逾期罚息及催收的费用总和）
							</td>
						</tr>
						<tr class="divList">
							<td class="tdTilte">
								累计提现手续费：
							</td>
							<td class="tdMoneyShow">
							￥<?php echo (($out["withdraw_fee"])?($out["withdraw_fee"]):"0.00"); ?>
							</td>
							<td class="tdDes">
								（支付的提现手续费总和）
							</td>
						</tr>
						<tr class="divList">
							<td class="tdTilte">
								累计投标奖励：
							</td>
							<td class="tdMoneyShow">
								￥<?php echo (($benefit["ireward"])?($benefit["ireward"]):"0.00"); ?>
							</td>
							<td class="tdDes">
								（投标获得的奖励总和）
							</td>
						</tr>
						<tr class="divList">
							<td class="tdTilte">
								累计支付投标奖励：
							</td>
							<td class="tdMoneyShow">
								￥<?php echo (($out["pay_tender"])?($out["pay_tender"]):"0.00"); ?>
							</td>
							<td class="tdDes">
								（借款所支付的投标奖励总和）
							</td>
						</tr>
						<tr class="divList">
							<td class="tdTilte">
								累计推广奖励：
							</td>
							<td class="tdMoneyShow">
								￥<?php echo (($benefit["spread_reward"])?($benefit["spread_reward"]):"0.00"); ?>
							</td>
							<td class="tdDes">
								（推广下线获得的奖励总和）
							</td>
						</tr>
						<tr class="divList">
							<td class="tdTilte">
								债权转让手续费：
							</td>
							<td class="tdMoneyShow">
								￥<?php echo (($out["bond_manage"])?($out["bond_manage"]):"0.00"); ?>
							</td>
							<td class="tdDes">
								（支出债权转让手续费总和）
							</td>
						</tr>
						
						
						  <tr class="divList" style=" font-weight:bold; border-bottom:none;">
							<td class="tdTilte" style=" color:#000;">
								累计盈亏总额：
							</td>
							<td class="tdMoneyShow">
								<?php echo Fmoney($benefit['total']-$out['total']);?>
							</td>
							<td class="tdDes">
								（您在<?php echo ($glo["web_name"]); ?>平台上累计盈亏的总额）
							</td>
						</tr>
					</tbody></table>
				</td>
			</tr>
			<tr>
			<td>
			<table>
			  <tbody><tr>
			   <td colspan="0" style="color:Gray; margin-bottom:5px; line-height:28px;">
					<img style="margin-top:-3px; margin-left:18px;" src="__ROOT__/Style/M/images/minilogo.gif" alt="">
					累计盈亏总额 = 净赚利息 – 净付利息 – 支付会员认证费 – 借款管理费 - 逾期及催收费用 - 提现手续费 - 债权转让手续费<br/> 
									<span style="margin-left:130px;"> + 投标奖励  - 支付投标奖励 + 推广奖励 </span>
					</td>
				</tr>
			</tbody></table>
			</td>
			</tr>
		</tbody></table>
	</div>
	
	<div style="width: 100%; overflow: hidden; padding-top: 20px;">
		<table style="border: 1px solid #dedede;  width: 764px;
			margin-left:19px; height: 25px;" cellpadding="0" cellspacing="0">
			<tbody><tr style="background-color: #ececec; font-weight: bold; height: 25px;">
				<td style="padding-left: 20px;">
					资金流量
				</td>
			</tr>
			<tr>
				<td>
					<table style="width: 680px; float: left; margin: 0px;
						display: inline; margin-left: 20px; padding: 0px 0px; padding-bottom: 0px; border-collapse: collapse;
						text-align: left;" id="Table1" cellpadding="0" cellspacing="0">
						 <tbody><tr class="divList">
							<td class="tdTilte">
								累计投资金额：
							</td>
							<td class="tdMoneyShow">
								￥<?php echo (($pcount["ljtz"])?($pcount["ljtz"]):"0.00"); ?>
							</td>
							<td class="tdDes">
								（注册至今，您账户借出资金总和）
							</td>
						</tr>
						<tr class="divList">
							<td class="tdTilte">
								累计借入金额：
							</td>
							<td class="tdMoneyShow">
								￥<?php echo (($pcount["jrje"])?($pcount["jrje"]):"0.00"); ?>
							</td>
							<td class="tdDes">
								（注册至今，您账户借入资金总额）
							</td>
						</tr>
						<tr class="divList">
							<td class="tdTilte">
								累计充值金额：
							</td>
							<td class="tdMoneyShow">
								￥<?php echo (($pcount["payonline"])?($pcount["payonline"]):"0.00"); ?>
							</td>
							<td class="tdDes">
								（注册至今，您账户累计充值总额）
							</td>
						</tr>
						<tr class="divList" >
							<td class="tdTilte">
								累计提现金额：
							</td>
							<td class="tdMoneyShow">
								￥<?php echo (($pcount["withdraw"])?($pcount["withdraw"]):"0.00"); ?>
							</td>
							<td class="tdDes">
								（注册至今，您账户累计提现总额）
							</td>
						</tr>
						
						<tr class="divList" style="border-bottom: none;">
							<td class="tdTilte">
								累计支付管理费：
							</td>
							<td class="tdMoneyShow">
								￥<?php echo (($pcount["commission"])?($pcount["commission"]):"0.00"); ?>
							</td>
							<td class="tdDes">
								（支付的<?php echo ($glo["web_name"]); ?>管理费总和）
							</td>
						</tr>
					</tbody></table>
				</td>
			</tr>
		</tbody></table>
	</div>
	
		 
	<div style="width: 100%; overflow: hidden; padding-top: 20px;">
		<table style="border: 1px solid #dedede;  width: 764px;
			margin-left:19px; height: 25px;" cellpadding="0" cellspacing="0">
			<tbody><tr style="background-color: #ececec; font-weight: bold; height: 25px;">
				<td style="padding-left: 20px;">
					资金预期
				</td>
			</tr>
			<tr>
				<td>
					<table style="width: 680px; float: left; margin: 0px;
						display: inline; margin-left: 20px; padding: 0px 0px; padding-bottom: 0px; border-collapse: collapse;
						text-align: left;" id="Table2" cellpadding="0" cellspacing="0">
						 <tbody><tr class="divList">
							<td class="tdTilte">
								待收利息总额：
							</td>
							<td class="tdMoneyShow">
								￥<?php echo (($benefit["interest_collection"])?($benefit["interest_collection"]):"0.00"); ?>
							</td>
							<td class="tdDes">
								（已经借出，尚未回收的利息总额，未扣除管理费）
							</td>
						</tr>
							<tr class="divList" style="border-bottom: none;">
							<td class="tdTilte">
								待付利息总额：
							</td>
							<td class="tdMoneyShow">
								￥<?php echo (($out["interest_pay"])?($out["interest_pay"]):"0.00"); ?>
							</td>
							<td class="tdDes">
								（已经借入，尚未偿还的利息总额）
							</td>
						</tr>
					</tbody></table>
				</td>
			</tr>
		</tbody></table>
	</div>
</div>
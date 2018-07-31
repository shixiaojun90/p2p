<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" /><meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<meta name="format-detection" content="telephone=yes" />
<meta content="贺邦借贷" name="keywords" />
<meta name="format-detection" content="email=no" />
<title>贺邦借贷</title>
<link rel="stylesheet" type="text/css" href="__ROOT__/Style/newmobile/css/css.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/Style/newmobile/css/select.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/Style/newmobile/css/menu.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/Style/newmobile/css/styleapp.css" />
<link rel="stylesheet" href="/style/apprise/apprise-v2.css" type="text/css">

<link rel="apple-touch-icon" href="app/tzrllogo.png" />
<script type="text/javascript" src="__ROOT__/Style/newmobile/js/jquery-2.1.1.js"></script>
<script type="text/javascript" src="__ROOT__/Style/newmobile/js/borrow.js"></script>

<script type="text/javascript" src="__ROOT__/Style/newmobile/js/jquery.js"></script>
<script type="text/javascript" src="/style/apprise/apprise-v2.js"></script>
<script type="text/javascript" src="__ROOT__/Style/js/strength.js"></script> 

</head>
<body>
    <div class="tzrl_box m_index">
			<div class="mtzrl_header2">
			   
				  <ul>	<li  class="gobackwidth "><a href="javascript:window.history.go(-1);" style="border:0px"> <img src='__ROOT__/Style/newmobile/images/back.png'> </a></li>
			   <li  class="webmainname"> <a href='#' class="webname" style="color:#FFFFFF">贺邦借贷</a></li> 
			   
			   <li><a href='__APP__/m/'><img src='__ROOT__/Style/newmobile/images/home.png'></a><span > </span> <a href='__APP__/m/user/'><img src="__ROOT__/Style/newmobile/images/user.png" style='border:0px'>  </a> </li> 
			   </ul>

			   <div style="clear:both"> </div>
				
			</div>

		




<!------mainpage开始------>
 <div class="mainpage">	
     <h3 class="mainpagehader"  >资金信息</h3>
	      <div class="summary">
 <style type='text/css'> td{height:30px;padding:5px 0px  5px 6px ;font-size:13px; } </style>
  <div style="height:20px;">  </div>
<table style="border: 1px solid #dedede;  height: 20px;margin:0 auto;" cellpadding="0" cellspacing="0" width="98%">
			<tbody><tr style="background-color: #e8e8e8; font-weight: bold; height: 25px;">
				<td style="padding-left: 20px;">
					资金存量
				</td>
			</tr>
			<tr>
				<td>
					<table style=" margin: 0px;display: inline; padding: 0px; border-collapse: collapse; text-align: left;" id="formTb" cellpadding="0" cellspacing="0">
						<tbody><tr class="divList">
							<td class="tdTilte">
								可用现金金额：
							</td>
							<td class="tdMoneyShow">
								<?php echo Fmoney($minfo['account_money']+$minfo['back_money']);?>
							</td>
							
						</tr>
						<tr class="divList">
							<td class="tdTilte">
								待收总额：
							</td>
							<td class="tdMoneyShow">
								<?php echo (fmoney($minfo["money_collect"])); ?>
								
							</td>
							
						</tr>
						 <tr class="divList">
							<td class="tdTilte">
								冻结总额：
							</td>
							<td class="tdMoneyShow">
								<?php echo (fmoney($minfo["money_freeze"])); ?>
							</td>
							
						</tr>
						   <tr class="divList" style="  border-bottom:none;">
							<td class="tdTilte">
								账户资金总额：
							</td>
							<td class="tdMoneyShow">
							<?php echo Fmoney($minfo['account_money']+$minfo['back_money']+$minfo['money_collect']+$minfo['money_freeze']);?>
							</td>
							
						</tr>
					</tbody></table>
				</td>
			</tr>
			  <tr>
			<td>
			<table>
			  <tbody><tr>
			   <td colspan="1" style=" margin-bottom:5px; line-height:28px;">
				
					帐户资产总额 = 可用现金金额 + 待收总额 + 冻结总额 
					</td>
				</tr>
			</tbody></table>
			</td>
			</tr>
		</tbody></table>
	</div>

	<div style="width: 100%; overflow: hidden; padding-top: 20px;">
		<table style="border: 1px solid #dedede; height: 25px; margin:0 auto;" cellpadding="0" cellspacing="0"  width="98%" >
			<tbody><tr style="background-color: #e8e8e8;height: 25px;">
				<td style="padding-left: 20px;">
					资金损益
				</td>
			</tr>
			<tr>
				<td>
					<table style=" margin: 0px;
						display: inline;  padding: 0px; border-collapse: collapse; text-align: left;" id="Table6" cellpadding="0" cellspacing="0">
					  
						 <tbody><tr class="divList">
							<td class="tdTilte">
								累计净赚利息：
							</td>
							<td class="tdMoneyShow">
								￥<?php echo (($benefit["interest"])?($benefit["interest"]):"0.00"); ?>
							</td>
							
						</tr>
						
						<tr class="divList">
							<td class="tdTilte">
								累计提现费用：
							</td>
							<td class="tdMoneyShow">
							￥<?php echo (($out["withdraw_fee"])?($out["withdraw_fee"]):"0.00"); ?>
							</td>
						
						</tr>
						<tr class="divList">
							<td class="tdTilte">
								累计投标奖励：
							</td>
							<td class="tdMoneyShow">
								￥<?php echo (($benefit["ireward"])?($benefit["ireward"]):"0.00"); ?>
							</td>
							
						</tr>
					
						<tr class="divList">
							<td class="tdTilte">
								累计推广奖励：
							</td>
							<td class="tdMoneyShow">
								￥<?php echo (($benefit["spread_reward"])?($benefit["spread_reward"]):"0.00"); ?>
							</td>
							
						</tr>
					
						  <tr class="divList" style=" font-weight:bold; border-bottom:none;">
							<td class="tdTilte" style=" color:#000;">
								累计盈亏总额：
							</td>
							<td class="tdMoneyShow">
								<?php echo Fmoney($benefit['total']-$out['total']);?>
							</td>
							
						</tr>
					</tbody></table>
				</td>
			</tr>
			<tr>
			<td>
			<table>
			  <tbody><tr>
			   <td colspan="0" style="color:#f00; margin-bottom:5px; line-height:28px;">
				
					累计盈亏总额 = 累计净赚利息 - 累计提现手续费 + 累计投标奖励   + 累计推广奖励  </span>
					</td>
				</tr>
			</tbody></table>
			</td>
			</tr>
		</tbody></table>
	</div>
	
	<div style="width: 100%; overflow: hidden; padding-top: 20px;">
		<table style="border: 1px solid #dedede; height: 25px;margin:0 auto;" cellpadding="0" cellspacing="0"   width="98%">
			<tbody><tr style="background-color: #e8e8e8; font-weight: bold; height: 25px;">
				<td style="padding-left: 20px;">
					资金流量
				</td>
			</tr>
			<tr>
				<td>
					<table style="margin: 0px;
						display: inline;  padding: 0px 0px; padding-bottom: 0px; border-collapse: collapse;
						text-align: left;" id="Table1" cellpadding="0" cellspacing="0">
						 <tbody><tr class="divList">
							<td class="tdTilte">
								累计投资金额：
							</td>
							<td class="tdMoneyShow">
								￥<?php echo (($pcount["ljtz"])?($pcount["ljtz"]):"0.00"); ?>
							</td>
						
						</tr>
						<!--<tr class="divList">
							<td class="tdTilte">
								累计借入金额：
							</td>
							<td class="tdMoneyShow">
								￥<?php echo (($pcount["jrje"])?($pcount["jrje"]):"0.00"); ?>
							</td>
							<td class="tdDes">
								（注册至今，您账户借入资金总额）
							</td>
						</tr>-->
						<tr class="divList">
							<td class="tdTilte">
								累计充值金额：
							</td>
							<td class="tdMoneyShow">
								￥<?php echo (($pcount["payonline"])?($pcount["payonline"]):"0.00"); ?>
							</td>
							
						</tr>
						<tr class="divList" >
							<td class="tdTilte">
								累计提现金额：
							</td>
							<td class="tdMoneyShow">
								￥<?php echo (($pcount["withdraw"])?($pcount["withdraw"]):"0.00"); ?>
							</td>
							
						</tr>
						
					<!--	<tr class="divList" style="border-bottom: none;">
							<td class="tdTilte">
								累计支付佣金：
							</td>
							<td class="tdMoneyShow">
								￥<?php echo (($pcount["commission"])?($pcount["commission"]):"0.00"); ?>
							</td>
							<td class="tdDes">
								（支付的<?php echo ($glo["web_name"]); ?>佣金总和）
							</td>
						</tr>-->
					</tbody></table>
				</td>
			</tr>
		</tbody></table>
	</div>
	
		 
	<div style="width: 100%; overflow: hidden; padding-top: 20px;">
		<table style="border: 1px solid #dedede; margin:0 auto;" cellpadding="0" cellspacing="0"  width="98%">
			<tbody><tr style="background-color: #e8e8e8; font-weight: bold; height: 25px;">
				<td style="padding-left: 20px;">
					资金预期
				</td>
			</tr>
			<tr>
				<td>
					<table style="width:100%; margin: 0px;
						display: inline;  padding: 0px 0px; padding-bottom: 0px; border-collapse: collapse;
						text-align: left;" id="Table2" cellpadding="0" cellspacing="0">
						 <tbody><tr class="divList">
							<td class="tdTilte">
								待收利息总额：
							</td>
							<td class="tdMoneyShow">
								￥<?php echo (($benefit["interest_collection"])?($benefit["interest_collection"]):"0.00"); ?>
							</td>
						
						</tr>
						<!--	<tr class="divList" style="border-bottom: none;">
							<td class="tdTilte">
								待付利息总额：
							</td>
							<td class="tdMoneyShow">
								￥<?php echo (($out["interest_pay"])?($out["interest_pay"]):"0.00"); ?>
							</td>
							<td class="tdDes">
								（已经借入，尚未偿还的利息总额）
							</td>
						</tr>-->
					</tbody></table>
				</td>
			</tr>
		</tbody></table>
  
  
</div>
	     
 
 </div><!-------------mainpage结束------------->
 <div style="height:30px;">  </div>
 </body>
 </html>
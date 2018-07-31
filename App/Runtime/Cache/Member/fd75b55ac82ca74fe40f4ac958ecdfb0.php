<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>借款协议-<?php echo ($glo["web_name"]); ?></title>
<style>
  .Lending_Agreement {
  	width:100%;
  	height:auto;
  	margin:0px;
  	padding:0px;
  }
  .Lending_Agreement_center {
  	width:1024px;
  	height:auto;
  	margin:0 auto;
  	border:1px solid #EEEEEE;
  }
  .lending_ageeement_tit {
  	width:960px;
  	height:45px;
  	line-height:45px;
  	color:#666666;
  	font-family:Arial, Helvetica, sans-serif;
  	font-size:16px;
  	font-weight:bold;
  	text-align:center;
  	margin:0 auto;
  	margin-top:30px;
  	border-bottom:1px solid #EEEEEE;
  }
  .ageeement_content {
  	width:1000px;
  	height:auto;
  	margin:0 auto;
  	margin-top:30px;
  	font-size:14px;
  	font-weight:bold;
  	color:#666666;
  	overflow:auto;
  	font-family:Arial, Helvetica, sans-serif;
  }
  .ageeement_content h3 {
  	font-size:14px;
  	font-weight:bold;
  	color:#999999;
  	font-family:Arial, Helvetica, sans-serif;
  	padding-left:10px;
  }
  .font_lendig {
  	font-size:14px;
  	font-weight:bold;
  	color:#666666;
  	font-family:Arial, Helvetica, sans-serif;
  	padding-left:10px;
  	margin-bottom:10px;
  	display:block;
  	margin-top:20px;
  }
  .ageeement_content p {
  	line-height:26px;
  	font-family:Tahoma, Geneva, sans-serif;
  	font-size:14px;
  	color:#999999;
  	margin:0px;
  	font-weight:normal;
  	padding-left:10px;
  	margin-top:6px;
  }
  .ageement_tab {
  	height:40px;
  	line-height:21px;
  }
  .ageement_tab_ite {
  	height:40px;
  	line-height:40px;
  	font-weight:normal;
  }
  .lending_top_inf {
  	width:1000px;
  	height:auto;
  	margin-left:10px;
  }
  .lending_logo {
  	width:1000px;
  	height:100px;
  	border-bottom:2px solid #EEEEEE;
  }
  .lenging_left_logo {
  	width:252px;
  	height:100px;
  	float:left;
  	border-bottom:2px solid #00ADEE;
  }
  .name_inf {
  	width:400px;
  	height:65px;
  	float:left;
  	margin-left:40px;
  	margin-top:2px;
  }
  .lenging_right_inf {
  	width:260px;
  	height:50px;
  	float:left;
  	margin-top:9px;
  }
  .lenging_right_inf ul {
  	margin:0px;
  	padding:0px;
  }
  .lenging_right_inf ul li {
  	width:400px;
  	height:25px;
  	line-height:25px;
  	font-family:Arial, Helvetica, sans-serif;
  	font-size:14px;
  	color:#999999;
  	list-style:none;
  	float:left;
  	padding-left:0px;
  }
  .lenging_right_inf ul li a {
  	color:#999999;
  	text-decoration:none;
  }
  .lenging_right_inf ul li a:hover {
  	color:#FF9900;
  	text-decoration:none;
  }
  .Seal {
  	width:auto;
  	height:auto;
  	margin-right:20px;
  	float:right;
  	text-align:center;
  }
  .seal_text {
  	font-family:Arial, Helvetica, sans-serif;
  	font-size:13px;
  	color:#999999;
  	margin-top:6px;
  	margin-bottom:40px;
  	display:block;
  	font-weight:normal;
  }
  .Agreement_pic {
  	width:200px;
  	height:45px;
  	margin:0 auto;
  }
  a,a:visited{color: #E67714; text-decoration:none;}
  .gongzhang{position: absolute;margin-top: 142px;margin-left: 303px;}
  .gongzhang img{width:122px; height:122px;}
</style>
<script type="text/javascript" language="javascript">
	function printht(){
		window.print();
	} 
</script>
</head>
<body>
<div class="Lending_Agreement">
<div class="Lending_Agreement_center">
  <!--顶部信息开始-->
  <div class="lending_top_inf">
    <div class="lending_logo">
      <div class="lenging_left_logo"><a href="/" target="_blank"><?php echo get_ad(1);?></a></div>
      <div class="name_inf"></div>
      <div class="lenging_right_inf">
        <ul>
         
        </ul>
      </div>
    </div>
  </div>
  <!--顶部信息结束-->
  <div class="lending_ageeement_tit"><span class="Agreement_pic">借款协议</span><span style="float:right; padding-right:10px;"><a style="cursor:pointer" onclick="printht();" target="_self">【打印合同】</a> </span></div>
  <div class="ageeement_content">
	<div class="gongzhang" style="margin-left:870px; margin-top:3215px;"><img src="/<?php echo ($ht["hetong_img"]); ?>" ></div>
    <p align="right">合同编号：<u><strong><?php echo ($bid); echo (date("Ymd",$iinfo["add_time"])); echo ($iinfo['id']); ?></strong></u> </p>
	<p align="right">生效日期：<u><?php echo (date("Y年m月d日",$binfo["second_verify_time"])); ?></u> </p>
    <p align="left">甲方（出借人）：详见本协议第二条</p>
    <p align="left">乙方（借款人）：<u><?php echo ($mBorrow["user_name"]); ?></u> </p>
    <p align="left">丙方（担保方）：<u><?php echo (($danbao["title"])?($danbao["title"]):"未填写"); ?></u> </p>
    <p align="left">丁方（管理人）：河北贺邦投资有限公司</p>
    <p>&nbsp;</p>
    <p>借款人（乙方）通过由本公司创办的网络借贷中介平台（http://www.hebangjiedai.com） （以下简称“丁”），向丁的注册会员借款，该借款由担保方（丙方）为借款人（乙方）提供担保。相关借款事项根据《中华人民共和国合同法》等相关法律法规的规定，甲乙丙丁四方达成如下协议：</p>
    <p>&nbsp;</p>
	  <strong class="font_lendig">第一条 总则 </strong>
    <p> 1、 河北贺邦投资有限公司是一家在河北石家庄市合法成立并有效存续的有限责任公司，拥有贺邦借贷网站（www.hebangjiedai.com）网站的经营权，提供信用咨询，为交易提供信息服务；河北贺邦投资有限公司以下简称“贺邦借贷”。</p>
    <p>2、借款人系贺邦借贷网站注册借款用户，现自愿通过贺邦借贷网站向出借人申请借款；出借人系贺邦借贷网站注册投资用户，现自愿通过贺邦借贷网站向借款人提供借款；</p>
    <p>3、经借款人委托，河北德普担保有限公司（以下简称“担保公司”）同意作为保证人为借款人按期足额还款向出借人提供保证担保。</p>
	<p>4、本协议根据贺邦借贷网站《用户服务协议》、网站各项交易规则自愿达成并签订。</p>
    <p>5、出借人、借款人、担保公司一致同意委托贺邦借贷为本合同的签订和履行提供电子合同管理、借贷资金清算、划付、通知代发等服务，并向贺邦借贷交纳管理费、服务费。</p>
	<p>6、出借人、借款人、担保公司一致承认贺邦借贷网站记录的与本电子合同有关的文字、数据的真实、完整、准确、可信、合法、有效。</p>
    <p>&nbsp;</p>
    <strong class="font_lendig">第二条   出借人投资信息</strong>
    <table  width="980" border="1px" bordercolor="#EEEEEE" cellspacing="0px" style="border-collapse:collapse;margin-top:20px;margin-left:10px;">
      <tr class="ageement_tab">
        <td width="196" height="40" align="center" valign="middle">出借人</td>
        <td width="196" height="40" align="center" valign="middle">金额 </td>
        <td width="196" height="40" align="center" valign="middle">期限</td>
        <td width="196" height="40" align="center" valign="middle">预期年利率</td>
        <td width="196" height="40" align="center" valign="middle">开始日</td>
        <td width="196" height="40" align="center" valign="middle">到期日</td>
        <td width="196" height="40" align="center" valign="middle">总本息</td>
      </tr>
      <tr class="ageement_tab_ite">
        <td width="196" height="40" align="center" valign="middle"><?php echo ($mInvest["user_name"]); ?></td>
        <td width="196" height="40" align="center" valign="middle"><?php echo ($iinfo["investor_capital"]); ?></td>
        <td width="196" height="40" align="center" valign="middle"><?php echo ($binfo["borrow_duration"]); ?>
          <?php if($binfo["repayment_type"] == 1): ?>天
            <?php else: ?>
            个月<?php endif; ?></td>
		 <td width="196" height="40" align="center" valign="middle"><?php echo ($binfo["borrow_interest_rate"]); ?>%/
          <?php if($binfo["repayment_type"] == 1): ?>天
            <?php else: ?>
            年<?php endif; ?></td>
        <td width="196" height="40" align="center" valign="middle"><?php echo (date("Y年m月d日",$binfo["second_verify_time"])); ?></td>
        <td width="196" height="40" align="center" valign="middle"><?php echo (date("Y年m月d日",$binfo["deadline"])); ?></td>
        <td width="196" height="40" align="center" valign="middle"> <?php echo ($detail["benxi"]); ?></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <strong class="font_lendig">第三条   还款 </strong>
    <p align="left">1、还款计划：</p>
    <table  width="980" border="1px" bordercolor="#EEEEEE" cellspacing="0px" style="border-collapse:collapse;margin-top:20px;margin-left:10px;">
      <tr class="ageement_tab">
        <td width="196" height="40" align="center" valign="middle">期数</td>
        <td width="196" height="40" align="center" valign="middle">金额 </td>
        <td width="196" height="40" align="center" valign="middle">本金</td>
        <td width="196" height="40" align="center" valign="middle">预期利息</td>
        <td width="196" height="40" align="center" valign="middle">截止日</td>
      </tr>
	  <?php if(is_array($detailinfo)): $i = 0; $__LIST__ = $detailinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="ageement_tab_ite">
        <td width="196" height="40" align="center" valign="middle">第<?php echo (($vo["sort_order"])?($vo["sort_order"]):"1"); ?>期</td>
        <td width="196" height="40" align="center" valign="middle"><?php echo ($vo["benxi"]); ?></td>
        <td width="196" height="40" align="center" valign="middle"><?php echo ($vo["capital"]); ?></td>
        <td width="196" height="40" align="center" valign="middle"><?php echo ($vo['interest']-$vo['interest_fee']); ?></td>
		<td width="196" height="40" align="center" valign="middle"><?php echo (date("Y年m月d日",$vo["deadline"])); ?></td>
      </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
    <p>2、借款人承诺按照本协议以上约定的时间和金额，按期足额向投资者还款。</p>
    <p>&nbsp;</p>
    <strong class="font_lendig">第四条   借款的支付和还款方式 </strong>
    <p>1、甲方在同意向乙方出借相应款项时，乙委托丁在本借款协议生效时将该笔借款直接划付至借款人帐户。</p>
    <p>2、乙方在还款时已委托丁将还款直接划付至甲方帐户。</p>
    <p>3、借款人和投资者均同意上述平台接受委托的行为所产生的法律后果均由相应委托方承担。</p>
    <p>&nbsp;</p>
	<strong class="font_lendig">第五条  出借人权利义务</strong>
    <p>1、出借人保证其所用于出借的资金来源合法，是该资金的合法所有人，如果第三人对资金归属、合法性问题发生争议，由出借人自行解决。如出借人未能解决，则一切后果由出借人自行承担。</p>
    <p>2、出借人享有其所出借款项所带来的利息收益，并应主动缴纳由利息所得带来的可能的税费。</p>
    <p>3、出借人须委托管理人了解借款人的个人资信状况和经济状况，并由管理人监督或检查借款人对借款的使用。</p>
    <p>4、出借人同意按丁的服务规则委托并授权管理人根据本合同的约定向借款人发放借款。</p>
    <p>5、如借款人违约，出借人有权要求管理人提供其已获得的借款人信息。</p>
    <p>6、出借人应当对其知晓的借款人的个人信息保密，但本合同另有规定的或为实现债权等必要情况下除外。</p>
    <p>7、出借人可以将本协议项下部分或全部债权转让已在本网站注册的第三人，但应当将债权转让事项通知借款人。</p>
    <p>8、出借人有权按照本网站规定，在借款人发生还款逾期时，请求按照网站垫付规则获得相应垫付。</p>
	<p>&nbsp;</p>
    <strong class="font_lendig">第六条   担保 </strong>
    <p>1、本合同项下借款的担保方式为丙方承担连带责任的保证担保。</p>
    <p>2、丙方完全了解乙方的借款用途，为其提供连带责任的保证担保完全出于自愿，其在本合同项下的全部内容表示真实。</p>
    <p>3、保证担保的范围包括本合同项下的借款本金、利息、违约金、赔偿金、实现债权的费用（含律师费）和所有其他应付费用。</p>
    <p>4、保证期间为本合同确定的到期之次日起两年。分期还款的为本合同确定的最后一期还款期限到期之次日起两年。</p>
    <p>5、若借款人超过截止日仍未还款，则视为逾期。还款发生逾期时，每天的违约金是当天应还款项的千分之八。</p>
    <p>6、乙方逾期还款，丙方须在乙方逾期的当日内，按照本网站内借贷规则中的赔付方式对甲方（所有投资人）进行垫付本息，同时债权归丙方所有，丙方负责向乙方追讨本息、违约金等。</p>
    <p>7、丙方保证责任为独立责任，不因甲、乙方借款合同的无效而无效。</p>
    <p>&nbsp;</p>
	<strong class="font_lendig">第七条 管理人的权利义务</strong>
    <p>1、 管理人有权根据借款人提供的各项信息及管理人独立获得的信息对借款人的信用进行评估，自主决定是否审核通过并将借款人的借款需求向出借人进行推荐。</p>
    <p>2、管理人有权代出借人审核借款人的借款申请手续，并代出借人将借款划入通过审核的借款人在本网站注册的电子账户内。</p>
    <p>3、管理人有权代出借人管理及监督借款人对借款的使用情况；有权催收到期或已逾期垫付的本金、利息、违约金，及按本网站规定计提的风险准备金等相关费用。</p>
    <p>4、管理人依委托或授权发放借款，代收还款，利息等，有权受委托采取包括但不限于通过站内信、电子邮件、公共媒体公告等方式进行通知，公告，催收。</p>
    <p>5、管理人根据出借人、借款人的授权，通过本网站平台，为双方提供对接、撮合、资金监管等服务，并有权向其收取相关居间管理费用，出借人、借款人同意按照最新网站服务规则确定的收费标准向管理人支付各项费用，且双方同意管理人有权从授权代管、代收或代付的款项中，直接扣除有关服务费用。</p>
    <p>&nbsp;</p>
    <strong class="font_lendig">第八条：乙方权利、义务 </strong>
    <p>1、借款人可在还款截止日之前的任意时段进行提前还款。</p>
    <p>2、自觉接受甲方或丙方对本合同项下借款使用情况的调查、了解及监督。</p>
    <p>3、按本合同约定清偿本合同项下的本金、利息及违约金。</p>
    <p>4、乙方请求丙方作为担保人，为乙方基于本合同对甲方所负的全部债务承担连带责任。</p>
    <p>5、变更住所、通讯地址、号码应在变更后，应当立即书面通知甲方或丙方。</p>
    <p>6、如发生对其履行本合同项下还款义务产生重大影响的任何事件（包括但不限于离、结婚，对外投资，承担民事、行政、刑事责任等），应立即书面通知甲方或丙方。</p>
    <p>&nbsp;</p>
    <strong class="font_lendig">第九条：违约责任</strong>
    <p>1、如乙方未按本合同约定履行归还所借款项义务，丙方对逾期借款从垫付之日起按应还本金每日千分之八收取违约金，直到本息清偿为止。</p>
    <p>2、乙方有下列行为之一，甲方有权提前收回借款：</p>
    <p>（1）向甲方或者丙方提供虚假情况或者隐瞒重要事实;</p>
    <p>（2）不配合、拒绝接受甲方或者丙方的监督;</p>
    <p>（3）未经甲方或者丙方同意，转让、处分其资产;</p>
    <p>（4）其财产重要部分或全部被其他债权人占有、接管或其财产被扣押、冻结，可能使甲方或者丙方遭受严重损失的;</p>
    <p>（5）其他任何可能导致甲方或者丙方实现债权受到威胁或遭受严重损失的。</p>
    <p>&nbsp;</p>
    <strong class="font_lendig">第十条：特别条款 </strong>
    <p>1、借款人不得将所借款项用于任何违法活动（包括但不限于赌博、吸毒、贩毒、卖淫嫖娼等）及一切高风险投资（如证券期货、彩票等），否则一经发现，投资者有权要求提前收回全部借款，投资者或丁还将立即向公安等有关行政机关举报，追回此款并追究借款人的刑事责任。</p>
    <p>2、丁仅作为该网站注册会员之间小额资金互助平台，反对一切利用丁进行信用卡套现和其他洗钱等不正当交易行为。如发生此类现象，丁有权向公安等有关行政机关举报，追究其相关法律责任。</p>
    <p>&nbsp;</p>
    <strong class="font_lendig">第十一条：其他</strong>
    <p>1、本协议采用电子文本形式制成，并通过站内信的形式发送协议至丁。</p>
    <p>2、本协议自借款人在丁发布的借款标的审核成功之日起生效，借款人、投资者和担保方各执一份，并具同等法律效力。</p>
    <p>3、其他未尽事宜三方另行协商解决，协商不成，在丙方所在地人民法院通过诉讼解决。</p>
    <p>4、丁拥有对本协议的最终解释权。</p>
	 <p>&nbsp;</p>
      <div class="Seal">
        <span class="seal_text"><?php echo (date("Y年m月d日",$binfo["second_verify_time"])); ?></span> </div>
  </div>
</div>
</body>
</html>
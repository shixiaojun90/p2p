<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo ($ts['site']['site_name']); ?>管理后台</title>
<link href="__ROOT__/Style/A/css/style.css" rel="stylesheet" type="text/css">
<link href="__ROOT__/Style/A/js/tbox/box.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__ROOT__/Style/A/js/jquery.js"></script>
<script type="text/javascript" src="__ROOT__/Style/A/js/common.js"></script>
<script type="text/javascript" src="__ROOT__/Style/A/js/tbox/box.js"></script>
</head>
<body>
<link href="__ROOT__/Style/M/css/tab1.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="__ROOT__/Style/My97DatePicker/WdatePicker.js" language="javascript"></script>

<style type="text/css">
.text2{border:0 none; height:25px; line-height:25px}
</style>
<div class="so_main">

<div class="page_tit">查看会员资料</div>
<div class="page_tab"><span data="tab_1" class="active">个人资料</span><span data="tab_2">联系方式</span><span data="tab_3">单位资料</span><span data="tab_4">财务状况</span><span data="tab_5">房产信息</span><span data="tab_6">联保情况</span></div>
<div class="form2">

	<div id="tab_1" style="">
<table cellspacing="0" cellpadding="0" id="formTb" style="width: 100%;margin: 0px;padding: 0px; border-collapse: collapse; text-align: left;">
	<tbody><tr class="trBg">
		<td class="tdTitle">
			真实姓名：
		</td>
		<td class="tdContent">
			<?php echo (($vo["real_name"])?($vo["real_name"]):"未填写"); ?>
		</td>
		<td id="dv_realname" class="tdTip">
		</td>
	</tr>
	<tr>
		<td class="tdTitle">
			身份证号：
		</td>
		<td class="tdContent">
			<?php echo (($vo["idcard"])?($vo["idcard"]):"未填写"); ?>
		</td>
		<td id="dv_idcard" class="tdTip">
		</td>
	</tr>
	<tr class="trBg">
		<td class="tdTitle">
			年龄：
		</td>
		<td class="tdContent">
			<?php echo (($vo["age"])?($vo["age"]):"未填写"); ?>
		</td>
		<td id="Td3" class="tdTip">
		</td>
	</tr>
	<tr>
		<td class="tdTitle">
			手机号码：
		</td>
		<td class="tdContent">
			<?php echo (($vo["cell_phone"])?($vo["cell_phone"]):"未填写"); ?>
		</td>
		<td id="dv_mobile" class="tdTip">
		</td>
	</tr>
	<tr class="trBg">
		<td class="tdTitle">
			性别：
		</td>
		<td class="tdContent radioPos">
			<?php $i=0;$___KEY=array ( '男' => '男', '女' => '女', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="sex" value="<?php echo ($k); ?>" id="sex_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["sex"]==$k)||("key"=="value"&&$vo["sex"]==$v)){ ?><input type="radio" name="sex" value="<?php echo ($k); ?>" id="sex_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="sex" value="<?php echo ($k); ?>" id="sex_<?php echo ($i); ?>" /><?php } ?><label for="sex_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
		</td>
		<td id="dv_gender" class="tdTip">
		</td>
	</tr>
	<tr>
		<td class="tdTitle">
			婚姻状况：
		</td>
		<td class="tdContent radioPos">
			<?php $i=0;$___KEY=array ( '未婚' => '未婚', '已婚' => '已婚', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="marry" value="<?php echo ($k); ?>" id="marry_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["marry"]==$k)||("key"=="value"&&$vo["marry"]==$v)){ ?><input type="radio" name="marry" value="<?php echo ($k); ?>" id="marry_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="marry" value="<?php echo ($k); ?>" id="marry_<?php echo ($i); ?>" /><?php } ?><label for="marry_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
		</td>
		<td id="dv_marrage" class="tdTip">
		</td>
	</tr>
	<tr class="trBg">
		<td class="tdTitle">
			最高学历：
		</td>
		<td class="tdContent radioPos">
			<?php $i=0;$___KEY=array ( '高中以下' => '高中以下', '大专或本科' => '大专或本科', '硕士或硕士以上' => '硕士或硕士以上', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="education" value="<?php echo ($k); ?>" id="education_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["education"]==$k)||("key"=="value"&&$vo["education"]==$v)){ ?><input type="radio" name="education" value="<?php echo ($k); ?>" id="education_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="education" value="<?php echo ($k); ?>" id="education_<?php echo ($i); ?>" /><?php } ?><label for="education_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
		</td>
		<td id="dv_degree" class="tdTip">
		</td>
	</tr>
	<tr>
		<td class="tdTitle">
			月收入：
		</td>
		<td class="tdContent radioPos">
			<?php $i=0;$___KEY=array ( '5000以下' => '5000以下', '5000-10000' => '5000-10000', '10000-50000' => '10000-50000', '50000以上' => '50000以上', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="income" value="<?php echo ($k); ?>" id="income_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["income"]==$k)||("key"=="value"&&$vo["income"]==$v)){ ?><input type="radio" name="income" value="<?php echo ($k); ?>" id="income_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="income" value="<?php echo ($k); ?>" id="income_<?php echo ($i); ?>" /><?php } ?><label for="income_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
		</td>
		<td id="dv_income" class="tdTip">
		</td>
	</tr>
	<tr class="trBg">
		<td class="tdTitle">
			个人描述：
		</td>
		<td style="height: 100px;" class="tdContent">
			<?php echo (($vo["info"])?($vo["info"]):"未填写"); ?>
		</td>
		<td id="dv_id" class="tdTip">
		</td>
	</tr>
	</tbody></table>
	</div>
	<div id="tab_2" style="display:none">
<table cellspacing="0" cellpadding="0" id="formTb" style="width: 100%;margin: 0px;padding: 0px; border-collapse: collapse; text-align: left;">
		<tbody><tr class="trBg">
			<td class="tdTitle">
				现居住地址：
			</td>
			<td class="tdContent">
				<?php echo (($vo["address"])?($vo["address"]):"未填写"); ?>
			</td>
			<td id="dv_homeAdress" class="tdTip">
			</td>
		</tr>
		<tr>
			<td class="tdTitle">
				住宅电话：
			</td>
			<td class="tdContent">
				<?php echo (($vo["tel"])?($vo["tel"]):"未填写"); ?>
			</td>
			<td id="dv_homeTel" class="tdTip">
			</td>
		</tr>
		<tr class="trBg">
			<td class="tdTitle">
				第一联系人：
			</td>
			<td class="tdContent">
				<?php echo (($vo["contact1"])?($vo["contact1"]):"未填写"); ?>
			</td>
			<td id="dv_firstname" class="tdTip">
			</td>
		</tr>
		<tr>
			<td class="tdTitle">
				关系：
			</td>
			<td class="tdContent">
			<?php $i=0;$___KEY=array ( '家庭成员' => '家庭成员', '朋友' => '朋友', '商业伙伴' => '商业伙伴', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="contact1_re" value="<?php echo ($k); ?>" id="contact1_re_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["contact1_re"]==$k)||("key"=="value"&&$vo["contact1_re"]==$v)){ ?><input type="radio" name="contact1_re" value="<?php echo ($k); ?>" id="contact1_re_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="contact1_re" value="<?php echo ($k); ?>" id="contact1_re_<?php echo ($i); ?>" /><?php } ?><label for="contact1_re_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
			</td>
			<td id="dv_firstrelation" class="tdTip">
			</td>
		</tr>
		<tr class="trBg">
			<td class="tdTitle">
				手机号码：
			</td>
			<td class="tdContent">
				<?php echo (($vo["contact1_tel"])?($vo["contact1_tel"]):"未填写"); ?>
			</td>
			<td id="dv_firstmobile" class="tdTip">
			</td>
		</tr>
		<tr>
			<td class="tdTitle">
				其他：
			</td>
			<td class="tdContent">
				<?php echo (($vo["contact1_other"])?($vo["contact1_other"]):"未填写"); ?>
			</td>
			<td id="dv_qq" class="tdTip">
			</td>
		</tr>
		<tr class="trBg">
			<td class="tdTitle">
				第二联系人：
			</td>
			<td class="tdContent">
				<?php echo (($vo["contact2"])?($vo["contact2"]):"未填写"); ?>
			</td>
			<td id="dv_secondname" class="tdTip">
			</td>
		</tr>
		<tr>
			<td class="tdTitle">
				关系：
			</td>
			<td class="tdContent">
			<?php $i=0;$___KEY=array ( '家庭成员' => '家庭成员', '朋友' => '朋友', '商业伙伴' => '商业伙伴', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="contact2_re" value="<?php echo ($k); ?>" id="contact2_re_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["contact2_re"]==$k)||("key"=="value"&&$vo["contact2_re"]==$v)){ ?><input type="radio" name="contact2_re" value="<?php echo ($k); ?>" id="contact2_re_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="contact2_re" value="<?php echo ($k); ?>" id="contact2_re_<?php echo ($i); ?>" /><?php } ?><label for="contact2_re_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
			</td>
			<td id="dv_secondrelation" class="tdTip">
			</td>
		</tr>
		<tr class="trBg">
			<td class="tdTitle">
				手机号码：
			</td>
			<td class="tdContent">
				<?php echo (($vo["contact2_tel"])?($vo["contact2_tel"]):"未填写"); ?>
			</td>
			<td id="dv_secondmobile" class="tdTip">
			</td>
		</tr>
		<tr style=" border-bottom:1px solid #dedede;">
			<td class="tdTitle">
				其他：
			</td>
			<td class="tdContent">
				<?php echo (($vo["contact2_other"])?($vo["contact2_other"]):"未填写"); ?>
			</td>
			<td id="dv_msn" class="tdTip">
			</td>
		</tr>
		</tbody>
		</table>	
	</div><!--tab1-->
	
	<div id="tab_3" style="display:none">
<table cellspacing="0" cellpadding="0" id="formTb" style="width:100%; margin: 0px;padding: 0px; border-collapse: collapse; text-align: left;">
		<tbody><tr class="trBg">
			<td class="tdTitle">
				单位名称：
			</td>
			<td class="tdContent">
				<?php echo (($vo["department_name"])?($vo["department_name"]):"未填写"); ?>
			</td>
			<td id="dv_company" class="tdTip">
			</td>
		</tr>
		<tr>
			<td class="tdTitle">
				电话：
			</td>
			<td class="tdContent">
				<?php echo (($vo["department_tel"])?($vo["department_tel"]):"未填写"); ?>
			</td>
			<td id="dv_companytel" class="tdTip">
			</td>
		</tr>
		<tr class="trBg">
			<td class="tdTitle">
				地址：
			</td>
			<td class="tdContent">
				<?php echo (($vo["department_address"])?($vo["department_address"]):"未填写"); ?>
			</td>
			<td id="dv_companyaddress" class="tdTip">
			</td>
		</tr>
		<tr>
			<td class="tdTitle">
				工作年限：
			</td>
			<td class="tdContent">
			<?php $i=0;$___KEY=array ( '1年以下' => '1年以下', '1-3年' => '1-3年', '3-5年' => '3-5年', '5-10年' => '5-10年', '10年以上' => '10年以上', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="department_year" value="<?php echo ($k); ?>" id="department_year_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["department_year"]==$k)||("key"=="value"&&$vo["department_year"]==$v)){ ?><input type="radio" name="department_year" value="<?php echo ($k); ?>" id="department_year_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="department_year" value="<?php echo ($k); ?>" id="department_year_<?php echo ($i); ?>" /><?php } ?><label for="department_year_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
			</td>
			<td id="dv_workyear" class="tdTip">
			</td>
		</tr>
		<tr class="trBg">
			<td class="tdTitle">
				证明人：
			</td>
			<td class="tdContent">
				<?php echo (($vo["voucher_name"])?($vo["voucher_name"]):"未填写"); ?>
			</td>
			<td id="dv_references" class="tdTip">
			</td>
		</tr>
		<tr style=" border-bottom:1px solid #dedede;">
			<td class="tdTitle">
				证明人手机：
			</td>
			<td class="tdContent">
				<?php echo (($vo["voucher_tel"])?($vo["voucher_tel"]):"未填写"); ?>
			</td>
			<td id="dv_referencestel" class="tdTip">
			</td>
		</tr></tbody></table>
	</div><!--tab3-->
	
	<div id="tab_4" style="display:none">
<table cellspacing="0" cellpadding="0" id="formTb" style="width:100%;margin: 0px;padding: 0px; border-collapse: collapse; text-align: left;">
	<tbody><tr class="trBg">
		<td class="tdTitle">
			月均收入：
		</td>
		<td class="tdContent">
				<?php echo (($vo["fin_monthin"])?($vo["fin_monthin"]):"未填写"); ?>
		</td>
		<td id="dv_monthin" class="tdTip">
		</td>
	</tr>
	<tr>
		<td class="tdTitle">
			收入构成描述：
		</td>
		<td style="height: 100px;" class="tdContent">
			<?php echo (($vo["fin_incomedes"])?($vo["fin_incomedes"]):"未填写"); ?>
		</td>
		<td id="dv_incomedes" class="tdTip">
		</td>
	</tr>
	<tr class="trBg">
		<td class="tdTitle">
			月均支出：
		</td>
		<td class="tdContent">
				<?php echo (($vo["fin_monthout"])?($vo["fin_monthout"]):"未填写"); ?>
		</td>
		<td id="dv_monthout" class="tdTip">
		</td>
	</tr>
	<tr>
		<td class="tdTitle">
			支出构成描述：
		</td>
		<td style="height: 100px;" class="tdContent">
			<?php echo (($vo["fin_outdes"])?($vo["fin_outdes"]):"未填写"); ?>
		</td>
		<td id="dv_outdes" class="tdTip">
		</td>
	</tr>
	<tr class="trBg">
		<td class="tdTitle">
			住房条件：
		</td>
		<td class="tdContent">
			<?php $i=0;$___KEY=array ( '有商品房' => '有商品房', '有其他（非商品房）' => '有其他（非商品房）', '无房' => '无房', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="fin_house" value="<?php echo ($k); ?>" id="fin_house_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["fin_house"]==$k)||("key"=="value"&&$vo["fin_house"]==$v)){ ?><input type="radio" name="fin_house" value="<?php echo ($k); ?>" id="fin_house_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="fin_house" value="<?php echo ($k); ?>" id="fin_house_<?php echo ($i); ?>" /><?php } ?><label for="fin_house_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
		</td>
		<td id="dv_house" class="tdTip">
		</td>
	</tr>
	<tr>
		<td class="tdTitle">
			房产价值：
		</td>
		<td class="tdContent">
				<?php echo (($vo["fin_housevalue"])?($vo["fin_housevalue"]):"未填写"); ?>
		</td>
		<td id="dv_housevalue" class="tdTip">
		</td>
	</tr>
	<tr class="trBg">
		<td class="tdTitle">
			是否购车：
		</td>
		<td class="tdContent">
			<?php $i=0;$___KEY=array ( '是' => '是', '否' => '否', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="fin_car" value="<?php echo ($k); ?>" id="fin_car_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["fin_car"]==$k)||("key"=="value"&&$vo["fin_car"]==$v)){ ?><input type="radio" name="fin_car" value="<?php echo ($k); ?>" id="fin_car_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="fin_car" value="<?php echo ($k); ?>" id="fin_car_<?php echo ($i); ?>" /><?php } ?><label for="fin_car_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
		</td>
		<td id="dv_car" class="tdTip">
		</td>
	</tr>
	<tr>
		<td class="tdTitle">
			车辆价值：
		</td>
		<td class="tdContent">
				<?php echo (($vo["fin_carvalue"])?($vo["fin_carvalue"]):"未填写"); ?>
		</td>
		<td id="dv_carvalue" class="tdTip">
		</td>
	</tr>
	<tr class="trBg">
		<td class="tdTitle">
			参股企业名称：
		</td>
		<td class="tdContent">
				<?php echo (($vo["fin_stockcompany"])?($vo["fin_stockcompany"]):"未填写"); ?>
		</td>
		<td id="dv_StockCompany" class="tdTip">
		</td>
	</tr>
	<tr>
		<td class="tdTitle">
			参股企业出资额：
		</td>
		<td class="tdContent">
				<?php echo (($vo["fin_stockcompanyvalue"])?($vo["fin_stockcompanyvalue"]):"未填写"); ?>
		</td>
		<td id="dv_StockCompanyValue" class="tdTip">
		</td>
	</tr>
	<tr class="trBg">
		<td class="tdTitle">
			其他资产描述：
		</td>
		<td style="height: 100px;" class="tdContent">
			<?php echo (($vo["fin_otheremark"])?($vo["fin_otheremark"]):"未填写"); ?>
		</td>
		<td id="dv_otheremark" class="tdTip">
		</td>
	</tr></tbody></table>
	</div><!--tab1-->
	<div id="tab_5" style="display:none">
<table cellspacing="0" cellpadding="0" id="formTb" style="width:100%; margin: 0px;padding: 0px; border-collapse: collapse; text-align: left;">
		<tbody><tr class="trBg">
			<td class="tdTitle">
				房产地址：
			</td>
			<td class="tdContent">
				<?php echo (($vo["house_dizhi"])?($vo["house_dizhi"]):"未填写"); ?>
			</td>
			<td id="dv_company" class="tdTip">
			</td>
		</tr>
		<tr>
			<td class="tdTitle">
				建筑面积：
			</td>
			<td class="tdContent">
				<?php echo (($vo["house_mianji"])?($vo["house_mianji"]):"未填写"); ?> （单位：平米）
			</td>
			<td id="dv_companytel" class="tdTip">
			</td>
		</tr>
		<tr class="trBg">
			<td class="tdTitle">
				建筑年份：
			</td>
			<td class="tdContent">
				<?php echo (($vo["house_nian"])?($vo["house_nian"]):"未填写"); ?>
			</td>
			<td id="dv_companyaddress" class="tdTip">
			</td>
		</tr>
		<tr>
			<td class="tdTitle">
				供款状况：
			</td>
			<td class="tdContent">
			<?php $i=0;$___KEY=array ( '按揭中' => '按揭中', '已供完房款' => '已供完房款', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="house_gong" value="<?php echo ($k); ?>" id="house_gong_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["house_gong"]==$k)||("key"=="value"&&$vo["house_gong"]==$v)){ ?><input type="radio" name="house_gong" value="<?php echo ($k); ?>" id="house_gong_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="house_gong" value="<?php echo ($k); ?>" id="house_gong_<?php echo ($i); ?>" /><?php } ?><label for="house_gong_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
			</td>
			<td id="dv_workyear" class="tdTip">
			</td>
		</tr>
		<tr class="trBg">
			<td class="tdTitle">
				所有权人1：
			</td>
			<td class="tdContent">
				<?php echo (($vo["house_suo1"])?($vo["house_suo1"]):"未填写"); ?>  |&nbsp;产权份额<?php echo ($vo["house_feng1"]); ?>%
			</td>
			<td id="dv_references" class="tdTip">
			</td>
		</tr>
		<tr style=" border-bottom:1px solid #dedede;">
			<td class="tdTitle">
				所有权人2：
			</td>
			<td class="tdContent">
				<?php echo (($vo["house_suo2"])?($vo["house_suo2"]):"未填写"); ?>  |&nbsp;产权份额<?php echo ($vo["house_feng2"]); ?>%
			</td>
			<td id="dv_referencestel" class="tdTip">
			</td>
		</tr>
		<tr style=" border-bottom:1px solid #dedede; ">
			<td class="tdTitle" colspan="2" style="text-align:left">
				若房产尚在按揭中, 请填写
			</td>
			<td id="dv_referencestel" class="tdTip">
			</td>
		</tr>
		<tr style=" border-bottom:1px solid #dedede;">
			<td class="tdTitle">
				贷款年限：
			</td>
			<td class="tdContent">
				<?php echo ($vo["house_dai"]); ?>年
			</td>
			<td id="dv_referencestel" class="tdTip">
			</td>
		</tr>
		<tr style=" border-bottom:1px solid #dedede;">
			<td class="tdTitle">
				每月供款：
			</td>
			<td class="tdContent">
				<?php echo ($vo["house_yuegong"]); ?>元
			</td>
			<td id="dv_referencestel" class="tdTip">
			</td>
		</tr>
		<tr style=" border-bottom:1px solid #dedede;">
			<td class="tdTitle">
				尚欠贷款余额：
			</td>
			<td class="tdContent">
				<?php echo ($vo["house_shangxian"]); ?>元
			</td>
			<td id="dv_referencestel" class="tdTip">
			</td>
		</tr>
		<tr style=" border-bottom:1px solid #dedede;">
			<td class="tdTitle">
				按揭银行：
			</td>
			<td class="tdContent">
				<?php echo (($vo["house_anjiebank"])?($vo["house_anjiebank"]):"未填写"); ?>
			</td>
			<td id="dv_referencestel" class="tdTip">
			</td>
		</tr>
</tbody></table>
	</div>
	<div id="tab_6" style="display:none">
<table cellspacing="0" cellpadding="0" id="formTb" style="width:100%; margin: 0px;padding: 0px; border-collapse: collapse; text-align: left;">
	<tbody><tr class="trBg">
			<td class="tdTitle">
				第一联保人：
			</td>
			<td class="tdContent">
				<?php echo (($vo["ensuer1_name"])?($vo["ensuer1_name"]):"未填写"); ?>
			</td>
			<td id="dv_EnsuerFirst" class="tdTip">
			</td>
		</tr>
		<tr>
			<td class="tdTitle">
				关系：
			</td>
			<td class="tdContent">
			<?php $i=0;$___KEY=array ( '家庭成员' => '家庭成员', '朋友' => '朋友', '商业伙伴' => '商业伙伴', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="ensuer1_re" value="<?php echo ($k); ?>" id="ensuer1_re_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["ensuer1_re"]==$k)||("key"=="value"&&$vo["ensuer1_re"]==$v)){ ?><input type="radio" name="ensuer1_re" value="<?php echo ($k); ?>" id="ensuer1_re_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="ensuer1_re" value="<?php echo ($k); ?>" id="ensuer1_re_<?php echo ($i); ?>" /><?php } ?><label for="ensuer1_re_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
			</td>
			<td id="dv_firstrelation" class="tdTip">
			</td>
		</tr>
		<tr class="trBg">
			<td class="tdTitle">
				手机号码：
			</td>
			<td class="tdContent">
				<?php echo (($vo["ensuer1_tel"])?($vo["ensuer1_tel"]):"未填写"); ?>
			</td>
			<td id="dv_EnsuerFirstrTel" class="tdTip">
			</td>
		</tr>
		<tr>
			<td class="tdTitle">
				第二联保人：
			</td>
			<td class="tdContent">
				<?php echo (($vo["ensuer2_name"])?($vo["ensuer2_name"]):"未填写"); ?>
			</td>
			<td id="dv_EnsuerSecond" class="tdTip">
			</td>
		</tr>
		<tr class="trBg">
			<td class="tdTitle">
				关系：
			</td>
			<td class="tdContent">
			<?php $i=0;$___KEY=array ( '家庭成员' => '家庭成员', '朋友' => '朋友', '商业伙伴' => '商业伙伴', ); foreach($___KEY as $k=>$v){ if(strlen("1key")==1 && $i==0){ ?><input type="radio" name="ensuer2_re" value="<?php echo ($k); ?>" id="ensuer2_re_<?php echo ($i); ?>" checked="checked" /><?php }elseif(("key1"=="key1"&&$vo["ensuer2_re"]==$k)||("key"=="value"&&$vo["ensuer2_re"]==$v)){ ?><input type="radio" name="ensuer2_re" value="<?php echo ($k); ?>" id="ensuer2_re_<?php echo ($i); ?>" checked="checked" /><?php }else{ ?><input type="radio" name="ensuer2_re" value="<?php echo ($k); ?>" id="ensuer2_re_<?php echo ($i); ?>" /><?php } ?><label for="ensuer2_re_<?php echo ($i); ?>"><?php echo ($v); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;<?php $i++; } ?>
			</td>
			<td id="dv_secondrelation" class="tdTip">
			</td>
		</tr>
		<tr style=" border-bottom:1px solid #dedede;">
			<td class="tdTitle">
				手机号码：
			</td>
			<td class="tdContent">
				<?php echo (($vo["ensuer2_tel"])?($vo["ensuer2_tel"]):"未填写"); ?>
			</td>
			<td id="dv_EnsuerSecondTel" class="tdTip">
			</td>
		</tr>
		</tbody>
		</table>
	</div>
</div>

</div>
<script type="text/javascript">
//获取会员用户名
function downfile(url){
	window.open("/"+url);
}
getusername();
function getusername(){
	var uid = $("#borrow_uid").val();
	$(".userinfo").html("加载中...");

	var datas = {'uid':uid};
	$.post("__URL__/getusername", datas, uidResponse,'json');
}

function uidResponse(res){
	$(".userinfo").html(res.uname);
}

function addone(){
	var htmladd = '<dl class="lineD"><dt>资料名称：</dt>';
		htmladd+= '<dd><input type="text" name="updata_name[]" value="" />&nbsp;&nbsp;更新时间:<input type="text" name="updata_time[]" onclick="WdatePicker();" class="Wdate" /></dd>';
		htmladd+= '</dl>';
	$(htmladd).appendTo("#tab_3");
}
</script>
<script type="text/javascript" src="__ROOT__/Style/A/js/adminbase.js"></script>
</body>
</html>
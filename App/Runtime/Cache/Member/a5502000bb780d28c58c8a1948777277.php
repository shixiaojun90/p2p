<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript" src="__ROOT__/Style/M/js/amounttochinese.js" language="javascript"></script>
<script type="text/javascript">
$(function() {
	//$("#btnSendMsg").click(sendSMS);
	$("#Amount").bind("keyup", function() {
		$this = $(this);
		$this.val($this.val().toString().replace(/[^(\d|\.)]+/, ""));
	});
	$("#Amount").focus(function() {
		$("#d_money").css("display", "none");
	});
});
var suretx = function(d,h,v){
	if(d===true){
			$.ajax({
				url: "__URL__/actwithdraw/",
				type: "post",
				dataType: "json",
				data: {"pwd":$("#txtPassword").val(),"amount":$("#Amount").val()},
				success: function(d) {
					if (d.status == 2) {
						$.jBox.tip(d.message,'fail');
					}
					else if(d.status==1) {
						$.jBox.tip(d.message, "success");
					} else {
						$.jBox.tip("支付密码错误！", 'fail');
					}
				}
			});
	}
}
var arrWrong = "<img  src='__ROOT__/Style/M/images/zhuce2.gif'/>&nbsp";
function SetError(val, cont) {
		$("#d_money").css("display", "block");
		$("#d_money").html(val + cont);
		$("#d_money").attr("class", "reg_wrong");
}

function drawMoney() {
	if (testAmount()) {
		if ($("#txtPassword").val().length < 1) {
			$.jBox.tip("您好，请输入支付密码后再点击确认提现！", 'tip');
			return;
		}
		if (parseFloat($("#Amount").val()) <= parseFloat($("td.tdContent span").html()) && $("#txtPassword").eq(0).val().length > 0 && parseFloat($("#txt_Amount").val()) > 0) {
			$.ajax({
				url: "__URL__/validate",
				type: "post",
				dataType: "json",
				data: {"pwd":$("#txtPassword").val(),"amount":$("#Amount").val()},
				success: function(d) {
					if (d.status == 2) {
						$.jBox.tip(d.message,'fail');
					}
					else if(d.status==1) {
						$.jBox.confirm(d.message, "提现确认", suretx, { buttons: { '确认提现': true, '暂不提现': false} });
					} else {
						$.jBox.tip("支付密码错误！", 'fail');
					}
				}
			});
		} 
	}
}

function testAmount() {
	var testreuslt = true;
	if ($("#Amount").val() == '') {
		SetError(arrWrong, "请输入提现金额，如1000.10。");
		testreuslt = false;
	}
	if (!(/^\d+(.)?\d{1,2}$/.test($("#Amount").val()))) {
		SetError(arrWrong, "请输入正确的提现金额，如1001.20。");
		testreuslt = false;
	}
	if (parseFloat($("#Amount").val()) < 0.01) {
		SetError(arrWrong, "提现金额不能小于0.01。");
		testreuslt = false;
	}
	//if (parseFloat($("#txt_Amount").val()) > 30000) {
	//	SetError(arrWrong, "提现金额不能大于30000。");
	//	testreuslt = false;
	//}
	if (parseFloat($("#currentMoeny").html()) < parseFloat($("#Amount").val())) {
		SetError(arrWrong, "您的账户余额不足以提现。");
		testreuslt = false;
	}
	if (testreuslt) {
		showChineseAmount();
	}
	return testreuslt;
}

function showChineseAmount() {
	var regamount = /^(([1-9]{1}[0-9]{0,})|([0-9]{1,}\.[0-9]{1,2}))$/;
	var reg = new RegExp(regamount);
	if (reg.test($("#Amount").val())) {
		var amstr = $("#Amount").val();
		var leng = amstr.toString().split('.').length;
		if (leng == 1) {
			$("#Amount").val($("#Amount").val() + ".00");
		}
		$("#d_money").html(Arabia_to_Chinese($("#Amount").val()));
		$("#d_money").css("display", "");
		$("#d_money").css("color", "red");
		$("#d_money").removeClass("reg_wrong");
	}
	else {
		$("#d_money").html("");
	}
}
</script>
<style type="text/css">
        .btnEnable { width: 96px; height: 28px; line-height: 25px; text-align: center; cursor: pointer; background-image: url(__ROOT__/Style/M/images/sendMsg.jpg); }
        a.btnEnable:hover { color: #F4FFFF; }
        a.btnDisable { color: Gray; }
        .tdTitle { text-align: right; padding-left: 10px; font-size: 12px; height: 40; line-height: 40px; vertical-align: middle; width: 110px; color: #000; }
        .tdContent { text-align: left; padding-left: 10px; font-size: 12px; height: 40; line-height: 40px; vertical-align: middle; width: 535px; color: #000; }
        .reg_wrong { font-size: 12px; background-color: #fff9dd; border: 1px solid #ff0000; color: #ff0000; height: 22px; line-height: 21px; }
        #vtiplink, #bacctip { width: 115px; border: none; cursor: pointer; display: block; height: 5px; }
        #formTb { width: 100%; margin: 0px; padding: 0px; border-collapse: collapse; text-align: left; }
        #currentMoeny { color: Red; font-weight: bold; font-size: 12px; }
        .titstrong { height: 30px; line-height: 30px; text-indent: 30px; padding-top: 20px; text-align: left; border-bottom: dashed 1px #ccc; margin-bottom: 10px; }
        .listframe { width: 100%; overflow: hidden; padding: 0px 0px; }
        .divtitle { height: 20px; line-height: 25px; text-align: left; padding-left: 40px; font-size: 12px; margin-top: 8px; margin-bottom: 1PX; }
        .listframe td { border: 1px solid #dedede; }
        .listframe a { color: #0000ff; }
    </style>
    <style type="text/css">
        .dv_header_8 { background-image: url(); }
        .dv_account_0 { margin-top: 10px; }
    </style>
<div class="top_account_bg">
	<img src="__ROOT__/Style/H/images/ministar.gif" style="margin-right: 5px;">
	尊敬的<?php echo ($vo["real_name"]); ?>，您可以将账户中的余额提取到银行卡中，敬请仔细操作
</div>
<div class="divtitle" style="width: 100%; height: 70px; text-indent:0px">
	1、尊敬的<?php echo ($vo["real_name"]); ?>，提现操作涉及您的资金变动，请仔细核对您的提现信息<br>
	2、一般用户单日提现上限为<?php echo ($fee["2"]["1"]); ?>万元<br>
	3、涉及到您的资金安全，请仔细操作
</div>
<div class="listframe" style="clear: both; margin-top: 20px; width: 100%;">
<form method="post" action="__URL__/withdraw/">
	<table id="formTb" style="margin: 0px 20px 10px 20px;
		width: 680px;" cellpadding="0" cellspacing="0">
		<tbody>
		<tr>
			<td class="tdTitle">账户可提现余额：</td><td class="tdContent"><?php echo ($vo["all_money"]); ?>元</td>
		</tr>
		<tr>
			<td class="tdTitle">
				提现金额：
			</td>
			<td class="tdContent">
				<div style="float: left; line-height: 21px;">
					<input name="Amount" id="Amount" value="" class="text2" onblur="testAmount();" type="text">
				</div>
				<div id="d_money" style="width: 250px; height: 20px; line-height: 20px; margin-left: 10px;
					float: left;">
				</div>
			</td>
		</tr>
		
		
		<tr>
			<td class="tdTitle">&nbsp;
				
			</td>
			<td class="tdContent">
				<!-- <img style="cursor: pointer;" alt="确认提现" onclick="drawMoney()" src="__ROOT__/Style/M/images/draw.jpg"> 
				<img src="__ROOT__/Style/M/images/sendMsgdis.jpg" style="display: none;"> -->
				<input type="submit" name="submit"  value="提交">
			</td>
		</tr>
	</tbody></table>
	
	</form>

</div>
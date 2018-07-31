<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript" src="__ROOT__/Style/H/js/area.js" language="javascript"></script>

<script type="text/javascript">
    var newTitle = '<?php echo ($glo["web_name"]); ?>提醒您：';
    $(function() {
        $("#btn_set").click(function() {
            clearErr();
            if ($("#bank_name").val()=="") {
                addErr("请选择开户行");
            }
            if ($("#txt_account").val().length < 1) {
                addErr("请输入您的银行帐号");
            }
            if ($("#txt_account").val().length < 9) {
                addErr("请输入正确的银行卡号");
            }
            if ($("#txt_bankName").val().length < 1) {
                addErr("请输入开户支行名称");
            }
            if ($("#province").val()=="") {
                addErr("请选择开户行所在省份");
            }
            if ($("#city").val()=="") {
                addErr("请选择开户行所在市");
            }
            if ($("#txt_confirmaccount").val() != $("#txt_account").val()) {
                addErr("更新失败。两次输入银行账号不一致，请重新输入！");
                $("#txt_confirmaccount").val("");
                $("#txt_confirmaccount").focus();
            }
            if (hasErr()) {
                showErr();
                return false;
            }
            else {
                    $.ajax({
                        url: "__URL__/bindbank",
                        type: "post",
                        dataType: "json",
                        data: {
                            account: $("#txt_account").val(), oldaccount: $("#txt_oldaccount").val(),
                            province: $("#province").val(),city: $("#city").val(),
                            bankaddress: $("#txt_bankName").val(), bankname: $("#bank_name").val()
                            
                        },
                        success: function(d) {
                            if (d.status == 1) {
                                $.jBox.tip("恭喜，您的银行卡更新成功！", 'success');
                                setTimeout('myrefresh3()',1000);
                            }
                            else if (d.status == 0) {
                                $.jBox.tip(d.message, 'fail');
                            }
                        }
                    });
            }
        });
        var ops = '添加';
        if (ops == '添加') {
            $("#trOldAccount").css("display", "none")
        }
        $("#bankname").html($("#" + 'sel_bankList2' + " :selected").html());
        $("#txt_account").bind("keyup", function() {
            $this = $(this);
            $this.val($this.val().toString().replace(/[^\d]+/, ""));
        });
    });
    function checkSub() {
        $("input[type='text']").each(function() {
            if ($(this).val().length < 1)
                return false;
        });
        return true;
    }

    //根据隐藏的银行卡账户判断是更新还是新增
    function showErr() {
        $(".alertDiv").css("display", "");
    }
    function clearErr() {
        $(".alertDiv ul").html("");
        hideErr();
    }
    function addErr(err) {
        $(".alertDiv ul").append("<li>" + err + "</li>");
    }
    function hideErr() {
        $(".alertDiv").css("display", "none");
    }
    function hasErr() {
        return $(".alertDiv ul li").length > 0;
    }
    function myrefresh3()
{
       window.location.href="__APP__/member/bank#fragment-1";
       window.location.reload();
}
</script>
<style type="text/css">
.tdTitle { text-align: right; padding-left: 10px; font-size: 12px; height: 36; line-height: 36px; vertical-align: middle; width: 160px; border: #E9E8E7 solid 1px; }
.tdContent { text-align: left; padding-left: 10px; font-size: 12px; height: 36; line-height: 36px; vertical-align: middle; width: 535px; border: #E9E8E7 solid 1px; }
.alertDiv { margin: 0px auto; background-color: #FEFACF; border: 1px solid green; line-height: 25px; background-image: url(__ROOT__/Style/M/images/info/001_30.png); background-position: 20px 4px; background-repeat: no-repeat; }
.alertDiv li { margin: 5px 0; list-style-type: decimal; color: #005B9F; padding: 0px; line-height: 20px; }
.alertDiv ul { text-align: left; list-style-type: decimal; display: block; padding: 0px; margin: 0px 0px 0px 75px; }
.btnsubupdate { width: 86px; height: 30px; background-image: url(__ROOT__/Style/M/images/btnsubupdate.jpg); background-repeat: no-repeat; border: none; cursor: pointer; }
.btncancel { height: 30px; margin-left: 10px; width: 60px; background-image: url(__ROOT__/Style/M/images/btncancel.jpg); border: none; background-repeat: no-repeat; cursor: pointer; }
.tdContent{text-align:left}
</style>
<div style="width: 716px; display: none; margin-left:20px" class="alertDiv">
    <ul style="display: block;">
    </ul>
</div>
<div style="width: 753px; margin-top: 10px; margin-bottom: 5px; margin-left: 24px;">
    <table style="width: 753px; float: left; margin: 0px;
        padding: 0px; border-collapse: collapse; text-align: left;" id="formTb" cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td class="tdTitle">
                    您当前的银行账号：
                </td>
                <td class="tdContent">
                    <?php echo (hidecard($vobank["bank_num"],3,'还没有登记您的银行账号')); ?>
                </td>
            </tr>
            <tr>
                <td class="tdTitle">
                    您当前的银行名称：
                </td>
                <td class="tdContent">
                <select name="bank_name" id="bank_name"  style="width: 110px;" class="c_select selectStyle"><option value="">--请选择--</option><?php foreach($bank_list as $key=>$v){ if($vobank["bank_name"]==$key && $vobank["bank_name"]!=""){ ?><option value="<?php echo ($key); ?>" selected="selected"><?php echo ($v); ?></option><?php }else{ ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php }} ?></select><span id="tip_bank_name" class="tip">*</span>
                </td>
            </tr>
            <tr>
                <td class="tdTitle">
                    您银行账户户主姓名：
                </td>
                <td class="tdContent">
                    <span id="spname"><?php echo cnsubstr($voinfo['real_name'],1,0,'utf-8',false).str_repeat("*",strlen($voinfo['real_name'])-1);?></span><span style="color: Red; margin: 0px 5px;">*</span>
                </td>
            </tr>
            <?php if($vobank["bank_num"] > 10): ?><tr> 
                <td class="tdTitle">
                    输入您的当前的银行帐号：
                </td>
                <td class="tdContent">
                    <input class="text2" id="txt_oldaccount" type="text">
                    <span style="color: Red; margin: 0px 5px;">*</span> (为了您的资金安全，请输入您当前的银行账号)
                </td>
            </tr><?php endif; ?>
            <tr>
                <td class="tdTitle">
                    输入您新的银行帐号：
                </td>
                <td class="tdContent">
                    <input class="text2" id="txt_account" type="text">
                    <span style="color: Red; margin: 0px 5px;">*</span> (信用卡帐号无法提现，请不要误填)
                </td>
            </tr>
            <tr>
                <td class="tdTitle">
                   确认您新的银行帐号：
                </td>
                <td class="tdContent">
                    <input class="text2" id="txt_confirmaccount" type="text">
                    <span style="color: Red; margin: 0px 5px;">*</span> (请再次确认您添加的银行账号)
                </td>
            </tr>
            
            <tr>
                <td class="tdTitle">
                    开户银行所在省份：
                </td>
                <td class="tdContent">
                    <select name="selectp" id="province" style="width: 110px;" class="selectStyle">
                      <option value="0">请选择省份 </option>
                    </select>
                    <span style="color: Red; margin: 0px 5px;">*</span>
                </td>
            </tr>
            <tr>
                <td class="tdTitle">
                    开户银行所在市：
                </td>
                <td class="tdContent">
                    <select name="selectc" id="city" style="width: 110px;" class="selectStyle">
                        <option value="0">请选择城市</option>
                    </select>
                    <span style="color: Red; margin: 0px 5px;">*</span>
                </td>
            </tr>
            <tr>
                <td class="tdTitle">
                    输入开户行支行名称：
                </td>
                <td class="tdContent">
                    <input name="txt_bankName" id="txt_bankName" value="<?php echo ($vobank["bank_address"]); ?>" class="text2" type="text">
                    <span style="color: Red; margin: 0px 5px;">*</span> (如不能确定，请拨打开户行的客服热线咨询)
                </td>
            </tr>
            <tr>
                <td class="tdTitle">
                </td>
                <td class="tdContent">
                    <input value=" " class="btnsubupdate" id="btn_set" type="button">
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div style="width: 711px; margin: 0 24px; clear: both; height: 84px;">
    <div style="float: left; height: 84px; width: 20px;">
        <img src="__ROOT__/Style/M/images/minilogo.gif" style="width: 17px; height: 17px;
            margin: 3px; margin-top: 6px;">
    </div>
    <div style="width: 666px; float: left; padding: 4px; line-height: 20px; font-size: 12px;
        text-align: left; color: #aaaaaa;">
        请用户尽量填写较大的银行（如农行、工行、建行、中国银行等），避免填写那些比较少见的银行（如农村信用社、平安银行、恒丰银行等）。 否则提现资金很容易会被退票。<br>
        请您填写完整联系方式，以便遇到问题时，工作人员可以及时联系到您。
    </div>
</div>
<script type="text/javascript">
var areaurl="__URL__/getarea/";
var s = new GetAreaSelectbank('#province','#city','',<?php if(empty($vobank['bank_province'])): ?>1<?php else: echo ($vobank["bank_province"]); endif; ?>,<?php if(empty($vobank['bank_city'])): ?>1001<?php else: echo ($vobank["bank_city"]); endif; ?>);
</script>
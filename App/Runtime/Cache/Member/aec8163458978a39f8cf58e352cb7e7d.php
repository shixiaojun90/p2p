<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript">var bankimg = "__ROOT__/Style/M/";</script>
<script type="text/javascript">var Himg = "__ROOT__/Style/H/";</script>
<script type="text/javascript" src="__ROOT__/Style/M/js/recharge.js"></script>
<script type="text/javascript" src="__ROOT__/Style/js/jquery.skygqbox.1.3.js"></script>

<style type="text/css">
.dv_account_0 { margin-top: 10px; }
.cz dl{line-height: 200%;margin-bottom: 12px;}
.cz dt{width: 160px;text-align: right; display: inline-block;}
.cz dd{display: inline-block;}
.cz dd input{width: 120px; 
    border: 1px solid #D4D4D4;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
    color: #555555;
    display: inline-block;
    font-family: Tahoma,"微软雅黑","宋体";
    font-size: 14px;
    height: 20px;
    line-height: 20px;
    padding: 9px 6px; vertical-align: middle;
}

.btn1{background: url("/Style/M/images/bank/btnbg.png") repeat scroll 0 0 transparent;
    border: 0 none;
    cursor: pointer;
    height: 44px;
    width: 104px;
    color: #FFFFFF;
    font-family: Tahoma,微软雅黑,宋体;
}
.btn1:hover {
    background-position: 0 -46px;
}


.radiobox {
    display: inline-block;
    font-size: 14px;
    margin:5px;
    width:80px;
    position: relative;
    text-decoration: none;
    vertical-align: middle;
}
a.radiobox:link, a.radiobox:visited {
    background: none repeat scroll 0 0 #F5F5F5;
    border: 2px solid #CFCFCF;
    color: #555555;
    height: 30px;
    padding-top:5px;
    padding-bottom:5px;
    text-align:center;
}
.selected a.radiobox:link, .selected a.radiobox:visited, a.radiobox:active, a.radiobox:hover {
    background: none repeat scroll 0 0 #FFFFFF;
    background-color: #F4F8EB;
    border: 2px solid #A5C85B;
    color: #608908;
    height: 30px;
    outline: 0 none;
    text-align:center;
}




.radiobox .iconcheck {
    bottom: 0;
    display: none;
    position: absolute;
    right: 0;
}

.iconcheck {
    background: url("/Style/M/images/bank/element.png") no-repeat  0 -103px transparent;
    display: inline-block;
    font-size: 0;
    height: 16px;
    line-height: 16px;
    vertical-align: middle;
    width: 16px;
}
.selected .iconcheck {
    display: block;
    background-position: -112px -72px;
    margin: -16px 0 0 104px;
}

.modbank:after {
    clear: both;
    content: ".";
    display: block;
    height: 0;
    visibility: hidden;
}
.modbank {
    color: #666666;
    font: 12px/1.4 "微软雅黑","宋体",Tahoma;
    padding-bottom: 10px;
}

.modbank .banklogo {
    border: 1px solid #DDDEDE;
    cursor: pointer;
    display: block;
    float: left;
    height: 30px;
    line-height: 30px;
    margin: 0 -1px -1px 0;
    position: relative;
    width: 120px;
    z-index: 0;
}
.modbank .banklogo:hover, .modbank .selected {
    background-color: #F4F8EB;
    border: 1px solid #A5C85B;
    z-index: 3;
}


.modbank .iconradio {
    background: url("/Style/M/images/bank/element.png") no-repeat scroll -48px -56px transparent;
    margin-left: 8px;
    margin-right: 8px;
    position: relative;
    vertical-align: -2px;
    display: inline-block;
    font-size: 0;
    height: 16px;
    line-height: 16px;
    vertical-align: middle;
    width: 16px;
}
.button-255{ width:150px; height: 60px; font-size: 18px; cursor: pointer;}

</style>

<div style="height: 25px; width: 100%; line-height: 25px; text-indent: 26px;
    text-align: left; margin: 0px; padding: 12px 0px;" class="charge2">
    温馨提示：最低充值金额50元。充值免手续费！充值资金可用于进行验证、投标、还款等。充值成功后资金会立刻划拨到您的帐户。
</div>

<!--资金输入-->
<form action="<?php echo U("Charge/moneymmcharge");?>" method="post" id="chargeForm" >
<div class="cz" style="width: 700px;margin: 10px 0 10px 35px;padding: 8px 0 8px 12px; border:1px #E9E8E7 solid;">
    <dl>
        <dt style="float:left;">账户余额：</dt>
        <dd style="width:500px;"><span style="color: Red;font-size: 24px;font-weight: bold;"><?php echo (($balance)?($balance):"0.00"); ?></span>&nbsp;&nbsp;元&nbsp;</dd>
    </dl>
    <dl>
        <dt style="float:left;">充值金额：</dt>
        <dd style="width:500px;"><input type="text" name="money" class="input_money" value="0.00"  id="t_money"  onblur="testAmount();">&nbsp;&nbsp;元&nbsp;&nbsp;<span class="rtu"></span></dd>
        <dt style="float:left;">大写金额:</dt><dd style="width:500px; height:20px;"><span id="d_money_3"></span></dd>
    </dl>
    <div style="clear:both;"></div>

    
    <div style="clear:both;"></div>
    <hr style="clear:both; margin:20px 0; margin-right: 10px; border-top:1px solid #e6e6e6 ;" />
    <dl>
        <div style="text-align:center; width: 63%;"><input type="button" class="btn1" ></div>
    </dl>
    </form>
    <script type="text/javascript">

        //充值金额
        $('.input_money').click(function(){
            $('.rtu').html("<img style='margin:2px;' src='/Style/H/images/zhuce1.gif'/>&nbsp;请输入正确的金额，最小充值金额50元。");
            return false;
        });

        $('.input_money').blur(function(){
            BlurMoney();
        });

        function BlurMoney() {
            var pat = /^[0-9]*(\.[0-9]{1,2})?$/;
            var str = $('.input_money').val();

            if (str == "") {
                $('.rtu').html("<img style='margin:2px;' src='/Style/H/images/zhuce2.gif'/>&nbsp;输入的金额不能为空！");
                return false;
            }

            // var m = parseInt(str);
            var m = parseFloat(str);
            // alert(m);

            if (m < 0.01) {
                $('.rtu').html("<img style='margin:2px;' src='/Style/H/images/zhuce2.gif'/>&nbsp;最低充值金额为50元！");
                return false;
            }

            if (pat.test(str)) {
                $('.rtu').html("<img style='margin:2px;' src='/Style/H/images/zhuce3.gif'/>&nbsp;");
                return true;
            }else {
                $('.rtu').html("<img style='margin:2px;' src='/Style/H/images/zhuce2.gif'/>&nbsp;请输入正确的金额，小数点后最多2位数。");
                return false;
            }
            return true;
        }
        $(function(){
            $(".btn1").click(function(){
                 if(BlurMoney()){
                     $("#chargeForm").submit();
                 }
            })
            
        })

       
    </script>
<script type="text/javascript" src="__ROOT__/Style/M/js/amounttochinese.js" language="javascript"></script>
<script type="text/javascript">
$(function() {
    $("#t_money").bind("keyup", function() {
        $this = $(this);
        $this.val($this.val().toString().replace(/[^(\d|\.)]+/, ""));
    });
    $("#t_money").focus(function() {
        $("#d_money_3").css("display", "none");
    });
});
function testAmount() {
    
    var testreuslt = true;

    if (testreuslt) {
        showChineseAmount();
    }
    return testreuslt;
}

function showChineseAmount() {
    var regamount = /^(([1-9]{1}[0-9]{0,})|([0-9]{1,}\.[0-9]{1,2}))$/;
    var reg = new RegExp(regamount);
    if (reg.test($("#t_money").val())) {
        var amstr = $("#t_money").val();
        var leng = amstr.toString().split('.').length;
        if (leng == 1) {
            $("#t_money").val($("#t_money").val() + ".00");
        }
        $("#d_money_3").html(Arabia_to_Chinese($("#t_money").val()));
        $("#d_money_3").css("display", "");
        $("#d_money_3").css("color", "red");
        $("#d_money_3").removeClass("reg_wrong");
        
    }
    else {
        $("#d_money_3").html("");
    }
}
</script>
</div>
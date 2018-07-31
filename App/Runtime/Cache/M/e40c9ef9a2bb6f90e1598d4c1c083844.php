<?php if (!defined('THINK_PATH')) exit();?>﻿

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

		



 
	 <div class="mainpage">	
       
				
  <h3 class="homehead" >注册</h3>
     
         <div class="usereditepass">   
		     
<form  action="" method="post" name="loginForm" id="loginForm">	  
     <ul> 
	
	<li> <label>手&nbsp;&nbsp;机&nbsp;&nbsp;号:&nbsp;</label><input type="text" name="txt_phone" id="txt_phone" class="inputs"><font color=red>*</font></li> 
	
	 <?php if($is_manual == '0'): ?><li id="mobilexs" > <lable>手机验证:&nbsp;</label><input type="text" name="mobilecode" id="mobilecode" class="inputs"  style="width: 100px;">
	<a onclick="sendMobileValidSMSCode();" style="display:blcok;  width:100px; height:32px; border:1px solid #ddd; background:#007EB9; color:#fff; text-align:center; line-height:32px; cursor: pointer;"><font id="sendSMSTip">发送验证码</font></a></li><?php endif; ?>
    <li id="sendSMSTip" style="display:none">  </li>
   <li><label>电子邮箱:&nbsp;</label><input type="text" name='email' id="email" value="" class="inputs" /></li>
 <li><label>用&nbsp;&nbsp;&nbsp;户&nbsp;&nbsp;名:</label><input type="text" name='username' id="username" value="" class="inputs" /><font color=red>*</font></li>
 <li><label>密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码:</label><input type="password" name="password" value="" id="password" class="inputs" /><font color=red>*</font></li>
<li><label>确认密码:</label><input type="password" name="password2" value="" id="password2" class="inputs" /><font color=red>*</font></li>
  <li><label>推&nbsp;&nbsp;荐&nbsp;&nbsp;人:</label><input type="text" name="recommend"  class="inputs" id="recommend" >   </li>
    
	 <li style="text-align:center;"> <input type="button" class="buybutton" value="下一步" /> </li>
	 </ul>
</form>				 
				 

    </div>
        
<!------顶部布局开始------>		

<div class="footer">
   
    <ul class="copyright">
        <li>已有账号，请<a href="<?php echo U('M/pub/login');?>"><font color="#f08012">登录</font></a></li>
		 
    </ul>
</div>

 </div> <!-----控制容器结束---->
<!-----底部布局结束----->
  </div> <!-------mainpage end------->
 
 </div>

</body>
</html>
<script language="javascript">



function strLength(as_str){
		return as_str.replace(/[^\x00-\xff]/g, 'xx').length;
}
function isLegal(str){
		if(/[!,#,$,%,^,&,*,?,~,\\,|,;,",<,>,(,),+,@,.,\s+]/gi.test(str)) return false;
	var str1 = str.toLowerCase()
	if(str1.indexOf("script") >= 0 || str1.indexOf("select") >= 0 || str1.indexOf("update") >= 0 || str1.indexOf("delete") >= 0 || str1.indexOf("insert") >= 0 || str1.indexOf("insert") >= 0 || str1.indexOf("drop") >= 0 || str1.indexOf("truncate") >= 0 || str1.indexOf("union") >= 0 || str1.indexOf("user") >= 0 || str1.indexOf("load_file") >= 0 || str1.indexOf("outfile") >= 0)
	{
		return false;
	}
	return true;
}
$(function(){
    $(".buybutton").click(function(){
		//var regex = /^(?!_)(?!.*?_$)[a-zA-Z0-9_\u4e00-\u9fa5]+$/;
		var pwdy = /^[a-zA-Z0-9_]{6,16}$/;//验证密码
        //var username =  $.trim($("#username").val());
        var password =  $.trim($("#password").val());
        var password2 =  $.trim($("#password2").val());
		var recommend =$.trim($("#recommend").val());
		var txt_phone =$.trim($("#txt_phone").val());
		var txt_phone_code =$.trim($("#mobilecode").val());
		var email =  $.trim($("#email").val());
        var re= /\w@\w*\.\w/;
		
		var pat = /^1[3|4|5|7|8][0-9]\d{4,8}$/;

		var str = $.trim($("#username").val());
		var strlen = strLength(str);
		if (isLegal(str) && strlen>=4 && strlen<=20) {
			if (!str.match(/^[\w\u4E00-\u9FA5]+$/)) {
                    return Apprise('<font color=red>请输入正确用户名!4-20个字母、数字、汉字、下划线</font>');
                }
			
		}
		else {
			return Apprise('<font color=red>请输入正确用户名!4-20个字母、数字、汉字、下划线</font>');
		}
        //if (!username.match(/^[\w\u4E00-\u9FA5]{4,20}$/)) {
		//	return Apprise('<font color=red>请输入正确用户名!4-20个字母、数字、汉字、下划线</font>');
		//}
        //if(!regex.test(username)){
        //    return Apprise('<font color=red>只含有汉字、数字、字母、下划线不能以下划线开头和结尾</font>'); 
        //}
        if(username==''){
            return Apprise('<font color=red>请输入用户名</font>'); 
        }
        if(password == ''){
            return Apprise('<font color=red>请输入密码！</font>'); 
        }
		if (!pwdy.test(password)) {
			return Apprise('<font color=red>密码格式不正确!6-16位字母、数字、下划线</font>');
		}
        if(password2 == ''){
            return Apprise('<font color=red>请输入确认密码！</font>'); 
        }
        if(txt_phone == ''){
            return Apprise('<font color=red>请输入手机号码！</font>'); 
        }
		if (!pat.test(txt_phone)) {
			return Apprise('<font color=red>请输入正确手机号码！</font>'); 
		}
		

		if(email == ""){
            email = "";
        }else{
			email = email;
		}

        if(password != password2){
            return Apprise('<font color=red>确认密码不正确，请修改</font>'); 
        }
        $.ajax({
			url: "__URL__/regtemp/",
			data: {"txtEmail": email,"txtUser": str,"txtPwd": password,
			"txtRec": recommend,"phoneCode": txt_phone_code,
			"txt_phone":txt_phone},
			//timeout: 8000,
			//cache: false,
			type: "post",
			dataType: "json",
			success: function (d, s, r) {
				if(d){
					if(d.status==0){
						 return Apprise(d.message);
					}else{
						//window.location.href = "/M/pub/login" ;
						window.location.href="__URL__/register2/";
					}
				}
			}
		});
    })
})



var mbTest = /^(13|14|15|18|17)[0-9]{9}$/;
var timer = null;
var leftsecond = 60; //倒计时
var msg = "";


function sendMobileValidSMSCode() {
	var mobile = $("#txt_phone").val();
	if (mobile == "") {
		Apprise("<font color=red>请输入手机号码</font>")
		//$('#txt_phone').html("请输入手机号码");
		return;
	}
	if (mbTest.test(mobile)) {
		$('#sendSMSTip').html("短信发送中...");
		$.ajax({
			url: "__URL__/sendphone/",
			type: "post",
			dataType: "json",
			data: {"cellphone":mobile},
			success: function(d) {
				leftsecond = 60;
				if (d.status == 1) {
					$("#txt_phone").attr("readonly", true);

					clearInterval(timer);
                    timer = setInterval(setLeftTime, 1000, "1");
                    $('#sendSMSTip').html("短信已经发送，请查收");
                    $("#sendPhoneNum").hide();
				}
				else if (d.status == 2) {
					return Apprise('<font color=red>手机号已经在本站注册</font>');
					//$('#sendSMSTip').html("该手机号码已被其他用户使用");
					//$("#txt_phone_code").removeAttr("readonly");
				}
				else {
					msg = "发送失败";
					$("#sendSMSTip").html(msg);
		
				}
			}
		});
	}
	else {
		
		$("#sendSMSTip").html("手机号码有误");
	}
}

function resendMobileValidSMSCode(phone) {
	
	var mobile = phone;
	
	if (mbTest.test(mobile)) {
		$('#sendSMSTip').html("短信发送中...");
		$.ajax({
			url: curpath+"/sendphone/",
			type: "post",
			dataType: "json",
			data: {"cellphone":mobile},
			success: function(d) {
				leftsecond = 60;
				if (d.status == 1) {
					$("#btnSendMsg").html("");
					clearInterval(timer);
					timer = setInterval(setLeftTime, 1000, "1");
				}
				else if (d.status == 2) {
					$('#sendSMSTip').html("该手机号码已被其他用户使用");
					
					
				}
				else {
					msg = "校验码发送失败,请重试";
					$("#sendSMSTip").html(msg);
					//$("#txt_phone").attr("readonly", true);
				}
			}
		});
	}
	else {
		
		$("#sendSMSTip").html("手机号码有误");
	}
}
function setLeftTime() {
	var second = Math.floor(leftsecond);
	$("#sendSMSTip").eq(0).html(msg + second + "秒后可重发");
	leftsecond--;
	if (leftsecond < 1) {
		$("#sendSMSTip").eq(0).html("现在可重新发送！");
		clearInterval(timer);
		try {
			$("#btnSendMsg").html("获取验证码");
			$("#txt_phone").removeAttr("readonly");
		} catch (E) { }
		return;
	}
}


function setMobile() {
	var code = $('#txt_smsCode').val();
	
	$.ajax({
		url: "__URL__/validatephone",
		type: "post",
		dataType: "json",
		data: {"code":code},
		success: function(d) {
			if (d.status==1) {
				//$.jBox.tip("验证成功");
				window.location.href="/m/Verify/register3/";
			}
			else {
				if (d.status == 2) {
					return Apprise(d.message); 
					//$(".spTip").html(d.message);
					//setTimeout("failskip()",5000);
				}
				if (d.status == 0) {
					return Apprise(d.message); 
					//$(".spTip").html(d.message);
					//setTimeout("failskip()",5000);
				}
			}
		}
	});
}
</script>
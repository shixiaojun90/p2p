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

		



		
	 <div class="mainpage">	
       
				
  <h3 class="mainpagehader" >找回密码</h3>
     
         <div class="usereditepass">   
		     
		<div  id="send_code">	  
         <ul> 
               <li><label>手机号：</label><input type="text" name='mobilenum' id="mobilenum" class="inputs" />&nbsp;<a href='#' id="sendmsg">发送</a></li>
               <li><label>验证码：</label><input type="text" name="phonecode" id="phonecode" class="inputs" /><font color=red>*</font></li>
               <li style="text-align:center;"> <input type="button" class="buybutton" value="确&nbsp;&nbsp; 定" /> </li>
	     </ul>
		
		</div>
		
		<div id="send_pass" style="display:none;">
		 <form action="__URL__/getfgtpass" name="form2" >
			 <ul> 
               <li><label>输入密码：</label><input type="password" name='password1' id="mobilenum" class="inputs" /><font color=red>*</font></li>
               <li><label>重复密码：</label><input type="password" name="password2" id="phonecode" class="inputs" /><font color=red>*</font></li>
               <li style="text-align:center;"> <input type="button" class="buybutton1" value="确&nbsp;&nbsp; 定" /> </li>
	        </ul>	
	     </form>
		 </div>			 
				 

    </div>
        
<!------顶部布局开始------>		


<!-----底部布局结束----->
  </div> <!-------mainpage end------->
 
 </div>

</body>
</html>
<script language="javascript">
$(function(){
    $(".buybutton").click(function(){
        var mobilenum=$("#mobilenum").val();
		var phonecode=$("#phonecode").val();
		
		if(phonecode==''){
		  return Apprise("验证码不能为空");
		 }
		
        $.ajax({
           type: "POST",
           url: "__URL__/getfgtpass/",
           data: 'mobilenum='+mobilenum+'&phonecode='+phonecode,
           success: function(msg){
		
               if(msg=='true'){
                   $("#send_code").hide();
				   $("#send_pass").show(); 
                
               }else{
			 
                  Apprise('<font color=red>'+msg+'</font>');
               }
           },
           error:function(err){
               Apprise("<font color=red>提交发生错误！请重试</font>");
           }
       });
    })
})
</script>


<script type="text/javascript">
  $(function(){
     $("#sendmsg").click(function(){
	   var mbTest = /^(13|14|15|18)[0-9]{9}$/;
	   var mobilenum=$("#mobilenum").val();
	   if(mobilenum=='')
	    {
		  return Apprise("<font color='red'>手机号码不能为空!</font>");
		}
	   if(mbTest.test(mobilenum))
        {
		 $(this).html("已发送");
		//这里实现发送开始.......................
		   $.ajax({
			url: "__APP__/m/pub/getsendcode/",
			type: "post",
			dataType: "json",
			data: {"cellphone":mobilenum},
			success: function(d) {
				leftsecond = 60;
				if (d.status == 1) {
					$("#mobilenum").attr("readonly", true);
				     $("#mobilexs").show();
					clearInterval(timer);
					timer = setInterval(setLeftTime, 1000, "1");
				}
				else if (d.status == 2) {
					//$('#sendSMSTip').html("该手机号码已被其他用户使用");
					//Apprise("手机号码已经被其他用户注册");
					$("#mobilenum").removeAttr("readonly");
				}else {
					msg = "校验码发送失败,请重试";
					//$("#sendSMSTip").html(msg);
					 Apprise("发送失败，请重试");
					
					$("#mobilenum").attr("readonly", true);
				}
			}
		});
		//这实现发送开始.............................
		
		}else{
		  Apprise("不合法的手机号");
		}	   
		
		
	 
	 });
  
  })

</script>

<script language="javascript">
$(function(){
    $(".buybutton1").click(function(){
        var mobilenum=$("#mobilenum").val();

		var password1=$("input[name='password1']").val();
		var password2=$("input[name='password2']").val();
		if(password1=='' || password2==''){
		  return Apprise("密码不能为空!");
		 }
	    if(password1!=password2){
		   return Apprise("前后密码不一致");
		 } 
		 
		
        $.ajax({
           type: "POST",
           url: "__URL__/getfgtpasshandle/",
           data: 'mobilenum='+mobilenum+'&password='+password1,
           success: function(msg){
		
               if(msg=='true'){
                Apprise("修改成功");
				 location.href='__APP__/m/pub/login/';
                
               }else{
			 
                  Apprise('<font color=red>'+msg+'</font>');
               }
           },
           error:function(err){
               Apprise("<font color=red>提交发生错误！请重试</font>");
           }
       });
    })
})
</script>
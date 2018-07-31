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
       
				
  <h3  class="mainpageleft" >用户登录</h3>
     
         <div class="usereditepass">   
		     
<form  action="" method="post" name="loginForm" id="loginForm">			  
     <ul> 
     <li><label>用户名：</label><input type="text" name='username' id="username" value="" class="inputs"  style="background:#fff;"/><font color=red>*</font></li>
    <li><label>密&nbsp;&nbsp;&nbsp;码：</label><input type="password" name="password" value="" id="password" class="inputs" style="background:#fff;"  /><font color=red>*</font></li>
    <li><label>验证码：</label><input type="text" name="verify" id="verify" class="inputs" value="" style="width:60px" />
 <img src='/M/Pub/verify'  class="verify" onclick="this.src=this.src+'?t='+Math.random()"/></li>
    
	 <li style="text-align:center;"> <input type="button" class="buybutton" value="登&nbsp;&nbsp; 录" style="border:0px;" /> </li>
	 </ul>
</form>				 
				 

    </div>
        
<!------顶部布局开始------>		

<div  style="text-align:center;margin-top:8px;">
   
    <ul class="copyright">
        <li><a href="__URL__/regist">注册</a><span>|</span><a href="__URL__/getfgtpass/">忘记密码</a></li>
		 
    </ul>
</div>

	
<div class="footer">
   
    <ul class="copyright">
        <li><a href="http://hebangjiedai.com/">电脑版</a><span><!-- |</span><a href="__ROOT__/m/linkus/">联系我们</a> --></li>
		 <li><a href="tel:4006290211">联系电话：400-106-1506</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1256061766'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/z_stat.php%3Fid%3D1256061766%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script></li>
    </ul>
</div>

 </div> <!-----控制容器结束---->

 </div> <!-----控制容器结束---->
<!-----底部布局结束----->
  </div> <!-------mainpage end------->
 
 </div>

</body>
</html>
<script language="javascript">
$(function(){
    $(".buybutton").click(function(){
        if($.trim($("#username").val())==''){
            Apprise('<font color=red>请输入用户名！</font>');
            return false;
        }
        if($.trim($("#password").val())==''){
            Apprise('<font color=red>请输入密码！</font>'); 
            return false;
        }
        if($.trim($("#verify").val())==''){
            Apprise('<font color=red>请输入验证码！</font>'); 
            return false;
        }
        $("#loginForm").submit();
    })
})
</script>
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
       
				
  <h3 class="mainpagehader" >安全中心</h3>
     
         <div class="userloan">   
		     
			  
<ul> 
        <li>真实姓名：<?php echo (($memberdetail["real_name"])?($memberdetail["real_name"]):"还未验证"); ?><!-- [<a href="__URL__/cardid">编辑</a>] --></li>
		<li> 身份证号：<?php echo (hidecard($memberdetail["idcard"],2)); ?><!-- [<a href="__URL__/cardid">编辑</a>]  --></li> 
    <!-- <li>登陆密码：已设置[<a href="<?php echo U("M/user/editpass");?>" >修改</a>]</li> -->

    <li>手机号码：</td><td>
        <?php echo (hidecard($memberinfo["user_phone"],2,"还未验证")); ?><!-- [<a href='__URL__/editephone'>编辑</a>] -->
   </li>
    <li>电子邮箱:
        <?php echo (($memberinfo["user_email"])?($memberinfo["user_email"]):"未设置"); ?><!-- [<a href='__URL__/setemail'>编辑</a>] --></li>
      <!-- <li><a href='__APP__/m/bank/banklist/'> 银行卡信息 </a></li> -->
    </ul>
    </div>
      <!-- <div class="realnamerz"> *实名认证时尽量在wifi信号比较好的情况！ </div>   -->
<!------顶部布局开始------>		


<!-----底部布局结束----->
  </div> <!-------mainpage end------->
 
 </div>

</body>
</html>
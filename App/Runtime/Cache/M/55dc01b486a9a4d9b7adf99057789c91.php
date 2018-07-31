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
       
				
  <h3 class="mainpagehader">个人信息</h3>
     
         <div class="userinfo">   
		     
			  <ul > 
			      <li><span>用户名:</span>&nbsp;&nbsp;<a href="#"  ><?php echo ($minfo["user_name"]); ?> </a></li>  
				  <li> <span>投资等级： </span><a href="#" ><?php echo (getinvestleveico($minfo["integral"],3)); ?> </a></li>
				  <li><span>信用额度：</span><a href="#"  ><?php echo (fmoney($minfo["credit_cuse"])); ?> </a></li>  
				    <li><span>信用等级：</span><a href="#"  ><?php echo (getleveico($minfo["credits"],2)); ?> </a></li>  
				  <li> <span>VIP期限: </span><a href="#" > 
				  <?php if($minfo["user_leve"] == 0): ?>您还未申请VIP
                       <?php elseif($minfo["time_limit"] > time()): ?>
                        <?php echo (date("Y-m-d",$minfo["time_limit"])); ?>到期
                  <?php else: ?>
                       您的VIP已于<?php echo (date("Y-m-d",$minfo["time_limit"])); ?>到期<?php endif; ?> </a>
					   </li>
				  <li> <span>所属客服：</span><a href="#" ><?php echo ($kflist[$minfo['customer_id']]); ?> </a></li>
				  <li><span>客服电话：</span><a href="#"  ><?php echo ($kfs[0]['phone']); ?> </a></li>  
				  <li> <span>客服QQ :</span><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo ($kfs[0]['qq']); ?>&amp;site=qq&amp;menu=yes" target="_blank" ><?php echo ($kfs[0]['qq']); ?>&nbsp;</a></li>
				  <li> </li>
				 
				 
		   </ul>
    </div>
        
<!------顶部布局开始------>		


<!-----底部布局结束----->
  </div> <!-------mainpage end------->
 
 </div>

</body>
</html>
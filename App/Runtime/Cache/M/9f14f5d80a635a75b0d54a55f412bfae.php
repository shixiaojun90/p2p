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

		



		
	 <div class="mainpage" id="usermsgbg">	
       
				
  <h3 class="mainpagehader" >资金历史明细</h3>
     
   <!-------信息区开始-------->	 
           
	
	 <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="userrecords"> 
			   <ul>	
					 <li class="litime"  style="border-bottom:1px  dashed #d5d5d5;" > <?php echo date("y年m月d日", $vo['add_time']) ?> </li>
		      </ul>
			 <div style="clear:both"> </div>	
			   
			   <ul>	
					
					 <li  class="lifloat" >操作：<?php echo ($vo["type"]); ?></li>  
					<li  class="lifloat" >金额：<span class="je"><?php echo (mformt($vo["affect_money"])); ?>元 <span></li>
		      </ul>
			 <div style="clear:both"> </div>	
			
		     <ul>  
			        <li  class="lifloat" >可用：<span class='ky'><?php echo MFormt($vo['account_money']+$vo['back_money']);?>元</span></li>  
					<li  class="lifloat" >冻结：<span class='dj'><?php echo (mformt($vo["freeze_money"])); ?> 元</span></li>
			</ul>
			<div style="clear:both"> </div>	
			   <ul>	
					<li>待收：<span class="ds"><?php echo (mformt($vo["collect_money"])); ?>元 </span></li>
		      </ul>
			<div style="clear:both"> </div>	  
			   <ul>
			       <li>说明：<?php echo ($vo["info"]); ?>  </li>
			   </ul>
			 <div  style="clear:both">  </div>  
			  
			 </div><?php endforeach; endif; else: echo "" ;endif; ?>	  
			  
			  
	
  <div class="pagebar"><?php echo ($pagebar); ?></div>﻿	 
	<!------信息区结束------>	  
        

<!------顶部布局开始------>		


<!-----底部布局结束----->
  </div> <!-------mainpage end------->
 
 </div>

</body>
</html>
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

		



  <div class="marginpage">
      <h3 class="mainpagehader"> 用户充值 </h3>
	  
	   <div class="chargecash">
	   <form action="__URL__/mobilecharge" name="form1" method="post" >  
	        <ul>
		         <input type="hidden" name="RechargeType" value="2">
				 <input type="hidden" name="FeeType" value="2">
				 <li> <label>金额： </label><input type="text" class="inputs"  id="money" name="money"> </li>
				 <li class="ts"> 温馨提示：最低充值金额50元。充值扣除手续费千分之一！充值资金可用于进行验证、投标、还款等。充值成功后资金会立刻划拨到您的帐户。 </li>
				 <li class="submit" > <a href='#' id="submit"   class="buybutton"> 立即充值 </a></li> 
				 <li><img src="__ROOT__/Style/newmobile/images/mrxe.jpg" style="width:100%;" /></li>
			</ul>
		</form>	
	    
	   </div>
	 
	 
  </div>
	
<div class="footer">
   
    <ul class="copyright">
        <li><a href="http://hebangjiedai.com/">电脑版</a><span><!-- |</span><a href="__ROOT__/m/linkus/">联系我们</a> --></li>
		 <li><a href="tel:4006290211">联系电话：400-106-1506</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1256061766'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/z_stat.php%3Fid%3D1256061766%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script></li>
    </ul>
</div>

 </div> <!-----控制容器结束---->
<script  type="text/javascript">
 $(function(){
     $("#submit").click(function(){

	     var money=$("#money").val();
	   if(money=='')
		 return alert("提现金额不能为空");
	     else if(money<50)
		  return alert("提现金额不能少于50");
        if(money>=1000){    
        var fee=money/1000;    
		var fee=toDecimal2(fee); 
        }else{
		   fee=1.00;
		 }


		if(confirm("确定要充值")){
		    $('form').submit();
		 }
	 
	  });
 
  })



 function toDecimal2(x) {    
            var f = parseFloat(x);    
            if (isNaN(f)) {    
                return false;    
            }    
            var f = Math.round(x*100)/100;    
            var s = f.toString();    
            var rs = s.indexOf('.');    
            if (rs < 0) {    
                rs = s.length;    
                s += '.';    
            }    
            while (s.length <= rs + 2) {    
                s += '0';    
            }    
            return s;    
        }    

</script>
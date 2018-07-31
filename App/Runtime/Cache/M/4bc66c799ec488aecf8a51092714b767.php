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
       
				
  <h3 class="mainpageleft" >购买</h3>
    <form action="__URL__/investmoney" name="form1" method="post" > 
	   <input type="hidden" name="borrow_id" id="borrow_id" value="<?php echo ($borrow_info["id"]); ?>">
         <div class="usereditepass">   
		     
			  
<ul> 
        <li><label>可用余额：</label><?php echo (mformt($user_info["money"])); ?>元<input type="hidden" name="kymoney" value="<?php echo ($user_info["money"]); ?>" id="kymoney"></li>
        <li><label>还需金额：</label><?php echo MFormt($borrow_info['borrow_money']-$borrow_info['has_borrow']);?>元/<?php echo (mformt($borrow_info["borrow_money"])); ?>元</li>
        <li><label>最小投资：</label> <?php if($borrow_info["borrow_min"] == 0): ?>没有限制
                  <?php else: ?>
                  <?php echo (mformt($borrow_info["borrow_min"])); ?>元<?php endif; ?>
	    <input type="hidden" id="borrow_min" value="<?php echo ($borrow_info["borrow_min"]); ?>"  >			  
				  
				  </li>
				  
		 <li><label>最大投资：</label> <?php if($borrow_info["borrow_max"] == 0): ?>没有限制
                  <?php else: ?>
                  <?php echo (mformt($borrow_info["borrow_max"])); ?>元<?php endif; ?>
		 <input type="hidden" id="borrow_max" value="<?php echo ($borrow_info["borrow_max"]); ?>">		  
		  </li>		
	
		 
<li><label>投资金额：</label><input type="text" name="invest_money" id="invest_money" autocomplete="off" value="" class="inputs"><font color=red>*</font> 元</li>
		   
		 <?php if(!empty($borrow_info['password'])): ?><li><label>定向标密码</label><input type="password" id="borrow_pass" name="borrow_pass" class="inputs"/></li><?php endif; ?>
		    
	     <li style="text-align:center;border-bottom:none">
		 <input class="buybutton" style="border:0px;width:96%;display:block;color:#fff;" value="提&nbsp;&nbsp;交"></li>
		  <input type="hidden" name="borrow_uid" id="borrow_uid" value="<?php echo ($borrow_info["uid"]); ?>">
		  <input type="hidden" name="uid" id="uid" value="<?php echo ($uid); ?>">
		  
	 </ul>
				
     </div>
 </form>       
<!------顶部布局开始------>		


<!-----底部布局结束----->
  </div> <!-------mainpage end------->
 
 </div>

</body>
</html>

<script language="javascript">
$(function() {
    $(".buybutton").click(function() {
        var borrow_uid=$("#borrow_uid").val();
		var uid=$("#uid").val();
		var passwords='<?php echo ($borrow_info["password"]); ?>';
		var borrow_pass=$("#borrow_pass").val();
		if(borrow_uid==uid){
			return Apprise("不能投自己的标 ");
		}

		

	    var kymoney=$("#kymoney").val();
        var e = $("#invest_pass").val();
        var    t = $("#invest_money").val();
        var    n = $("#paypass").val();
		var 	bid=$("#bid").val();
	    var borrow_min=$("#borrow_min").val();	
        var borrow_max=$("#borrow_max").val();

        if ($.trim($("#invest_money").val()) == "") return Apprise("<font color=red>请输入投资金额!</font>");
        if (passwords != ''){
			if(borrow_pass == '') return Apprise("<font color=red>请输入投标密码！!</font>");
		}

         if(borrow_min!=0){
		     borrow_ys=t%borrow_min;
			  if(borrow_ys!=0){
			      return Apprise("<font color='red'>投资金额必须是最小投资金额的整数倍</font>");
			   }
		  }
		 
        if(borrow_max!=0){
			borrow_max=parseFloat(borrow_max);
			 if(t>borrow_max){
			     return Apprise("<font color='red'>投资金额不能大于最高投资金额</font>");
			  }

		  }		 
  
   kymoney=parseFloat(kymoney);
	 /*if(t>kymoney){
	     return  Apprise("投资金额超出了可用金额");
		 
	   }*/	  	
	   		
			
     if(confirm("确定要投资"+t+"元")){ 
		
	/******提交***/	
        $('form').submit();
		
		/******提交***/		
	 }else{
	   location.href="__URL__/seeinvest?id=<?php echo ($bid); ?>";
	 
	  }	
		
		
		
    })
})
</script>
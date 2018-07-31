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
  <script type="text/javascript" src="__ROOT__/Style/js/area1.js" language="javascript"></script>
     
	  
	   <div class="bankinfo"> 
	   <h3 class="mainpagehader"> 银行账户</h3>
	   <form action="__URL__/bankinfohandle/" name="form1" method="post" >  
	        <ul>
		       <li>
				<label>
					&nbsp;&nbsp;&nbsp;银行账号：
				</label>
					<?php echo (hidecard($vobank["bank_num"],3,'还没有登记您的银行账号')); ?>
				
			</li>
			<li>
				<label>
					&nbsp;&nbsp;&nbsp;银行名称：
				</label>
				
 			   <select name="bank_name"  id="bank_name" >
			   
			       <?php if(is_array($bank_list)): $i = 0; $__LIST__ = $bank_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bank_list): $mod = ($i % 2 );++$i; if($i == $vobank['bank_name']): ?><option value="<?php echo ($i); ?>" selected="selected">   <?php echo ($bank_list); ?> </option>
				       <?php else: ?>
					      <option value="<?php echo ($i); ?>" >   <?php echo ($bank_list); ?> </option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			   
			   </select> 
				  
				
			</li>
			<li>
				<label>
					&nbsp;&nbsp;&nbsp;户主姓名：
				</label>
				
					<span id="spname"><?php echo cnsubstr($voinfo['real_name'],1,0,'utf-8',false).str_repeat("*",strlen($voinfo['real_name'])-1);?></span><span style="color: Red; margin: 0px 5px;">*</span>
				
			</li>
			<?php if($vobank["bank_num"] > 10): ?><li> 
				<label>
					 &nbsp;&nbsp;&nbsp;当前帐号：
				</label>
				
					<input class="text2" id="txt_oldaccount" type="text" name="txt_oldaccount">*
				
			</li><?php endif; ?>
			<li>
				<label>
					新银行帐号：
				</label>
				
					<input class="text2" id="txt_account" type="text" name="txt_account">
					
				
			</li>
			<li>
				<label>
				 &nbsp;&nbsp;&nbsp;确认帐号：
				</label>
					<input class="text2" id="txt_confirmaccount" type="text">
					
				
			</li>
			
			<li>
				<label>
					银行所在省：
				</label>
				
					<select  id="province"  name="province">
					  <option value="0">请选择省份 </option>
					</select>
					
				
			</li>
			<li>
				<label>
					银行所在市：
				</label>
				
					<select  id="city"  class="selectStyle"  name="city">
						<option value="0">请选择城市</option>
					</select>
					<select name="selectc" id="district" style="width: 110px; display:none" class="selectStyle">
						<option value="0">请选择地区</option>
					</select>
					
				
			</li>
			    
		  
			
			<li>
				<label>
					开户行支行：
				</label>
				
					<input name="txt_bankName" id="txt_bankName" value="<?php echo ($vobank["bank_address"]); ?>" class="text2" type="text">
									
			</li>
			<li style="text-align:center;">
				<?php if($edit_bank == 1 or $vobank["bank_num"] < 10): ?><input value="提交 " class="buybutton" id="btn_set" type="button">
				<?php elseif($edit_bank == 0 and $vobank["bank_num"] > 10): ?>
					<input value=" 修改 "  type="button"  class="buybutton"><?php endif; ?>
			
			</li>
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
<script type="text/javascript">
var areaurl="__URL__/getarea/";
var s = new GetAreaSelect('#province','#city','#district',<?php if(empty($vobank['bank_province'])): ?>2<?php else: echo ($vobank["bank_province"]); endif; ?>,<?php if(empty($vobank['bank_city'])): ?>52<?php else: echo ($vobank["bank_city"]); endif; ?>);
</script>

<script type="text/javascript">
   $(function(){
      $(".buybutton").click(function(){
          var txt_account=$("#txt_account").val();  //当前银行账户
	   var txt_confirmaccount=$("#txt_confirmaccount").val();
	   var  province=$("#province").val();
	   var  city=$("#city").val();
	   var district=$("#district").val();
	   var txt_bankName=$("#txt_bankName").val();
	   var bank_name=$("#bank_name").val();
         if(txt_account=='')
		   return Apprise('请输入新账户');
	      if(txt_account!=txt_confirmaccount){
	      return Apprise("新账户和确认前后不一致");
	    }
		 if(province==''){
	       return Apprise("请选择所在省份");
		  }	
	   if(city==''){
	       return Apprise("请选择所在城市");
	    }
	    if(txt_bankName==''){
	     return Apprise('请输入所在支行');
	    }
	  if(bank_name==''){
	       return  Apprise("请选择银行");
		 }	
		 
		$('form').submit();
		
		 
	    });			  
   
    })

</script>
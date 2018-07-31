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

		




  <div class="tzrl_box m_index"> 
	 <div class="mainpage">	
       
				
  <h3  class="mainpageleft" style="margin-top:10px;padding-left:10px;" >第二步:实名认证</h3>
     
         <div class="usereditepass">   
		     
		<form  action="">	  
		  <ul> 
			 <li>
			  <div  class="inputsbg">
			 
			 <input type="text" name='txt_real_name' id="txt_real_name" value="" class="logininputs" placeholder="请输入真实姓名"   />
			 
			 </div>
			 
			 </li>
			 <li>
			  <div  class="inputsbg">
			<input type="text" name="txt_idcard" id="txt_idcard" class="logininputs" placeholder="请输入身份证号码" />
			 </div>
               
			</li>
			 <li style="text-align:center;"> <input type="button" class="buybutton"   value="注册" id="buttons"/> </li>
		  </ul>
		</form>				 
    </div>
	<div id="frmdiv"> </div>
        
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


<script language="javascript">

function AsyncVerIdCard(data) {
    //alert(data);
    if(data == "1") {
        //$("#idcardTip").html(GetP("reg_wrong", "此身份证号码已经被使用！"));
		return Apprise('<font color=red>此身份证号码已经被使用！</font>');
    }

}

$(function(){
    $(".buybutton").click(function(){
        var txt_real_name =  $.trim($("#txt_real_name").val());
        var txt_idcard =  $.trim($("#txt_idcard").val());
		var idcardTest = /^[0-9]|x{15,18}$/;
		//var idcard = $("#txt_idcard").val();
		var str = txt_idcard;
        if(txt_real_name==''){
            return Apprise('<font color=red>请输入姓名！</font>');  
        }
        if(txt_idcard == ''){
            return Apprise('<font color=red>请输入身份证号码！</font>'); 
        }
		if (idcardTest.test(str)) {
        //格式正确
			$.post("/m/pub/ckIdCard/", { Action: "post", Cmd: "CheckVerIdCard", sVerIdCard: str }, AsyncVerIdCard);
		}
		else {
			//$(td).html(GetP("reg_wrong", "身份证号码长度填写错误！"));
			return Apprise('<font color=red>身份证号码长度填写错误！</font>');
		}
        
        if (idcardTest.test(str)) {
            $('#buttons').val("注册中...");
            $.ajax({
                url: "__URL__/regBindingAccount/",
                type: "post",
                dataType: "json",
                data: {"txt_real_name":txt_real_name,"txt_idcard":txt_idcard},
                success: function(d) {
                    if (d.status == 1) {
						 $('#buttons').val("注册");
						 Apprise('<font color=red>此用户名已经注册</font>');
						 return false;
                    }
                    else {
                        $('#frmdiv').html(d.ret);
                    }
                }
            });
        }
        else {
			$('#buttons').val("注册");
			return Apprise('<font color=red>请输入真实身份证号码</font>');
            //$("#idcardTip").html(GetP("reg_wrong", "真实身份证号码"));
        }
    })
})
</script>
</body>
</html>
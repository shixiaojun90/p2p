<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta property="qc:admins" content="44007607264651155636" />
<!--<meta http-equiv="X-UA-Compatible" content="IE=8" />-->
<link href="favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/css/common.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/css/index.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/css/css.css" />
<link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/css/kefu.css" />
<link type="text/css" rel="stylesheet" href="__ROOT__/Style/JBox/Skins/Currently/jbox.css"/>
<link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/css/style.css" />
<script type="text/javascript" src="__ROOT__/Style/H/js/jquery.min.js"></script>
<script type="text/javascript" src="__ROOT__/Style/Js/jquery.js"></script>
<script type="text/javascript" src="__ROOT__/Style/fancybox/jquery-1.4.3.min.js"></script>
<script  src="__ROOT__/Style/JBox/jquery.jBox.min.js" type="text/javascript"></script>
<script  src="__ROOT__/Style/JBox/jquery.jBoxConfig.js" type="text/javascript"></script>
<script type="text/javascript" src="__ROOT__/Style/Js/utils.js"></script>
<script type="text/javascript">
    var browser=navigator.appName;
    var b_version=navigator.appVersion;
    var version=b_version.split(";"); 
    if(version.length>1) var trim_Version=version[1].replace(/[ ]/g,"");

    if(browser=="Microsoft Internet Explorer" && (trim_Version=="MSIE5.0" || trim_Version=="MSIE6.0")) 
        alert("您正在使用的浏览器版本过低，有些网站效果会显示不出来，建议升级后再使用本网站。"); 

	function makevar(v){
		var d={};
		for(i in v){
			var id = v[i];
			d[id] = $("#"+id).val();
			if(!d[id]) d[id] = $("input[name='"+id+"']:checked").val();
			if(!d[id]) d[id] = $("input[name='"+id+"']").val();
			if(typeof d[id] == "undefined") d[id] = "";
		}
		return d;
	}
    function addBookmark(title, url) {
        if (window.sidebar) {
            window.sidebar.addPanel(title, url, "");
        }
        else if (document.all) {
            window.external.AddFavorite(url, title);
        }
        else if (window.opera && window.print) {
            return true;
        }
    }
    function SetHome(obj, vrl) {
        try {
            obj.style.behavior = 'url(#default#homepage)'; obj.setHomePage(vrl);
            NavClickStat(1);
        }
        catch (e) {
            if (window.netscape) {
                try {
                    netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
                }
                catch (e) {
                    alert("抱歉！您的浏览器不支持直接设为首页。请在浏览器地址栏输入“about:config”并回车然后将[signed.applets.codebase_principal_support]设置为“true”，点击“加入收藏”后忽略安全提示，即可设置成功。");
                }
                var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
                prefs.setCharPref('browser.startup.homepage', vrl);
            }
        }
    }
     
// 修复 IE 下 PNG 图片不能透明显示的问题
function fixPNG(myImage) {
var arVersion = navigator.appVersion.split("MSIE");
var version = parseFloat(arVersion[1]);
if ((version >= 5.5) && (version < 7) && (document.body.filters))
{
     var imgID = (myImage.id) ? "id='" + myImage.id + "' " : "";
     var imgClass = (myImage.className) ? "class='" + myImage.className + "' " : "";
     var imgTitle = (myImage.title) ? "title='" + myImage.title   + "' " : "title='" + myImage.alt + "' ";
     var imgStyle = "display:inline-block;" + myImage.style.cssText;
     var strNewHTML = "<span " + imgID + imgClass + imgTitle

   + " style=\"" + "width:" + myImage.width

   + "px; height:" + myImage.height

   + "px;" + imgStyle + ";"

   + "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader"

   + "(src=\'" + myImage.src + "\', sizingMethod='scale');\"></span>";
     myImage.outerHTML = strNewHTML;
} } 


</script>

<title><?php echo ($glo["index_title"]); ?></title>
<meta name="keywords" content="<?php echo ($glo["web_keywords"]); ?>" />
<meta name="description" content="<?php echo ($glo["web_descript"]); ?>" />
<meta property="wb:webmaster" content="37afd1196b6d28b7" />
<script  type="text/javascript" src="__ROOT__/Style/H/js/backtotop.js"></script>
<script  type="text/javascript" src="__ROOT__/Style/H/js/index.js"></script>
<script type="text/javascript" src="__ROOT__/Style/H/js/common.js" language="javascript"></script>
<script type="text/javascript" src="__ROOT__/Style/H/js/jquery.kinMaxShow-1.0.min.js"></script>
<meta property="qc:admins" content="30505113364651155636" />
<meta property="qc:admins" content="343262652160521672154116375" />
<meta property="wb:webmaster" content="d0d120bc5ee656d7" />
<script type="text/javascript">
var Transfer_invest_url = "__APP__/tinvest";
</script>
<script type="text/javascript">
function LoginSubmit() {
	$.jBox.tip("登陆中......",'loading');
	$.ajax({
		url: "__APP__/member/common/actlogin",
		data: {"sUserName": $("#uname").val(),"sPassword": $("#upass").val(),"sVerCode": $("#vcode").val(),"Keep":$("#loginstate").val()},
		timeout: 5000,
		cache: false,
		type: "post",
		dataType: "json",
		success: function (d, s, r) {
			if(d){
				if(d.status==0){
					$.jBox.tip(d.message,"tip");	
				}else{
					window.location.href="/";
				}
			}
		}
	});
}

function jfun_dogetpass(){
	var ux = $("#emailname").val();
	if(ux==""){
		$.jBox.tip('请输入用户名或者邮箱','tip');
		return;
	}
	$.jBox.tip("邮件发送中......","loading");
	$.ajax({
		url: "__APP__/member/common/dogetpass/",
		data: {"u":ux},
		//timeout: 5000,
		cache: false,
		type: "post",
		dataType: "json",
		success: function (d, s, r) {
			if(d){
				if(d.status==1){
					$.jBox.tip("发送成功，请去邮箱查收",'success');
					$.jBox.close(true);
				}else{
					$.jBox.tip("发送失败，请重试",'fail');
				}
			}
		}
	});

}

function getPassWord() {
	$.jBox("get:__APP__/member/common/getpassword/", {
		title: "找回密码",
		width: "auto",
		buttons: {'发送邮件':'jfun_dogetpass()','关闭': true }
	});   
}

</script>
<script type="text/javascript">
$(function(){
	
	$("#kinMaxShow").kinMaxShow({
			//设置焦点图高度(单位:像素) 必须设置 否则使用默认值 500
			height:330,
			//设置焦点图 按钮效果
			button:{
			    //设置按钮上面不显示数字索引(默认也是不显示索引)
                            showIndex:false,
			    //按钮常规下 样式设置 ，css写法，类似jQuery的 $('xxx').css({key:value,……})中css写法。            
			    //【友情提示：可以设置透明度哦 不用区分浏览器 统一为 opacity，CSS3属性也支持哦 如：设置按钮圆角、投影等，只不过IE8及以下不支持】            
                            normal:{background:'url(/Style/H/images/button.png) no-repeat -15px 0',marginRight:'8px',border:'0',right:'44%',bottom:'20px'},
                            //当前焦点图按钮样式 设置，写法同上
                            focus:{background:'url(/Style/H/images/button.png) no-repeat 0 0',border:'0'}
			},
			//焦点图切换回调，每张图片淡入、淡出都会调用。并且传入2个参数(index,action)。index 当前图片索引 0为第一张图片，action 切入 或是 切出 值:fadeIn或fadeOut
			//函数内 this指向 当前图片容器对象 可用来操作里面元素。本例中的焦点图动画主要就是靠callback实现的。
			callback:function(index,action){
				switch(index){
					case 0 :
							if(action=='fadeIn'){
								$(this).find('.sub_1_1').animate({left:'70px'},600)
								$(this).find('.sub_1_2').animate({top:'60px'},600)
								
							}else{
								$(this).find('.sub_1_1').animate({left:'110px'},600)
								$(this).find('.sub_1_2').animate({top:'120px'},600)
								
							};
							break;
							
					case 1 :
							if(action=='fadeIn'){
								$(this).find('.sub_2_1').animate({left:'-100px'},600)
								$(this).find('.sub_2_2').animate({top:'60px'},600)
							}else{
								$(this).find('.sub_2_1').animate({left:'-160px'},600)	
								$(this).find('.sub_2_2').animate({top:'20px'},600)
							};
							break;
							
					case 2 :
							if(action=='fadeIn'){
								$(this).find('.sub_3_1').animate({right:'350px'},600)
								$(this).find('.sub_3_2').animate({left:'180px'},600)
							}else{
								$(this).find('.sub_3_1').animate({right:'180px'},600)	
								$(this).find('.sub_3_2').animate({left:'30px'},600)
							};
							break;	
				}
			}
		});
});

</script>
<div class="doc doc-711-234">
  <div class="body1">
    <div class="doc doc-711-234"> <script type="text/javascript">
function videoverify(){
	$.jBox.confirm("申请视频认证后会直接从帐户扣除认证费用<?php echo (($glo["fee_video"])?($glo["fee_video"]):0); ?>元，然后客服会联系您进行认证。<br/><font style='color:red'>确定要申请认证吗?</font>", "视频认证", dovideo, { buttons: { '确认申请': true, '暂不申请': false} });
}
function dovideo(v, h, f) {
	if (v == true){
        $.ajax({
            url: "__APP__/common/video",
            data: {},
            timeout: 5000,
            cache: false,
            type: "get",
            dataType: "json",
            success: function (d, s, r) {
              	if(d){
					if(d.status==1) $.jBox.tip(d.message, 'success');
					else $.jBox.tip(d.message, 'fail');
				}
            }
        });
	}
	return true;
};
// 自定义按钮
function faceverify(){
	$.jBox.confirm("<font style='color:red'>确定要申请现场认证吗?</font>", "现场认证", doface, { buttons: { '确认申请': true, '暂不申请': false} });
}
function doface(v, h, f) {
	if (v == true){
        $.ajax({
            url: "__APP__/common/face",
            data: {},
            timeout: 5000,
            cache: false,
            type: "get",
            dataType: "json",
            success: function (d, s, r) {
              	if(d){
					if(d.status==1) $.jBox.tip(d.message, 'success');
					else $.jBox.tip(d.message, 'fail');
				}
            }
        });
	}
	return true;
};
  $(function  () {
   	 var xiaowei_p= $("#xiaowei li");
   	 if(true)
   	 {
   	   xiaowei_p.parent().parent().css('background','url(__ROOT__/Style/H/images/hover_bg.gif) no-repeat center right');


   	 }
   })

  
</script>
<script type=text/javascript><!--//--><![CDATA[//><!--
function menuFix() {
var ele_ = document.getElementById("nav");
	if(!ele_) return;
var sfEls = ele_.getElementsByTagName("li");
for (var i=0; i<sfEls.length; i++) {
sfEls[i].onmouseover=function() {
this.className+=(this.className.length>0? " ": "") + "sfhover";
}
sfEls[i].onMouseDown=function() {
this.className+=(this.className.length>0? " ": "") + "sfhover";
}
sfEls[i].onMouseUp=function() {
this.className+=(this.className.length>0? " ": "") + "sfhover";
}
sfEls[i].onmouseout=function() {
this.className=this.className.replace(new RegExp("( ?|^)sfhover\\b"),
"");
}
}
}
window.onload=menuFix;
//--><!]]></script>
<link rel="stylesheet" type="text/css" href="__ROOT__/Style/H/css/home.css" />
</head><body>
<!--头部开始-->
<?php if($UID > '0'): ?><div class="first_top">
  <div class="dv_header top ">
    <!--迷你导航-->

<div class="dw_bgx dw_mini">
<div class="Cmml00">
<?php
 $dws= session('u_user_name'); ?>
<div class="fl dw_Cbg zuo">
<div class="fl" >客服热线:<?php $dw_kefu=get_qq(2);echo($dw_kefu[0]["qq_num"]); ?></div>

</div>
<div class="fr">
<div class="fl">
<a class="right_a" href="__APP__/member/" >我的账户</a><a  class="right_a" href="__APP__/member/msg#fragment-1" style="color:#b1b1b1">消息(<?php echo (($unread)?($unread):0); ?>)</a><a  class="right_a" href="__APP__/member/common/actlogout" style="color:#b1b1b1" >退出</a>

</div>
<div class="fl " id="dw_qun">
<ul id="erji">
<li class=" dw_Cbg eq1">
<h1>官方群号</h1>
<div>
<?php $_result=get_qq(1);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vq): $mod = ($i % 2 );++$i;?><p><?php echo ($vq["qq_num"]); ?></p><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
</li>
<li class="dw_Cbg eq2">
<h1>在线客服</h1>
<div class="eq201">
        <?php $_result=get_qq(0);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vq): $mod = ($i % 2 );++$i;?><a class="icoTc" href="tencent://Message/?Uin=<?php echo ($vq["qq_num"]); ?>&amp;websiteName=<?php echo ($vq["qq_title"]); ?>&amp;Menu=ye" style="color:#b1b1b1"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo ($vq["qq_num"]); ?>:52" alt="点击这里给我发消息" title="点击这里给我发消息"/>&nbsp;<?php echo (cnsubstr($vq["qq_title"],6,0,"utf-8",false)); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
</li>
</ul>
</div>
<div class="fl" > <div id="dw_kefu">  <div class="QQkefu"></div>   <div class="dw_show"></div></div></div>
</div>
</div>
</div>
<!--迷你导航结束-->


  </div>
</div>

  <?php else: ?>
   <div class="first_top">
		<div class="dv_header top ">

<!--迷你导航-->

<div class="dw_bgx dw_mini">
<div class="Cmml00">
<?php
 $dws= session('u_user_name'); ?>
<div class="fl dw_Cbg zuo">
<div class="fl" >客服热线:<?php $dw_kefu=get_qq(2);echo($dw_kefu[0]["qq_num"]); ?></div>

</div>
<div class="fr">
<div class="fl">
<a href="/member/common/register/" class="fl" style="color:#b1b1b1" >注册</a> <a class="fl" style="border-right: 1px solid #4f4f4f;" href="/member/common/login/" >登录</a>
</div>
<div class="fl " id="dw_qun">
<ul id="erji">
<li class=" dw_Cbg eq1">
<h1>官方群号</h1>
<div>
<?php $_result=get_qq(1);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vq): $mod = ($i % 2 );++$i;?><p><?php echo ($vq["qq_num"]); ?></p><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
</li>
<li class="dw_Cbg eq2">
<h1>在线客服</h1>
<div class="eq201">
        <?php $_result=get_qq(0);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vq): $mod = ($i % 2 );++$i;?><a class="icoTc" href="tencent://Message/?Uin=<?php echo ($vq["qq_num"]); ?>&amp;websiteName=<?php echo ($vq["qq_title"]); ?>&amp;Menu=ye"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo ($vq["qq_num"]); ?>:52" alt="点击这里给我发消息" title="点击这里给我发消息"/>&nbsp;<?php echo (cnsubstr($vq["qq_title"],6,0,"utf-8",false)); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
</li>
</ul>
</div>
<div class="fl" > <div id="dw_kefu">  <div class="QQkefu"></div>   <div class="dw_show"></div></div></div>
</div>
</div>
</div>
<!--迷你导航结束-->	
		</div>
	</div><?php endif; ?>
<script type="text/javascript">
  function  erji(a, b, c, d) {
        $(a).children(b).each(function() {
            var a1 = $(this).children(c),
             b2 = $(this).children(d),
             index=$(this).index();
            if (a1.html()) $(this).hover(function() {
                a1.show();
                
            index==0 && $(this).css({'background-position':'0px -62px'});
            index==1 && $(this).css({'background-position':'0px -124px'});
                b2.css({

                    'color':'#cfcfcf'
                });
            }, function() {
                a1.hide();
                 index==0 && $(this).css({'background-position':'0px -31px'});
            index==1 && $(this).css({'background-position':'0px -93px'});
                b2.css({

                    'color':'#b1b1b1'
                });
            });
        });
    }



erji('#erji','li','div','h1');
</script>
<div class="Nav">
			<div class="contain">
				<div class="N_logo"><a href="/"><?php echo get_ad(1);?></a></div>

          <?php if($UID > '0'): ?><!--快捷通道-->
            <div class="grid_3 ui-header-grid">
                    <ul class="ui-nav fn-right  ">
                      
                      <li id="ui-nav-item-link"  class="ui-nav-item ui-nav-item-x" >
                        <a  class="ui-nav-item-link rrd-dimgray ui-nav-username fn-text-overflow" href="__APP__/member/" >
                            <?php
 $dws= session('u_user_name'); ?>
                          <span id="jieduan">您好，<?php echo (cnsubstr($dws,10)); ?></span>
                          <span class="arrow-down"></span>
                        </a>
                        <ul class="ui-nav-dropdown" id="ui-nav-dropdown" style="display: none;">
                          <li class="ui-nav-dropdown-angle"><span></span></li>
                          <li class="ui-nav-dropdown-item"><a class="rrd-dimgray" href="__APP__/member/charge#fragment-1"  onclick="myrefresh()">充值</a></li>
                          <li class="ui-nav-dropdown-item"><a class="rrd-dimgray" href="__APP__/member/withdraw#fragment-1"  onclick="myrefresh()">提现</a></li>
                          <li class="ui-nav-dropdown-separator"></li>
                          <li class="ui-nav-dropdown-item"><a class="rrd-dimgray" href="__APP__/member/capital#fragment-2">资金明细</a></li>
                          <li class="ui-nav-dropdown-item"><a class="rrd-dimgray" href="__APP__/member/charge#fragment-1"  onclick="myrefresh()">在线充值</a></li>
                          <li class="ui-nav-dropdown-separator"></li>
                          <li class="ui-nav-dropdown-item"><a class="rrd-dimgray" href="__APP__/member/common/actlogout">退出</a></li>
                        </ul>
                      </li>
					</ul>
                  </div>
              <!--快捷通道end--><?php endif; ?>      
                 

				<div class="Nav_nav">
					<div class="menu">

 <ul class="navigation-list" id="dw_ul">
  <?php $typelist = getTypeList(array('type_id'=>0,'limit'=>9)); foreach($typelist as $vtype=> $va){ ?>
    <li class="navigation-item "> 
    <a href="<?php echo ($va["turl"]); ?>" class="navigation-item-name"><?php echo ($va["type_name"]); ?>
    <?php $sontypelist = getTypeList(array('type_id'=>$va['id'],'limit'=>8,'notself'=>true)); if($sontypelist != null){ ?>
    <span class="ym"></span>
    <?php } ?>
    </a>
      <div class="navigation-list-two-con" id="dw_ul2">
        <div class="navigation-list-two">
            <?php $sontypelist = getTypeList(array('type_id'=>$va['id'],'limit'=>8,'notself'=>true)); if($sontypelist != null){ ?>
             <span class="loanImg nav-sanjiao"></span>
            <?php } ?>
          <ul class="navigation-two-list" id="erji_nav">
          <?php $sontypelist = getTypeList(array('type_id'=>$va['id'],'limit'=>8,'notself'=>true)); foreach($sontypelist as $sonvtype){ ?>
            <li><a href="<?php echo ($sonvtype["turl"]); ?>"  ><?php echo ($sonvtype["type_name"]); ?></a></li>
           <?php } ?> 
          </ul>
        </div>
      </div>
    </li>
    <?php } ?>
      <?php if($UID > '0'): else: ?>
           <li class="navigation-right  ">
            <a class="" href="__APP__/member/common/register/">注册</a>
          </li>
             <li class="navigation-right navigation-denglu">
            <a class="first" href="__APP__/member/common/login/">登录</a>
          </li><?php endif; ?>      
      </ul>

 </div>
 
 
				</div>
                  
		  <script language="javascript">
                   $(document).ready(function(){
			
						
					$("#ui-nav-item-link").mouseover(function(){
						$("#ui-nav-dropdown").show()
						}).mouseout(function(){
							$("#ui-nav-dropdown").hide()
							});
						$(".ui-nav-dropdown-item").mouseover(function(){
							$(this).css({"background":"#027BC0"}).mouseout(function(){
								$(this).css({"background":"#fff"})
															});

							})
						
					  })
				function myrefresh(){ 
				 setTimeout(function (){ 
					if(location.hash){
						location.replace(location.href.replace(/#/, '?_'+ new Date().getTime() + '#'));
						return;
					}
					window.location.reload();
					},1000); 
				}
                     </script>
      			</div>
		</div>	


      <div class="ibannerbox" >
        <div id="kinMaxShow">
          <?php $_result=get_ad(4);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$va): $mod = ($i % 2 );++$i;?><div> <a href="<?php echo ($va["url"]); ?>"><img src="__ROOT__/<?php echo ($va["img"]); ?>" /></a> </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
      </div>
    </div>
  </div>
  <!-- //head slide -->
  <div style="width:980px; margin:5px auto 10px;border:#E7EAEC solid 1px; padding-bottom:10px;position:relative;">
	<table width="980" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="245" height="105" align="center" valign="middle"><a class="iico_1" href="__APP__/invest/index.html"></a></td>
        <td width="245" align="center" valign="middle"><a class="iico_2" href="__APP__/borrow/index.html"></a></td>
        <td width="245" align="center" valign="middle"><a class="iico_3" href="__APP__/Feedback/jk.html"></a></td>
      </tr>
      <tr style="font-size:24px; color:#3C4145;">
        <td height="50" align="center" valign="middle">我要投资</td>
        <td align="center" valign="middle">我要借款</td>
        <td align="center" valign="middle">绿色通道</td>
      </tr>
      <tr style="font-size:14px; color:#8D8B8B">
        <td height="55" align="left" valign="middle"><p style="padding:0 0 0 14px;"> 安全高收益，预期年化收益率10%-15%，<br/>
            零门槛，多重保障，让您的资金迅速升值.<br/>
            更有资金周转标</p></td>
        <td align="left" valign="middle"><p style="padding:0 0 0 42px;"> 抵押贷款，信用贷款等多种融资方式为您<br/>
            量身定制，利率更低，手续更简，下款更<br/>
            快，费用更低</p></td>
        <td align="left" valign="middle"><p style="padding:0 0 0 42px;"> 您身边优质金融资源的整合专家，银行贷<br/>
            款，银行承兑汇票，银行信用卡，融资租<br/>
            赁，信托，私募等多种金融业务快速咨询对接</p></td>
      </tr>
    </table>
  </div>
  <!-- head stat -->
  <!-- //head stat -->
  <div class="main">
  
	
    <div style="clear:both; height:10px; width:300px; _display:inline;"></div>
    <h2 class="title_03"><i class="icons"></i><span>投资列表<em>p2p助人利己 传递正能量</em></span><a class="more" href="/invest/index.html">查看更多散标项目&gt;&gt;</a></h2>
    <table width="980" style="border:#E7EAEC solid 1px;">
      <tr class="borrowlistl">
        <td class="dengji diyi">借款标题</td>
        <td class="dengji diyi">信用等级</td>
        <td class="dengji diyi">预期年利率</td>
        <td class="dengji diyi">金额</td>
        <td class="dengji diyi">期限</td>
        <td class="dengji diyi">进度</td>
        <td class="dengji diyi">状态</td>
      </tr>
      <?php if(is_array($listBorrow["list"])): $i = 0; $__LIST__ = $listBorrow["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vb): $mod = ($i % 2 );++$i;?><tr height="80" style="border-bottom:solid 1px #e4e4e4" class="borrowlistl">
          <td width="286">&nbsp;&nbsp;<?php echo getIco($vb);?><a href="<?php echo (getinvesturl($vb["id"])); ?>"title="<?php echo ($vb["borrow_name"]); ?>" class="BL_name"><?php echo (cnsubstr($vb["borrow_name"],16)); ?></a></td>
          <td class="dengji" width="124"><?php echo (getleveico($vb["credits"],2)); ?></td>
          <td class="dengji" width="124"><span class="BL_time"><?php echo ($vb["borrow_interest_rate"]); ?></span>&nbsp;%</td>
          <td class="dengji" width="100"><span class="BL_time"><?php echo (getmoneyformt($vb["borrow_money"])); ?></span>&nbsp;元</td>
          <td class="dengji" width="100"><span class="BL_time"><?php echo ($vb["borrow_duration"]); ?></span>&nbsp;<?php if($vb['repayment_type'] == 1): ?>天<?php else: ?>个月<?php endif; ?></td>
          <td class="dengji jindu" width="100"><span class="ui-list-field"> <span class="ui-progressbar-mid ui-progressbar-mid-<?php echo (intval($vb["progress"])); ?>"><em><?php echo (intval($vb["progress"])); ?>%</em></span> </span> </td>
          <td class="dengji" width="160">
				<?php if($vb["borrow_status"] == 3): ?><a href="javascript:;"><img class="anNiuYLB" src="__ROOT__/Style/H/images/status/touM.gif" /></a>
              <?php elseif($vb["borrow_status"] == 4): ?>
              <a href="javascript:;"><img class="anNiuDDFS" src="__ROOT__/Style/H/images/status/touM.gif" /></a>
              <?php elseif($vb["borrow_status"] == 6): ?>
              <a href="javascript:;"><img  class="anNiuHKZ" src="__ROOT__/Style/H/images/status/touM.gif"  /></a>
              <?php elseif($vb["borrow_status"] > 6): ?>
              <a href="<?php echo (getinvesturl($vb["id"])); ?>"><img class="anNiuYWC" src="__ROOT__/Style/H/images/status/touM.gif"  /></a>
              <?php else: ?>
              <a href="<?php echo (getinvesturl($vb["id"])); ?>"><img class="anNiuTB" src="__ROOT__/Style/H/images/status/touM.gif" /></a><?php endif; ?>
          </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>
    <div style="clear:both; height:10px; width:300px; _display:inline;"></div>
    <h2 class="title_03"><i class="icons icons1"></i><span>新闻公告<em>新闻资讯第一时间早知道</em></span></h2>
    <div class="ss">
      <div class="ss_left">
        <h3><img src="__ROOT__/Style/H/images/ss_left.gif" width="14"height="14" />&nbsp;&nbsp;公司动态</h3>
        <!-- <?php if(is_array($noticeList["list"])): $i = 0; $__LIST__ = $noticeList["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vn): $mod = ($i % 2 );++$i;?>-->
        <?php foreach($noticeList['list'] as $kx => $vn){ ?>
        <a href="<?php echo ($vn["arturl"]); ?>" title="<?php echo ($vn["title"]); ?>" class="changecolor"><img src="__ROOT__/Style/H/images/111.gif" width="5" height="7"  align="absmiddle" style="position:relative; top:15px; left:10px;"/><span><?php echo (date("Y-m-d H:i",$vn["art_time"])); ?></span><?php echo (cnsubstr($vn["title"],18)); ?></a>
        <?php };$noticeList=NULL; ?>
        <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
        <a href="/gonggao/index.html"  class="zuihou_last zuihou_last1" style="font-weight:blod;font-size:16px;" >点击查看更多动态</a> </div>
      <div class="ss_right ss_left">
        <h3><img src="__ROOT__/Style/H/images/ss_left.gif" width="14"height="14" />&nbsp;&nbsp;行业新闻</h3>
        <?php $xlist = getArticleList(array("type_id"=>2,"pagesize"=>4)); foreach($xlist['list'] as $kx => $va){ ?>
        <a href="<?php echo ($va["arturl"]); ?>" title="<?php echo ($va["title"]); ?>" class="changecolor"><img src="__ROOT__/Style/H/images/111.gif" width="5" height="7"  style="position:relative; top:15px; left:10px;"/><span><?php echo (date("Y-m-d H:i",$va["art_time"])); ?></span><?php echo (cnsubstr($va["title"],18)); ?></a>
        <?php };$xlist=NULL; ?>
        <a href="/news/index.html"  class="zuihou_last zuihou_last1"style="font-weight:blod;font-size:16px;" >点击查看更多新闻</a> </div>
    </div>
  </div>
  <script type="text/javascript">
		var lilenth = $(".list-h li").length+1;
		$(".list-h").css("width", lilenth * 156);
		var leftpos = 0;
		var leftcount = 0;

		$("#imgLeft").attr("src", "__ROOT__/Style/H/images/left_g.gif");
		$("#spec-left1").css("cursor", "default");

		if (lilenth > 1) {
			$(function() {
				$("#spec-right").click(function() {
					if (leftcount >= 0) {
						$("#imgLeft").attr("src", "__ROOT__/Style/H/images/scroll_left.gif");
						$("#spec-left1").css("cursor", "pointer");
					}
					if (lilenth - leftcount < 3) {
						$("#imgRight").attr("src", "__ROOT__/Style/H/images/right_g.gif");
						$("#spec-right").css("cursor", "default");
					}
					else {
						leftpos = leftpos - 156;
						leftcount = leftcount + 1;
						$(".list-h").animate({ left: leftpos }, "slow");
						if (lilenth - leftcount < 2) {
							$("#imgRight").attr("src", "__ROOT__/Style/H/images/right_g.gif");
							$("#spec-right").css("cursor", "default");
						}
					}

				});
			});


			$(function() {
				$("#spec-left1").click(function() {
					if (lilenth - leftcount > 2) {
						$("#imgRight").attr("src", "__ROOT__/Style/H/images/scroll_right.gif");
						$("#spec-right").css("cursor", "pointer");
					}

					if (leftcount < 1) {
						$("#imgLeft").attr("src", "__ROOT__/Style/H/images/left_g.gif");
						$("#spec-left1").css("cursor", "default");
					}
					else {
						leftpos = leftpos + 156;
						leftcount = leftcount - 1;
						$(".list-h").animate({ left: leftpos }, "slow");
						if (leftcount < 1) {
							$("#imgLeft").attr("src", "__ROOT__/Style/H/images/left_g.gif");
							$("#spec-left1").css("cursor", "default");
						}
					}

				}
				)
			})
		}
		else {
			$("#imgRight").attr("src", "__ROOT__/Style/H/images/right_g.gif");
			$("#spec-right").css("cursor", "default");
		}
		$(function() {
			var width = $("#preview").width();
			$("#spec-list1").css("width", 730).css("margin-right", 8);

		});

		$(function() {
			$("#spec-list1 img").bind("mouseover", function() {
				$(this).css({
					"border": "0px solid #FFFFFF",
					"padding": "0px"
				});
			}).bind("mouseout", function() {
				$(this).css({
					"border": "0px solid #ccc",
					"padding": "0px"
				});
			});
		})
		
	$(function() {
		$(".borrowlistl").bind("mouseover", function(){
			$(this).css("background", "#f8f8f8");
		})

		$(".borrowlistl").bind("mouseout", function(){
			$(this).css("background", "#fff");
		})

		$(".changecolor").bind("mouseover", function(){
			$(this).css("background", "#f8f8f8");
			$(this).css("color", "#007EB9");
		})

		$(".changecolor").bind("mouseout", function(){
			$(this).css("background", "#fff");
			$(this).css("color", "#737272");
		})
	});

</script>
</div>
<div style="clear:both; height:0px; width:300px; _display:inline;"></div>
<div class="footer">
  <div class="footer_con">
    <div class="footer_p"><?php echo get_ad(8);?></div>
        <div class="footer_ul footer_gy">
            <h2>关于我们</h2>
            <ul>
                <li><a href="__ROOT__/aboutus/jianjie.html">公司简介</a></li>
                <li><a href="__ROOT__/aboutus/zizhi.html">公司证件</a></li>
                <li><a href="__ROOT__/aboutus/zfsm.html">资费说明</a></li>
                <li><a href="__ROOT__/aboutus/zcfgd.html">政策法规</a></li>	
            </ul>
        </div>
        <div class="footer_ul footer_gy">
            <h2>网贷工具</h2>
            <ul>
                <li><a href="__ROOT__/tools/tool2.html">计算工具</a></li>
                <li><a href="__ROOT__/tuiguang/index.html">推广系统</a></li>
                <li><a href="__ROOT__/member/auto/index.html">自动投标</a></li>
                <li><a href="__ROOT__/member/capital#fragment-2">资金明细</a></li>	
            </ul>
        </div>
    <div class="footer_ul footer_help">
      <h2>帮助信息</h2>
      <ul>
        <li><a href="__ROOT__/bangzhu/index.html">帮助中心</a></li>
        <li><a href="__ROOT__/bangzhu/touzi.html">赎回投资</a></li>
        <li><a href="__ROOT__/bangzhu/new.html">新手指引</a></li>
        <li><a href="__ROOT__/bangzhu/safe.html">安全保障</a></li>
      </ul>
    </div>
    <div class="footer_p footer_last"><?php echo get_ad(9);?></div>
  </div>
  <div class="last_last">
    <?php echo ($glo["bottom"]); ?>
	&nbsp;
	<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1256061766'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/z_stat.php%3Fid%3D1256061766%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
</div>
</body></html>
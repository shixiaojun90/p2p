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
<script type="text/javascript">
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


<title><?php echo ($glo["web_name"]); ?>帮助中心</title>
<meta name="keywords" content="<?php echo ($glo["web_keywords"]); ?>" />
<meta name="description" content="<?php echo ($glo["web_descript"]); ?>" />
<LINK rel=stylesheet type=text/css href="__ROOT__/Style/Help/css/bangzhu.css">
<LINK rel=stylesheet type=text/css href="__ROOT__/Style/Help/css/bangzhu-min.css">
<SCRIPT type=text/javascript src="__ROOT__/Style/Help/js/jquery-1.8.3.min.js"></SCRIPT>
<DIV class=main_kan_new>
  <DIV id=wrapper>
    <DIV class=title-sub>
      <H2 id=htop>新手入门</H2>
      <B class=line></B></DIV>
    <DIV class=content_post>
      <DIV id=sidesub>
        <DIV class=static_nav>
          <DIV class=reg_btn><A href="javascript:void();">帮助中心</A> </DIV>
          <UL>
            <LI><A href="javascript:divhidden(1);"> 新手入门</A></LI>
            <LI><A href="javascript:divhidden(8);"> 我的账户</A></LI>
            <LI><A href="javascript:divhidden(2);"> 我要理财</A></LI>
            <LI><A href="javascript:divhidden(3);"> 我要借款</A></LI>
            <LI><A href="javascript:divhidden(5);"> 投资赎回</A></LI>
            <LI><A href="javascript:divhidden(9);"> 常见问题</A></LI>
            <LI><A href="javascript:divhidden(10);">名词解释</A></LI>
          </UL>
          <DIV class=clear></DIV>
        </DIV>
      </DIV>
      <DIV id=mainsub>
        <DIV id=herp1>
          <DIV class=help_box>
            <H5 class="up down"><B>如何注册、激活本平台账户</B></H5>
            <DIV style="DISPLAY: block" class=hp_cont>
              <P><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">（1）进入本平台首页，点击右上角"注册"按钮;</SPAN><BR>
                <SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">（2）根据提示信息，填用户名、密码等信息，点击“免费注册”;</SPAN><BR>
                <SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">（3）用户名为用户的展示昵称，一经注册后不可修改</SPAN> <SPAN 
style="FONT-FAMILY: 'font-size:12pt;'"><BR>
                &nbsp;&nbsp;备注：如果没有收到激活邮件，有两种解决途径。一、登录注册邮箱后，在垃圾箱里寻找，看是否被邮箱系统自动辨识为了垃圾邮件。二、请尝试清空浏览器缓存，清空后，点击“重新发送激活邮件”。若是还未成功，请联系网站在线客服。 </SPAN></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>如何充值</B></H5>
            <DIV class=hp_cont>
              <P><SPAN style="FONT-FAMILY: SimSun; COLOR: #333333">&nbsp;</SPAN> <SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">可以通过网上银行或财付通账户进行充值，目前所有的商业银行都支持个人网银业务，您只需要携带有效身份证件，到当地您所持银行卡的发卡行任意营业网点，即可申请开通网上银行业务。</SPAN><BR>
                <SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">（1）进入“我的账户”-“充值”，选择充值方式，输入要充值的金额，点击充值按钮;</SPAN><BR>
                <SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">（2）充值在第三方支付平台双乾支付进行；</SPAN><BR>
                <SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">（3）选择付款银行，点击确认无误按钮，按提示完成付款；</SPAN><BR>
                <SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">（4）显示成功付款后，跳转到本平台充值页面，显示充值成功；</SPAN><BR>
                <SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">（5）您可以通过资金明细查看充值的金额及历史记录；</SPAN> </P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>如何开始理财投资</B></H5>
            <DIV class=hp_cont>
              <P><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">（1）投资前请认真阅读该笔借款标的详细信息，以确定您所要投资的项目符合您的理财时间规划和您所要求的投资回报率；</SPAN><BR>
                <SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">（2）进入“网站首页”或点击“我要投资”-“普通借款”/“流转借款”/“债权转让”，如果有投标未满的项目，直接点击“立即投标”，按照相关提示操作即可</SPAN> </P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>如何提现</B></H5>
            <DIV class=hp_cont>
              <P> <SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">（1）您可以随时将您在“本平台”账户中的可用余额申请提现到您名下的任何一家银行的账号上</SPAN><BR>
                <SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">（2）进入“我的账户”-“提现”，输入要提现的金额，输入验证码，点击提现按钮</SPAN><BR>
                <SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">注意：请提供申请提现的银行卡账号，并确保该账号的开户人姓名和您在本平台上提供的身份证上的真实姓名一致，否则无法成功提现。</SPAN> </P>
            </DIV>
          </DIV>
        </DIV>
        <DIV style="DISPLAY: none" id=herp8>
          <DIV class=help_box>
            <H5 class="up "><B>如何修改密码？</B></H5>
            <DIV class=hp_cont>
              <P><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">注册后，每个账户会有两个密码，一个是会员登录密码，一个是交易密码，前者用于登录您的账户，后者用于确保提现等相关交易的安全，初始的交易密码跟登录密码是一样的，建议您注册后立即进行修改。您可以随时在“我的账户”-“基本设置&amp;头像与密码”-“修改密码/修改支付密码”中修改您的密码。 </SPAN></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>如何提升账户安全等级？</B></H5>
            <DIV class=hp_cont>
              <P><SPAN style="FONT-FAMILY: SimSun; COLOR: #333333">&nbsp;</SPAN> <SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">成功注册账户后，可以进行实名认证、修改支付密码，申请VIP会员等相关操作，加强账户安全等级。</SPAN> </P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>如何绑定到账银行卡？</B></H5>
            <DIV class=hp_cont>
              <P><SPAN style="FONT-FAMILY: SimSun; COLOR: #333333">&nbsp;</SPAN> <SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">登录“我的账户”页面中，点击左侧“资金管理-银行账户”，依次确认输入正确的持卡人、卡号和开户行地点。（注：提现到账银行卡户名必须与实名认证姓名保持一致。）</SPAN> </P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>如何申请 VIP ？ </B></H5>
            <DIV class=hp_cont>
              <P><SPAN style="FONT-FAMILY: SimSun; COLOR: #333333">&nbsp;</SPAN> <SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">登陆到个人账户后，点击“我的账户”，头像右侧 VIP 字认证，点击申请即可， VIP 免费申请，到期后须重新申请。 </SPAN></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>如何进行实名认证？</B></H5>
            <DIV class=hp_cont>
              <P><SPAN style="FONT-FAMILY: SimSun; COLOR: #333333">&nbsp;</SPAN> <SPAN style="FONT-FAMILY: 'font-size:12pt;'">我的账户-认证中心-实名认证，按照要求填写即可，提交之后客服人员会尽快审核。 </SPAN></P>
            </DIV>
          </DIV>
        </DIV>
        <DIV style="DISPLAY: none" id=herp2>
          <DIV class=help_box>
            <H5 class=up><B>如何理财</B></H5>
            <DIV class=hp_cont>
              <P><SPAN 
style="FONT-FAMILY: 宋体; FONT-SIZE: 12pt; FONT-WEIGHT: bold">投标之前需要注意哪些事项？</SPAN><BR>
                <SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">对于投资用户，投资前需要您先通过实名认证，同时，您还可以进行VIP认证(该认证为可选认证，认证通过后，即可安心在本平台进行投资)。</SPAN><BR>
                <SPAN 
style="FONT-FAMILY: 宋体; FONT-SIZE: 12pt; FONT-WEIGHT: bold">投资时有没有相关费用？</SPAN><BR>
                <SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">在投资人收到借款标的回款时，投资人使用回款提现是完全免费的。</SPAN><BR>
                <SPAN 
style="FONT-FAMILY: 宋体; FONT-SIZE: 12pt; FONT-WEIGHT: bold">投资收益何时开始计算？</SPAN><BR>
                <SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">（1）所参与投标的借款已借款完成的当日开始计算利息。</SPAN><BR>
                <SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">（2）借款项目到期时，平台会提前3天和当天多次通知借款客户还款。</SPAN><BR>
                <SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">（3）还款日当天24:00之前，借款人操作还款，都是符合借款协议约定的，不会产生罚息。</SPAN><BR>
                <SPAN 
style="FONT-FAMILY: 'font-size:12pt;'"></SPAN><BR>
                <SPAN 
style="FONT-FAMILY: 宋体; FONT-SIZE: 12pt; FONT-WEIGHT: bold">协议查询</SPAN><BR>
                <SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">进入“我的账户”——“投资管理”—— “投资总表”  —— “回收中的投资”
                查看电子合同，点击打开即可在线阅览。</SPAN> </P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>借款标的类型介绍</B></H5>
            <DIV class=hp_cont>
              <P><SPAN style="FONT-FAMILY: 宋体; FONT-SIZE: 12pt; FONT-WEIGHT: bold">信用标：</SPAN><BR>
                <SPAN style="FONT-FAMILY: 'font-size:12pt;'">信用借款标显示“信”字标记，是一种免抵押、免担保、纯信用，的小额个人信用贷款标，主要面向固定收入群体开放。如借款人到期还款出现困难，逾期约定时间由网站运营方垫付本金息还款，债权转让为网站运营方所有。 </SPAN><BR>
                <SPAN style="FONT-FAMILY: 宋体; FONT-SIZE: 12pt; FONT-WEIGHT: bold">担保标：</SPAN><BR>
                机构担保借款标显示标记“担”，是有担保机构进行担保的借款，担保人和借款人之间协商并签订抵押担保手续，确保风险控制在合理的范围内。如借款人到期还款出现逾期，由担保机构垫付本息还款。</SPAN><BR>
                <SPAN style="FONT-FAMILY: 宋体; FONT-SIZE: 12pt; FONT-WEIGHT: bold">净值标：</SPAN><BR>
                <SPAN style="FONT-FAMILY: 'font-size:12pt;'">净值借款标显示标记“净”，如果客户净资产大于借款金额，网站运营方允许发布净值借款标用于临时周转。他是一种相对安全系数很高的借款标，因此利率方面可能比较低，适合资金黄牛，用户可以借助此标放大自己的投资标。 净值借款标逾期后约定时间由网站先行垫付本息还款。 </SPAN><BR>
                <SPAN style="FONT-FAMILY: 'font-size:12pt;'"></SPAN><BR>
                <SPAN 
style="FONT-FAMILY: 宋体; FONT-SIZE: 12pt; FONT-WEIGHT: bold">抵押标：</SPAN><BR>
                <SPAN style="FONT-FAMILY: 'font-size:12pt;'">抵押标借款者对象一般为地区优质中小微企业，是网站运营方重点发展对象。借款人到期还款出现困难，借款到期日当天由网站运营方垫付本金和利息还款，债权为网站运营方所有。抵押标逾期后，每天按约定收取罚息，本金利息及罚息全部为网站运营方收取.。</SPAN><BR>
                <SPAN 
style="FONT-FAMILY: 'font-size:12pt;'"></SPAN> </P>
              <SPAN style="FONT-FAMILY: 宋体; FONT-SIZE: 12pt; FONT-WEIGHT: bold">企业直投：</SPAN><BR>
              <SPAN style="FONT-FAMILY: 'font-size:12pt;'">企业直投是债权人将手中的优质债权分割成几个份额，转让给其他投资人并且承诺在一定期限内回购该债权的投资品种。在投资人受让债权的期限内，投资人本金和收益的安全由平台保证，在投资人认购到期时平台自动回购债权。 </SPAN><BR>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>自动投标</B></H5>
            <DIV class=hp_cont>
              <P><SPAN 
style="FONT-FAMILY: 宋体; FONT-SIZE: 12pt; FONT-WEIGHT: bold">什么是自动投标？</SPAN><BR>
                <SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">自动投标是一种根据自行设定条件帮助投资者进行智能投资的工具，为减少投资人用于理财的时间投入而开发，根据个人条件设定并开启后，有项目符合设定规则时，会在项目发布后及时进行自动投资。</SPAN><BR>
                <SPAN style="FONT-FAMILY: 宋体; FONT-SIZE: 12pt; FONT-WEIGHT: bold">如何设置我的自动投标？</SPAN><BR>
                <SPAN style="FONT-FAMILY: 'font-size:12pt;'">操作流程可参照：进入我的账户页面——投资管理——自动投标，再根据个人实际理财需求依次设定每次自动投资金额、利率范围、项目期限，等等，并点击开启自动投标与保存设置。</SPAN><BR>
                <SPAN 
style="FONT-FAMILY: 宋体; FONT-SIZE: 12pt; FONT-WEIGHT: bold">自动投标的规则</SPAN><BR>
                <SPAN style="FONT-FAMILY: 'font-size:12pt;'">（1）投标顺序按照开启自动投标功能的时间先后进行排序。</SPAN><BR>
                <SPAN style="FONT-FAMILY: 'font-size:12pt;'">（2）每个会员每个借款仅自动投标一次，投标成功后，排到所有自动投标会员的末尾。</SPAN><BR>
                <SPAN style="FONT-FAMILY: 'font-size:12pt;'">（3）中间对自动投标进行修改的，排名不变。</SPAN><BR>
                <SPAN style="FONT-FAMILY: 'font-size:12pt;'">（4）新开启自动投标用户，自动排到所有自动投标会员的末尾。</SPAN><BR>
                <SPAN style="FONT-FAMILY: 'font-size:12pt;'">（5）当账户余额不足时，系统按顺序进行，但不投标，依次转移到下一个自动投标。</SPAN><BR>
              </P>
            </DIV>
          </DIV>
        </DIV>
        <DIV style="DISPLAY: none" id=herp3>
          <DIV class=help_box>
            <H5 class=up><B>申请的条件</B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN style="FONT-FAMILY: 'font-size:12pt;'">（1） 
                22-55周岁的中国公民</SPAN><BR>
                <SPAN 
                &nbsp; 
                &nbsp; 企业经营者，企业经营时间满1年<BR>
                &nbsp; &nbsp; 抵押贷款，需要自己名下有房产或车产。</SPAN> </P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>申请流程</B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">（1）在“我要借款”页面提交借款申请。</SPAN><BR>
                <SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">（2）本平台会联系借款人所在当地合作机构。</SPAN><BR>
                <SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">（3）合作机构联系借款申请人，进行实地考察。</SPAN><BR>
                &nbsp; 
                &nbsp; <SPAN style="FONT-FAMILY: 'font-size:12pt;'">注：整个流程需要3-5个工作日。</SPAN> </P>
            </DIV>
          </DIV>
        </DIV>
        <DIV style="DISPLAY: none" id=herp4>
          <DIV class=help_box>
            <H5 class=up><B>什么是自动投标？</B></H5>
            <DIV class=hp_cont>
              <P class=txt>
              <SPAN id=dataInfo>
              <P><SPAN><SPAN 
style="FONT-FAMILY: '宋体'; BACKGROUND: #ffffff; COLOR: #808080; FONT-SIZE: 12pt">&nbsp;&nbsp;&nbsp;&nbsp;自动投标</SPAN></SPAN><SPAN 
style="FONT-FAMILY: '宋体'; BACKGROUND: #ffffff; COLOR: #808080; FONT-SIZE: 12pt">是一种</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; BACKGROUND: #ffffff; COLOR: #808080; FONT-SIZE: 12pt">根据自行设定条件</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; BACKGROUND: #ffffff; COLOR: #808080; FONT-SIZE: 12pt">帮助借出者进行</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; BACKGROUND: #ffffff; COLOR: #808080; FONT-SIZE: 12pt">智能操作</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; BACKGROUND: #ffffff; COLOR: #808080; FONT-SIZE: 12pt">投标的工具，</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; BACKGROUND: #ffffff; COLOR: #808080; FONT-SIZE: 12pt">为</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; BACKGROUND: #ffffff; COLOR: #808080; FONT-SIZE: 12pt">减少借入者投资的时间投入</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; BACKGROUND: #ffffff; COLOR: #808080; FONT-SIZE: 12pt">而开发，根据个人条件设定并开启后，有项目符合设定规则会在系统设定时间内进行自动投标。</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; BACKGROUND: #ffffff; COLOR: #808080; FONT-SIZE: 12pt"></SPAN></P>
              </SPAN>
              <P></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>如何设置我的自动投标？</B></H5>
            <DIV class=hp_cont>
              <P class=txt>
              <SPAN id=dataInfo>
              <P><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt">&nbsp;&nbsp;&nbsp;&nbsp;操作流程可参照：进入个人帐号——理财管理——自动投标，再根据个人实际投标需求依次设定每次自动投标投出金额、利率范围、借款期限、信用等级范围，账户保留金额及借款类型，并点击开启自动投标与保存设置。</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt"></SPAN></P>
              <P><SPAN style="FONT-FAMILY: '宋体'; FONT-SIZE: 12pt"></SPAN></P>
              </SPAN>
              <P></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>设置好自动投标后有项目是不是可以马上投出？</B></H5>
            <DIV class=hp_cont>
              <P class=txt>
              <SPAN id=dataInfo>
              <P><SPAN style="FONT-FAMILY: '宋体'; COLOR: #808080"><SPAN 
style="COLOR: #666666; FONT-SIZE: 16px">&nbsp;&nbsp;&nbsp;&nbsp;当网站项目进入招标中状态</SPAN><SPAN 
style="COLOR: #666666; FONT-SIZE: 16px">15</SPAN><SPAN 
style="COLOR: #666666; FONT-SIZE: 16px">分钟后，系统自动开启自动投标，将按照设定标准进行选择投入符合需求项目。</SPAN></SPAN> </P>
              </SPAN>
              <P></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>自动投标工具一个标最多可以投多少金额？</B></H5>
            <DIV class=hp_cont>
              <P class=txt>
              <SPAN id=dataInfo>
              <P><SPAN style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt"><SPAN 
style="COLOR: #666666">&nbsp;&nbsp;&nbsp;&nbsp;同一个项目，自动投标工具只启动投出一次，投出金额在总项目资金的</SPAN><SPAN 
style="COLOR: #666666">20%</SPAN><SPAN 
style="COLOR: #666666">以内。若设定金额超出项目资金</SPAN><SPAN 
style="COLOR: #666666">20%</SPAN><SPAN style="COLOR: #666666">，则取满</SPAN><SPAN 
style="COLOR: #666666">20%</SPAN><SPAN style="COLOR: #666666">以内且是</SPAN><SPAN 
style="COLOR: #666666">50</SPAN><SPAN 
style="COLOR: #666666">的倍数资金为有效投出资金。另当项目进度达到</SPAN><SPAN 
style="COLOR: #666666">95%</SPAN><SPAN 
style="COLOR: #666666">以后停止自动投标工具启动，</SPAN></SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt"><SPAN 
style="COLOR: #666666">若投标进度超过</SPAN><SPAN 
style="COLOR: #666666">95%</SPAN><SPAN style="COLOR: #666666">，则取满足</SPAN><SPAN 
style="COLOR: #666666">95%</SPAN><SPAN style="COLOR: #666666">以内且以</SPAN><SPAN 
style="COLOR: #666666">50</SPAN><SPAN 
style="COLOR: #666666">的倍数的资金为有效投出资金。</SPAN></SPAN></P>
              </SPAN>
              <P></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>所有用户都启动自动投标的话，先后之分如何区别？</B></H5>
            <DIV class=hp_cont>
              <P class=txt>
              <SPAN id=dataInfo>
              <P><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt">&nbsp;&nbsp;&nbsp;&nbsp;自动投标启动后，投标顺序以所有用户开启自动投标的时间先后默认排序，每个用户同个标仅自动投出一次，投完后，自动排到队尾等待再次启动。</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt"></SPAN></P>
              </SPAN>
              <P></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>若自动投标轮到但没有符合条件的项目，是否下轮可以优先投出？</B></H5>
            <DIV class=hp_cont>
              <P class=txt>
              <SPAN id=dataInfo>
              <P><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt">&nbsp;&nbsp;&nbsp;&nbsp;<SPAN 
style="COLOR: #666666">不可以，若</SPAN></SPAN><SPAN 
style="FONT-FAMILY: 'Calibri'; COLOR: #666666; FONT-SIZE: 12pt">此轮有某个用户投标时没有符合其设定的条件的标，也视为投标一次，重新排队。</SPAN><SPAN 
style="FONT-FAMILY: 'Calibri'; COLOR: #808080; FONT-SIZE: 12pt"></SPAN></P>
              </SPAN>
              <P></P>
            </DIV>
          </DIV>
        </DIV>
        <DIV style="DISPLAY: none" id=herp5>
          <DIV class=help_box>
            <H5 class=up><B>投资赎回的方式有哪些？</B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">为提高理财者投资的流动性，本平台平台提供了“债权转让”和“净值借款”两大功能，实现资金紧急赎回，最快当天可以到账。</SPAN> </P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>债权转让是什么？</B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">债权转让是指债权持有人通过本平台债权转让平台将债权挂出出售，将所持有的债权转让给购买人的操作。</SPAN> </P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>如何转让债权？</B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">当投资用户持有的债权处于可转让状态时，理财用户可以在“我的账户”——“债权转让”——“可转让债权”页面进行债权转让操作，填写转让的折扣，将债权挂出，其它用户对此债权进行了购买后即完成转出。</SPAN> </P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>债权转让是如何收费的？</B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">债权转让的费用为转让管理费。平台向转出人收取，不向购买人收取任何费用。转让管理费金额为转让价格*转让管理费率，具体金额以债权转让页面显示为准。债权转让管理费在成交后直接从成交金额中扣除，不成交平台不向用户收取转让管理费。</SPAN> </P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>什么是净值借款？</B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">如果客户净资产大于借款金额，网站运营方允许发布净值借款标用于临时周转。他是一种相对安全系数很高的借款标，因此利率方面可能比较低，适合资金黄牛，用户可以借助此标放大自己的投资标。 净值借款标逾期后约定时间由网站先行垫付本息还款。 </SPAN> </P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>如何发布净值借款？</B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">投资用户可以在“我要借款”页面进行净值借款的发布操作，填写借款信息，提交借款申请。借款通过初审后，会在网站首页和“我要投资”页面挂出，投标完成后即完成借款流程。</SPAN> </P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>如何投资债权转让标</B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">投资债权转让标需要在我要投资-债权转让栏目-选择债权转让标进行投资购买债权。 </SPAN></P>
            </DIV>
          </DIV>
        </DIV>
        <DIV style="DISPLAY: none" id=herp6>
          <DIV class=help_box>
            <H5 class=up><B>什么是净值标？</B></H5>
            <DIV class=hp_cont>
              <P class=txt>
              <SPAN id=dataInfo>
              <P style="TEXT-ALIGN: justify"><SPAN 
style="FONT-STYLE: normal; FONT-FAMILY: 'Microsoft YaHei'; BACKGROUND: #ffffff; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: normal">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;以投资</SPAN><SPAN 
style="FONT-STYLE: normal; FONT-FAMILY: '宋体'; BACKGROUND: #ffffff; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: normal">用户在本平台的待收金额</SPAN><SPAN 
style="FONT-STYLE: normal; FONT-FAMILY: 'Microsoft YaHei'; BACKGROUND: #ffffff; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: normal">为担保，</SPAN><SPAN 
style="FONT-STYLE: normal; FONT-FAMILY: '宋体'; BACKGROUND: #ffffff; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: normal">按照一定比例作为额</SPAN><SPAN 
style="FONT-STYLE: normal; FONT-FAMILY: 'Microsoft YaHei'; BACKGROUND: #ffffff; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: normal">度内发布的借款标</SPAN><SPAN 
style="FONT-STYLE: normal; FONT-FAMILY: '宋体'; BACKGROUND: #ffffff; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: normal">为净值标。</SPAN><SPAN 
style="FONT-STYLE: normal; FONT-FAMILY: '宋体'; BACKGROUND: #ffffff; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal"></SPAN></P>
              <P>&nbsp;</P>
              </SPAN>
              <P></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>怎么才能发布净值标？</B></H5>
            <DIV class=hp_cont>
              <P class=txt>
              <SPAN id=dataInfo>
              <P><SPAN 
style="FONT-STYLE: normal; FONT-FAMILY: '宋体'; BACKGROUND: #ffffff; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal">&nbsp;&nbsp;&nbsp;&nbsp;<SPAN 
style="COLOR: #666666">个人账户净值额度大于</SPAN><SPAN 
style="COLOR: #666666">1</SPAN><SPAN 
style="COLOR: #666666">万就可以发布。</SPAN></SPAN></P>
              </SPAN>
              <P></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>净值额度怎么算？</B></H5>
            <DIV class=hp_cont>
              <P class=txt>
              <SPAN id=dataInfo>
              <P style="TEXT-ALIGN: justify"><SPAN 
style="FONT-STYLE: normal; FONT-FAMILY: '宋体'; BACKGROUND: #ffffff; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal"><SPAN 
style="COLOR: #666666">&nbsp;&nbsp;&nbsp;&nbsp;净值额度</SPAN><SPAN 
style="COLOR: #666666">=</SPAN><SPAN 
style="COLOR: #666666">个人账户中的（可用金额</SPAN><SPAN 
style="COLOR: #666666">+</SPAN><SPAN style="COLOR: #666666">待收总额</SPAN><SPAN 
style="COLOR: #666666">-</SPAN><SPAN style="COLOR: #666666">待还总额）</SPAN><SPAN 
style="COLOR: #666666">*0.7</SPAN></SPAN><SPAN 
style="FONT-STYLE: normal; FONT-FAMILY: '宋体'; BACKGROUND: #ffffff; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal"></SPAN></P>
              </SPAN>
              <P></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>账户投标或收到还款等变化是否有提示通知？</B></H5>
            <DIV class=hp_cont>
              <P class=txt>
              <SPAN id=dataInfo>
              <P style="TEXT-ALIGN: left"><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt">&nbsp;&nbsp;&nbsp;<SPAN 
style="COLOR: #666666">&nbsp;</SPAN><SPAN 
style="COLOR: #666666">有的，目前提示功能可选择三种通知渠道：</SPAN></SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt"></SPAN></P>
              <P style="TEXT-ALIGN: justify"><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt"><SPAN 
style="COLOR: #666666">（</SPAN><SPAN style="COLOR: #666666">1</SPAN><SPAN 
style="COLOR: #666666">）个人账户站内信通知；</SPAN></SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt"></SPAN></P>
              <P style="TEXT-ALIGN: justify"><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt"><SPAN 
style="COLOR: #666666">（</SPAN><SPAN style="COLOR: #666666">2</SPAN><SPAN 
style="COLOR: #666666">）注册邮件通知；</SPAN></SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt"></SPAN></P>
              <P style="TEXT-ALIGN: justify"><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt"><SPAN 
style="COLOR: #666666">（</SPAN><SPAN style="COLOR: #666666">3</SPAN><SPAN 
style="COLOR: #666666">）手机短信通知。</SPAN></SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt"></SPAN></P>
              <P style="TEXT-ALIGN: left"><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt"><SPAN 
style="COLOR: #666666">其中第（</SPAN><SPAN style="COLOR: #666666">3</SPAN><SPAN 
style="COLOR: #666666">）种渠道为收费提示功能，每条</SPAN><SPAN 
style="COLOR: #666666">0.1</SPAN><SPAN 
style="COLOR: #666666">元。由合作服务商收取。</SPAN></SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt"></SPAN></P>
              </SPAN>
              <P></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>如何选择个人所需通知渠道？</B></H5>
            <DIV class=hp_cont>
              <P class=txt>
              <SPAN id=dataInfo>
              <DIV>
                <P style="TEXT-ALIGN: left"><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt">&nbsp;&nbsp;&nbsp;&nbsp;<SPAN 
style="COLOR: #666666">登录个人账户</SPAN></SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt">→</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt">账号管理</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt">→</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt">通知设置</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt">→</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt">勾选更方便通知的渠道（站内信、邮件、手机短信）</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt">→</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt">确认。</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt"></SPAN> </P>
              </DIV>
              </SPAN>
              <P></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>发布净值标的费用？</B></H5>
            <DIV class=hp_cont>
              <P class=txt>
              <SPAN id=dataInfo>
              <P><SPAN style="COLOR: #666666; FONT-SIZE: 16px">收费标准；</SPAN><SPAN 
style="COLOR: #666666; FONT-SIZE: 16px">发布净值标期限在</SPAN><SPAN 
style="COLOR: #666666; FONT-SIZE: 16px">2个月及以下的期限</SPAN><SPAN 
style="COLOR: #666666; FONT-SIZE: 16px">借款手续费为借款本金的1%，</SPAN></P>
              <P><SPAN 
style="COLOR: #666666; FONT-SIZE: 16px">2个月及以上的期限借款标，手续费为1%+（N-2）*0.2%，其中N为借款月数。</SPAN></P>
              </SPAN>
              <P></P>
            </DIV>
          </DIV>
        </DIV>
        <DIV style="DISPLAY: none" id=herp7>
          <DIV class=help_box>
            <H5 class=up><B>在本平台的借款利率是如何设定的？</B></H5>
            <DIV class=hp_cont>
              <P class=txt>
              <SPAN id=dataInfo>
              <P><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt">&nbsp;&nbsp;&nbsp;&nbsp;<SPAN 
style="COLOR: #666666">根据</SPAN></SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt">相关法律规定</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt">，</SPAN><SPAN 
style="FONT-FAMILY: 'Calibri'; COLOR: #666666; FONT-SIZE: 12pt">"</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt">民间借贷的利息可适当高于银行利率，但最高不得超过同期</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt">央</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt">行贷款利率的</SPAN><SPAN 
style="FONT-FAMILY: 'Calibri'; COLOR: #666666; FONT-SIZE: 12pt">4</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt">倍，超出部分的利息法律不予保护</SPAN><SPAN 
style="FONT-FAMILY: 'Calibri'; COLOR: #666666; FONT-SIZE: 12pt">"</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt">。</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt">本平台</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt">谨遵此条规定严格审核借款人的借款标年化利率控制在法律界限以内，并</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt">随着</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt">央</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt">行</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt">基准</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt">利率的调整</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt">而为之调动审核标准</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt">。</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt"></SPAN></P>
              </SPAN>
              <P></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>本平台如何收费？</B></H5>
            <DIV class=hp_cont>
              <P class=txt>
              <SPAN id=dataInfo>
              <P style="TEXT-ALIGN: left"><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal">&nbsp;&nbsp;&nbsp;<SPAN 
style="COLOR: #666666">&nbsp;收费标准按用户性质分为两大类：</SPAN></SPAN></P>
              <P style="TEXT-ALIGN: left"><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal"></SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal"></SPAN><SPAN 
style="COLOR: #666666"></SPAN>&nbsp;</P>
              <P style="TEXT-ALIGN: left"><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: normal">①</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal"><SPAN 
style="COLOR: #666666">投资用户：</SPAN><SPAN style="COLOR: #666666">VIP</SPAN><SPAN 
style="COLOR: #666666">会员会费</SPAN><SPAN style="COLOR: #666666">10</SPAN><SPAN 
style="COLOR: #666666">元</SPAN><SPAN style="COLOR: #666666">/</SPAN><SPAN 
style="COLOR: #666666">一年。</SPAN></SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal"></SPAN></P>
              <P style="TEXT-ALIGN: left"><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal"><SPAN 
style="COLOR: #666666">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;投资成功所赚利息的</SPAN><SPAN 
style="COLOR: #666666">10%</SPAN><SPAN 
style="COLOR: #666666">为投资利息管理费。</SPAN></SPAN></P>
              <P style="TEXT-ALIGN: left"><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal"><SPAN></SPAN></SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal"></SPAN><SPAN 
style="COLOR: #666666"></SPAN>&nbsp;</P>
              <P style="TEXT-ALIGN: left"><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal"></SPAN></P>
              <P style="TEXT-ALIGN: left"><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: normal">②</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: normal">借款用户：借款成功后收取本金2%的成交费用。</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal"></SPAN></P>
              <P style="TEXT-ALIGN: left"><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal"></SPAN></P>
              <P style="TEXT-ALIGN: left"><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: normal">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;根据发布借款期数每月收取借款本金的0.3%为借款管理费。</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal"></SPAN></P>
              <P style="TEXT-ALIGN: left"><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666699; FONT-SIZE: 12pt; FONT-WEIGHT: normal"></SPAN></P>
              <P><SPAN style="COLOR: #666666"></SPAN>&nbsp;</P>
              </SPAN>
              <P></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>邮箱收不到认证邮件怎么办？</B></H5>
            <DIV class=hp_cont>
              <P class=txt>
              <SPAN id=dataInfo>
              <P style="TEXT-ALIGN: left"><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt">&nbsp;<SPAN 
style="COLOR: #666666">&nbsp;&nbsp;&nbsp;</SPAN><SPAN 
style="COLOR: #666666">确认注册邮箱地址无误后建议在垃圾邮件里查询一下，因有的邮件会误被服务商拦截至此。如还未收到请及时联系工作人员。</SPAN></SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt"></SPAN></P>
              </SPAN>
              <P></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>注册之后，可以更用户名吗？</B></H5>
            <DIV class=hp_cont>
              <P class=txt>
              <SPAN id=dataInfo>
              <P style="TEXT-ALIGN: left"><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal">&nbsp;&nbsp;&nbsp;&nbsp;<SPAN 
style="COLOR: #666666">注册成功后，填写的用户名即与用户所有信息绑定，无法更改，建议注册时避免用真实姓名为用户名，选择其他字母或数字代替并确认不会更改后再进行注册。</SPAN></SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal"></SPAN></P>
              <P style="TEXT-ALIGN: left"><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal"></SPAN></P>
              </SPAN>
              <P></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>忘记登录密码怎么办？</B></H5>
            <DIV class=hp_cont>
              <P class=txt>
              <SPAN id=dataInfo>
              <P style="TEXT-ALIGN: left"><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal">&nbsp;<SPAN 
style="COLOR: #666666">&nbsp;&nbsp;&nbsp;</SPAN><SPAN 
style="COLOR: #666666">在登陆页面点击</SPAN></SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: bold"><SPAN 
style="COLOR: #666666">[</SPAN><SPAN style="COLOR: #666666">忘记密码</SPAN><SPAN 
style="COLOR: #666666">]--</SPAN><SPAN style="COLOR: #666666">填写注册邮箱</SPAN><SPAN 
style="COLOR: #666666">--</SPAN><SPAN 
style="COLOR: #666666">进入邮箱查询邮件</SPAN><SPAN 
style="COLOR: #666666">--</SPAN><SPAN style="COLOR: #666666">点击链接激活</SPAN><SPAN 
style="COLOR: #666666">--</SPAN><SPAN 
style="COLOR: #666666">输入并确认新密码</SPAN><SPAN 
style="COLOR: #666666">--</SPAN><SPAN 
style="COLOR: #666666">重新登录。</SPAN></SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: bold"></SPAN> </P>
              </SPAN>
              <P></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>交易密码是什么？如何设定？</B></H5>
            <DIV class=hp_cont>
              <P class=txt>
              <SPAN id=dataInfo>
              <P style="TEXT-ALIGN: left"><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal"><SPAN 
style="COLOR: #666666">&nbsp;&nbsp;&nbsp;&nbsp;</SPAN><SPAN 
style="COLOR: #666666">交易密码用于账户提现和购买债权时将账户金额进行支付转移出去需要验证的密码。首次注册成功后需要进入个人账号进行设定：</SPAN></SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: bold">我的账户</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: bold">→</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: bold">账号管理</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: bold">→</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: bold">修改密码</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: bold">→</SPAN><SPAN 
style="FONT-FAMILY: 'Calibri'; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: bold">会员交易密码修改</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: bold">→</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: bold">（原始密码为登录密码）</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: bold">→</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: bold">新密码填写提交</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: normal">方可使用此密码进行交易。</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal"></SPAN></P>
              </SPAN>
              <P></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>提现金额有无限制？</B></H5>
            <DIV class=hp_cont>
              <P class=txt>
              <SPAN id=dataInfo>
              <P><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal">&nbsp;&nbsp;&nbsp;&nbsp;<SPAN 
style="COLOR: #666666">在本平台申请的单笔提现金额大于</SPAN><SPAN 
style="COLOR: #666666">100</SPAN><SPAN style="COLOR: #666666">小于</SPAN><SPAN 
style="COLOR: #666666">5</SPAN><SPAN 
style="COLOR: #666666">万即可申请成功，若提现数额超过</SPAN><SPAN 
style="COLOR: #666666">5</SPAN><SPAN 
style="COLOR: #666666">万，则可申请多笔提现。</SPAN></SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal"></SPAN></P>
              <P style="TEXT-ALIGN: left"><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal"></SPAN></P>
              </SPAN>
              <P></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>投标后，能否撤回？</B></H5>
            <DIV class=hp_cont>
              <P class=txt>
              <SPAN id=dataInfo>
              <DIV>
                <P style="TEXT-ALIGN: left"><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal">&nbsp;&nbsp;&nbsp;<SPAN 
style="COLOR: #666666">&nbsp;</SPAN><SPAN 
style="COLOR: #666666">不能，投标进程中所有参与用户与标的进度都是一个整体，如借款标在发布有效期仍未投满从而流标，</SPAN></SPAN><SPAN 
style="FONT-STYLE: normal; FONT-FAMILY: 'Arial'; BACKGROUND: #ffffff; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: normal">则账户上的冻结金额</SPAN><SPAN 
style="FONT-STYLE: normal; FONT-FAMILY: 'Arial'; BACKGROUND: #ffffff; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: normal">自动</SPAN><SPAN 
style="FONT-STYLE: normal; FONT-FAMILY: '宋体'; BACKGROUND: #ffffff; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: normal">回到账</SPAN><SPAN 
style="FONT-STYLE: normal; FONT-FAMILY: 'Arial'; BACKGROUND: #ffffff; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: normal">户</SPAN><SPAN 
style="FONT-STYLE: normal; FONT-FAMILY: '宋体'; BACKGROUND: #ffffff; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: normal">中的</SPAN><SPAN 
style="FONT-STYLE: normal; FONT-FAMILY: 'Arial'; BACKGROUND: #ffffff; COLOR: #666666; FONT-SIZE: 12pt; FONT-WEIGHT: normal">可用金额。</SPAN><SPAN 
style="FONT-FAMILY: 'Calibri'; COLOR: #666666; FONT-SIZE: 12pt">&nbsp;</SPAN><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal"></SPAN> </P>
                <P style="TEXT-ALIGN: left"><SPAN 
style="FONT-FAMILY: '宋体'; COLOR: #808080; FONT-SIZE: 12pt; FONT-WEIGHT: normal"></SPAN></P>
              </DIV>
              </SPAN>
              <P></P>
            </DIV>
          </DIV>
          <DIV>
            <!--/main-->
          </DIV>
        </DIV>
        <DIV style="DISPLAY: none" id=herp9>
          <DIV class=help_box>
            <H5 class=up><B>收不到激活邮件怎么办？</B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">答：有以下方法可以尝试。一是可以登录注册邮箱后，在垃圾箱里寻找，看是否被邮箱系统自动辨识为了垃圾邮件。二是请尝试清空浏览器缓存，清空后，点击“重新发送激活邮件”。若是还未成功，请联系网站在线客服。</SPAN> </P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>充值使用的银行卡和提现绑定的银行卡是否必须一致？</B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">答：不需要。充值您可以使用网站上标明的任何一家银行的银行卡网银充值。</SPAN> </P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>同一人是否可以申请多个账号？</B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">答：因账户和实名信息是一对一的绑定关系，所以同一人只能申请一个账号，您的身份信息不能再次绑定新账户。</SPAN> </P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>投资后，本人是否能够自主撤销？</B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">答：为了不影响项目的融资进度，保证交易的时效性，投资后，不能申请撤销。</SPAN> </P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>为什么有些项目标题后会标有第二期或者第三期字样？</B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">答：短期内，借款人可能会在我们所审批的额度内连续发布第二期或第三期借款项目，我们会建议借款人将大额借款项目分期发布，以保证项目当日认购完成并计息。这不仅缩短了投资人所投资金的冻结时间，减少了投资人资金闲置，还提高了借款人融资效率。</SPAN> </P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>借款人逾期了怎么办？</B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">答：若借款人逾期，则推荐借款项目的担保机构会在逾期后的1-3个工作日内代偿该期本金、收益。</SPAN> </P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>投资人申请提现后何时到账？</B></H5>
            <DIV class=hp_cont>
              <DIV class=boxmain2>
                <P class=tips><SPAN 
style="MARGIN-BOTTOM: 5px; FONT-SIZE: 16px">详情查看网站收费标准公告</SPAN><BR>
                </P>
                <P></P>
              </DIV>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>为什么充值的时候提示充值金额超过每日支付限额？</B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">答：每日支付限额由银行每日支付限额、第三方支付平台每日支付限额和用户自己设定的每日支付限额三者共同决定，在实际使用中三者取最小值。例如：交通银行的网银每日支付限额是50万，但是交通银行和财付通签协议的时候，规定用户在财付通使用交通银行网银的时候每日支付限额为100万，用户自己设定的每日支付限额为30万，此时用户可以使用的每日支付限额为30万。</SPAN> </P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>投资人相关费用</B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN style="FONT-FAMILY: 'font-size:12pt;'">1、 详细收费标准请查看网站收费标准公告。<BR>
                2、 请查看网站自费说明公告。。<BR>
                3、 充值费用：全免。<BR>
                4、 
                提现费用：请查看网站收费标准公告。</SPAN> </P>
            </DIV>
          </DIV>
          <DIV>
            <!--/main-->
          </DIV>
        </DIV>
        <DIV style="DISPLAY: none" id=herp10>
          <DIV class=help_box>
            <H5 class=up><B>借款人（贷款人）</B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">已经或准备在网站上进行借款活动的用户称为借款人。凡22周岁以上的中国大陆地区公民，都可以成为借款人。 </SPAN></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>投资人 </B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">已经或准备在网站上进行资金出借活动并完成了实名认证、手机号码绑定的用户称为投资人。 </SPAN></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>借款标</B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">指借款人发布的包含其借款相关说明信息的借款申请。一个合格的借款项目至少包含：标题、描述、借款用途、借款总额、还款方式、年利率、借款期限、招标期限等基本信息。 </SPAN></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>发标</B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN style="FONT-FAMILY: 'font-size:12pt;'">指借款用户发布借款项目的行为。 </SPAN></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>投标 </B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">指投资人将其本平台账户内的可用余额出借给指定的借款用户的行为。 </SPAN></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>流标 </B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">指一个项目在一定时间内没有招标完成，借款失败了自动流标的谁投资的钱自动还给谁。 </SPAN></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>放款 </B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">指一个借款标满额后且已符合放款标准，该借款所筹资金从投资人账户转入借款人账户的过程，即借款人成功获得了借款。 </SPAN></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>借款失败 </B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">指因资料上传不全或综合情况不符合借款要求，导致借款申请未通过，或超过项目购买期限但未满额的状态叫做借款失败。 </SPAN></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>逾期 </B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">指借款用户未按协议约定还款日当天24:00之前进行足额还款，此时借款的状态为逾期。 </SPAN></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>帐户总额 </B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">指用户账户的所有金额（帐户总额=可用余额+待收总额+冻结总额）。 </SPAN></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>可用余额 </B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN style="FONT-FAMILY: 'font-size:12pt;'">是指用户可自由支配的金额。 </SPAN></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>冻结总额 </B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">帐户中已冻结，不能自由支配的金额，（冻结总额=投资中冻结金额+提现中冻结金额） </SPAN></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>总收益 </B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">指用户账户的所有收益（总收益=已赚利息+待收利息+其他收益） </SPAN></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>等额本息 </B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">在还款期内，每月偿还同等的金额(包含本金和利息)。月利率不变，每月所得利息随本金逐月减少而减少。 
                每月还款额=[贷款本金×月利率×（1+月利率）^还款总期数]÷[（1+月利率）^还款总期数-1] </SPAN></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>先息后本 </B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">每月返还利息，最后一个月返还当月的本金和利息。 </SPAN></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>债权</B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN style="FONT-FAMILY: 'font-size:12pt;'">指投资人与借款人之间的债务约定。 </SPAN></P>
            </DIV>
          </DIV>
          <DIV class=help_box>
            <H5 class=up><B>净值</B></H5>
            <DIV class=hp_cont>
              <P class=txt><SPAN 
style="FONT-FAMILY: 'font-size:12pt;'">以投资用户在本平台的待收债权为担保，按一定比例授予的可借款权。 </SPAN></P>
            </DIV>
          </DIV>
        </DIV>
        <DIV class=clearfix></DIV>
      </DIV>
    </DIV>
    <DIV class=clear></DIV>
  </DIV>
</DIV>

<SCRIPT type=text/javascript>
$(document).ready(function(){
	$('.help_box').each( function(){
		var oBtn = $(this).find('h5');
		var oDiv = $(this).find('.hp_cont');
		oBtn.click(function(){
			$('.hp_cont').slideUp(200);
			$('.help_box').find('h5').removeClass('down');
			if(oDiv.is(":visible")){				
				oDiv.slideUp(200)
			} else {
				oBtn.addClass("down")
				oDiv.slideDown(300)
			}			
		});
	});
	
});


function divhidden(aaa){

 if(aaa=="1"){
	document.getElementById("htop").innerHTML="新手入门";
	document.getElementById("herp1").style.display="";
 	document.getElementById("herp2").style.display="none";
 	document.getElementById("herp3").style.display="none";
 	document.getElementById("herp4").style.display="none";
 	document.getElementById("herp5").style.display="none";
 	document.getElementById("herp6").style.display="none";
 	document.getElementById("herp7").style.display="none";
	document.getElementById("herp8").style.display="none";
	document.getElementById("herp9").style.display="none";
	document.getElementById("herp10").style.display="none";
 	
 
 }else if(aaa=="2"){
	 document.getElementById("htop").innerHTML="我要理财";
	 document.getElementById("herp2").style.display="";
 	document.getElementById("herp1").style.display="none";
 	document.getElementById("herp3").style.display="none";
 	document.getElementById("herp4").style.display="none";
 	document.getElementById("herp5").style.display="none";
 	document.getElementById("herp6").style.display="none";
 	document.getElementById("herp7").style.display="none";
	document.getElementById("herp8").style.display="none";
	document.getElementById("herp9").style.display="none";
	document.getElementById("herp10").style.display="none";
 	
 }else if(aaa=="3"){
	 document.getElementById("htop").innerHTML="我要借款";
	 document.getElementById("herp3").style.display="";
 	document.getElementById("herp1").style.display="none";
 	document.getElementById("herp2").style.display="none";
 	document.getElementById("herp4").style.display="none";
 	document.getElementById("herp5").style.display="none";
 	document.getElementById("herp6").style.display="none";
 	document.getElementById("herp7").style.display="none";
	document.getElementById("herp8").style.display="none";
	document.getElementById("herp9").style.display="none";
	document.getElementById("herp10").style.display="none";
 	
 }else if(aaa=="4"){
	 document.getElementById("htop").innerHTML="我要借款";
	 document.getElementById("herp4").style.display="";
 	document.getElementById("herp1").style.display="none";
 	document.getElementById("herp2").style.display="none";
 	document.getElementById("herp3").style.display="none";
 	document.getElementById("herp5").style.display="none";
 	document.getElementById("herp6").style.display="none";
 	document.getElementById("herp7").style.display="none";
	document.getElementById("herp8").style.display="none";
	document.getElementById("herp9").style.display="none";
	document.getElementById("herp10").style.display="none";
 	
 }else if(aaa=="5"){
	 document.getElementById("htop").innerHTML="投资赎回";
	 document.getElementById("herp5").style.display="";
 	document.getElementById("herp1").style.display="none";
 	document.getElementById("herp2").style.display="none";
 	document.getElementById("herp3").style.display="none";
 	document.getElementById("herp4").style.display="none";
 	document.getElementById("herp6").style.display="none";
 	document.getElementById("herp7").style.display="none";
	document.getElementById("herp8").style.display="none";
	document.getElementById("herp9").style.display="none";
	document.getElementById("herp10").style.display="none";
 
 }else if(aaa=="6"){
	 
	 document.getElementById("herp6").style.display="";
 	document.getElementById("herp1").style.display="none";
 	document.getElementById("herp2").style.display="none";
 	document.getElementById("herp3").style.display="none";
 	document.getElementById("herp4").style.display="none";
 	document.getElementById("herp5").style.display="none";
 	document.getElementById("herp7").style.display="none";
	document.getElementById("herp8").style.display="none";
	document.getElementById("herp9").style.display="none";
	document.getElementById("herp10").style.display="none";
 	
 }else if(aaa=="7"){document.getElementById("herp7").style.display="";
 	document.getElementById("herp1").style.display="none";
 	document.getElementById("herp2").style.display="none";
 	document.getElementById("herp3").style.display="none";
 	document.getElementById("herp4").style.display="none";
 	document.getElementById("herp5").style.display="none";
 	document.getElementById("herp6").style.display="none";
 	document.getElementById("herp8").style.display="none";
 	document.getElementById("herp9").style.display="none";
	document.getElementById("herp10").style.display="none";
 	
 }
 else if(aaa=="8"){
	 document.getElementById("htop").innerHTML="我的账户";
	 document.getElementById("herp8").style.display="";
	document.getElementById("herp1").style.display="none";
	document.getElementById("herp2").style.display="none";
	document.getElementById("herp3").style.display="none";
	document.getElementById("herp4").style.display="none";
	document.getElementById("herp5").style.display="none";
	document.getElementById("herp6").style.display="none";
 	document.getElementById("herp7").style.display="none";
 	document.getElementById("herp9").style.display="none";
	document.getElementById("herp10").style.display="none";
	
}
 else if(aaa=="9"){
	 document.getElementById("htop").innerHTML="常见问题";
	 document.getElementById("herp9").style.display="";
	document.getElementById("herp1").style.display="none";
	document.getElementById("herp2").style.display="none";
	document.getElementById("herp3").style.display="none";
	document.getElementById("herp4").style.display="none";
	document.getElementById("herp5").style.display="none";
	document.getElementById("herp6").style.display="none";
	document.getElementById("herp7").style.display="none";
	document.getElementById("herp8").style.display="none";
	document.getElementById("herp10").style.display="none";
	
}
 else if(aaa=="10"){
	document.getElementById("htop").innerHTML="名词解释";
	document.getElementById("herp10").style.display="";
	document.getElementById("herp1").style.display="none";
	document.getElementById("herp2").style.display="none";
	document.getElementById("herp3").style.display="none";
	document.getElementById("herp4").style.display="none";
	document.getElementById("herp5").style.display="none";
	document.getElementById("herp6").style.display="none";
	document.getElementById("herp7").style.display="none";
	document.getElementById("herp8").style.display="none";
	document.getElementById("herp9").style.display="none";
	
}
}
</SCRIPT>
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
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


<title><?php echo ($glo["web_name"]); ?>新手指引</title>
<meta name="keywords" content="<?php echo ($glo["web_keywords"]); ?>" />
<meta name="description" content="<?php echo ($glo["web_descript"]); ?>" />
<link href="__ROOT__/Style/Help/css/bangzhu.css" rel="stylesheet" type="text/css">
<SCRIPT type="text/javascript" src="__ROOT__/Style/Help/js/jquery-1.8.3.min.js"></SCRIPT>
<div class="main_kan_new">
  <div>
    <table width="979" border="0" cellspacing="0" cellpadding="0" class="cc">
      <tbody>
        <tr>
          <td height="80" colspan="2" background="__ROOT__/Style/Help/images/touzhione.jpg"><table width="205" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td align="center" class="cabout"><span class="f22 baitis fya1">新手指引</span></td>
                </tr>
              </tbody>
            </table></td>
        </tr>
        <tr>
          <td width="21"></td>
          <td width="957"><span class="bkki">
            <table width="90%" border="0" cellspacing="0" cellpadding="0" class="cc">
              <tbody>
                <tr>
                  <td valign="top"><p>&nbsp;</p>
                    <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="cc">
                      <tbody>
                        <tr>
                          <td height="55" colspan="2" align="left" class="f22 fya1 line_35 bkkifont">财富增值从这里开始</td>
                        </tr>
                        <tr>
                          <td height="95" colspan="2" align="left" class="f14 fya1 line_25 bkkifont"><p>本平台作为信息发布及撮合交易平台，一方面解决了小微企业融资难问题，一方面解决百姓投资理财难问题，以专业的团队和贴心的服务，全力打造安全的平台，作为互联网金融的倡导者和引领者，在为中小企业提供低成本融资服务的同时，也为公众提供低风险、高回报，多样化的理财产品。 </p>
                            <p>&nbsp; </p>
                            <p></p></td>
                        </tr>
                        <tr>
                          <td colspan="2" align="left" class="f14 fya1 line_25 bkkifont"><div class="lineone5_1"></div>
                            <br>
                            <p class="f22 fya1 line_45 bkkifont">本平台高收益</p></td>
                        </tr>
                        <tr>
                          <td width="61%" height="265" align="left" class="f14 fya1 line_25 bkkifont"><p><img src="__ROOT__/Style/Help/images/sest.jpg" width="459" height="226"></p>
                            <p>&nbsp;</p></td>
                          <td width="39%" align="left" class="f14 fya1 line_25 bkkifont"><dl class="p20 pr40">
                              <dt class="f22 line_35 f16">10-15%的高收益</dt>
                              <dd>本平台理财项目年化收益在10-15%，
                                种类期限丰富，任您选择，购买即可轻松实现高收益</dd>
                            </dl></td>
                        </tr>
                        <tr>
                          <td colspan="2" align="left" class="f14 fya1 line_25 bkkifont"><div class="lineone5_1"></div></td>
                        </tr>
                        <tr>
                          <td height="71" align="left" class="f22 fya1 line_35 bkkifont">&nbsp;</td>
                          <td height="71" align="left" class="f22 fya1 line_35 bkkifont">&nbsp;</td>
                        </tr>
                        <tr>
                          <td height="487" colspan="2" align="left" class="f16 fya1 line_25 bkkifont"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tbody>
                                <tr>
                                  <td width="41%" height="235" valign="top"><span class="f22 fya1 line_35 bkkifont">投资理财“零”门槛</span><br>
                                    <br>
                                    投资金额，<span class="ran">100元起</span>，真正实现“零”门槛 <br>
                                  </td>
                                  <td colspan="2" align="right"><img src="__ROOT__/Style/Help/images/sest1.jpg" width="446" height="226"></td>
                                </tr>
                                <tr>
                                  <td colspan="3" valign="top"><p>&nbsp;</p>
                                    <div class="lineone5_1"></div></td>
                                </tr>
                                <tr>
                                  <td height="158" valign="top"><img src="__ROOT__/Style/Help/images/banner_31.jpg" width="300" height="270"></td>
                                  <td width="12%" valign="top" class="f22 fya1 line_25 bkkifont"><br>
                                  </td>
                                  <td width="47%" align="left" valign="middle" class="f22 fya1 line_25 bkkifont"><span class="line_45">投资 保障</span><br>
                                    <span class="f14"><span class="bkkifont f18 line_35"><span class="bkkifont f15 line_35"><span class="f14"></span></span></span>1 严格完善的多重风险把控体系<br>
                                    <span class="bkkifont f18 line_35"><span class="bkkifont f15 line_35"><span class="f14"></span></span></span>2 多方担保机构全额担保<br>
                                    <span class="bkkifont f18 line_35"><span class="bkkifont f15 line_35"><span class="f14"></span></span></span>3 资产足额抵押</span> </td>
                                </tr>
                                <tr>
                                  <td height="35" colspan="3" valign="top"><div class="lineone5_1"></div></td>
                                </tr>
                                <tr>
                                  <td height="35" colspan="3" valign="top"><span class="f22 fya1 line_45 bkkifont"> 如何投资</span></td>
                                </tr>
                                <tr>
                                  <td height="70" colspan="3" valign="top"><p>&nbsp;</p>
                                    <table width="630" border="0" cellspacing="0" cellpadding="0">
                                      <tbody>
                                        <tr>
                                          <td width="175"><a href="__APP__/member/common/register"><img src="__ROOT__/Style/Help/images/banner_30_1.jpg" width="175" height="50" border="0" title="注册账户"></a></td>
                                          <td width="159"><a href="__APP__/member/verify?id=1#fragment-3"><img src="__ROOT__/Style/Help/images/banner_30_2.jpg" width="159" height="50" border="0" title="实名认证"></a></td>
                                          <td width="10"><a href="__APP__/member/charge#fragment-1"><img src="__ROOT__/Style/Help/images/banner_30_3.jpg" width="162" height="50" border="0" title="充值"></a></td>
                                          <td width="286"><a href="__APP__/invest/index.html"><img src="__ROOT__/Style/Help/images/banner_30_4.jpg" width="134" height="50" border="0" title="开始投资"></a></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                    <p>&nbsp;</p></td>
                                </tr>
                              </tbody>
                            </table></td>
                        </tr>
                      </tbody>
                    </table>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p></td>
                </tr>
              </tbody>
            </table>
            </span> </td>
        </tr>
      </tbody>
    </table>
    <p>&nbsp;</p>
    <table width="979" border="0" cellspacing="0" cellpadding="0" class="cc">
      <tbody>
      <tr background="__ROOT__/Style/Help/images/touzhione_new1.jpg">
        <td background="__ROOT__/Style/Help/images/touzhione_new1.jpg" height="80" colspan="2"><table width="205" border="0" cellspacing="0" cellpadding="0">
            <tbody>
              <tr>
                <td align="center" class="cabout"><span class="f22 baitis fya1">新手疑问</span></td>
              </tr>
            </tbody>
          </table></td>
      </tr>
      <tr>
      
      <td width="21"></td>
      <td width="957">
      <span class="bkki"><br>
      <table width="90%" border="0" cellspacing="0" cellpadding="0" class="cc">
        <tbody>
        <tr>
        
        <td>
        <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="cc">
          <tbody>
            <tr>
              <div id="mainsub">
                <div class="help_box1">
                  <h5 class="up down"><b>关于理财人及借款人双方民间借贷关系的合法性？</b></h5>
                  <div class="hp_cont" style="display: block;">
                    <p>根据《合同法》第196条规定“借款合同是借款人向贷款人借款，到期返还借款并支付利息的合同”，《合同法》允许自然人等普通民事主体之间发生借贷关系，并允许出借方到期可以收回本金和符合法律规定的利息。</p>
                  </div>
                </div>
                <div class="help_box1">
                  <h5 class="up"><b>我的钱借给谁？</b></h5>
                  <div class="hp_cont">
                    <p> 本平台主要针对信誉良好,工作、生活稳定，经营支出稳定的个人和企业，为其解决资金需求。平台所发布的每一个借款项目都经过了实地考察、严格审批且具有多重保障。投资人可根据平台所展示的理财项目进行选择，进行投资理财。 </p>
                  </div>
                </div>
                <div class="help_box1">
                  <h5 class="up"><b>投资人相关费用？</b></h5>
                  <div class="hp_cont"> 1、 充值,帐户管理费,身份证认证短信服务等费用均由平台承担;投资人免费。 <br>
                    2、 投资人在提现过程中需承担千分之三的提现服务费,由第三方支付公司从投资人帐户中扣除。 <br>
                    3、 充值费用：全免。 <br>
                     </div>
                </div>
                <div class="help_box1">
                  <h5 class="up"><b>充值在本平台的资金安全吗？</b></h5>
                  <div class="hp_cont">
                    <p> 投资人充值资金流转于国付宝、网银在线、宝付、环迅等，本平台指定合作商其安全级别和银行一样，为投资者提供严谨、安全的投资环境。 </p>
                  </div>
                </div>
                <div class="help_box1">
                  <h5 class="up"><b>在本平台可以获得的收益情况？</b></h5>
                  <div class="hp_cont">
                    <p>本平台目前的年化收益率在10-15%之间，是同期银行活期存款收益的45倍。</p>
                  </div>
                </div>
                <div class="help_box1">
                  <h5 class="up"><b>电子合同是否具有法律效应？</b></h5>
                  <div class="hp_cont">
                    <p>我国新《合同法》第十一条规定: 书面形式合同是指合同书、信件和数据电文(包括电报、电传、传真、电子数据交换和电子邮件)等可以有形地表现所载内容的形式。因此电子合同属于书面形式的合同一种，是受到法律保护的。另外本平台平台中的合同文本都由专业经济法律师起草，保证了经过平台的交易是具备法律效力的。</p>
                  </div>
                </div>
                <!--/main-->
              </div>
          </td>
          
          </tr>
          
          </tbody>
        </table>
        </td>
        
        </tr>
        
        </tbody>
      </table>
      </span>
      </td>
      
      </tr>
      
      </tbody>
    </table>
    <p>&nbsp;</p>
  </div>
</div>
<div> </div>
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
<SCRIPT type=text/javascript>
$(document).ready(function(){
	$('.help_box1').each( function(){
		var oBtn = $(this).find('h5');
		var oDiv = $(this).find('.hp_cont');
		oBtn.click(function(){
			$('.hp_cont').slideUp(200);
			$('.help_box1').find('h5').removeClass('down');
			if(oDiv.is(":visible")){				
				oDiv.slideUp(200)
			} else {
				oBtn.addClass("down")
				oDiv.slideDown(300)
			}			
		});
	});
	
});
</SCRIPT>
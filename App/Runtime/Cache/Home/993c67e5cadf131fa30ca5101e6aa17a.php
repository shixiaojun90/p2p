<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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


<title><?php echo ($glo["web_name"]); ?>安全保障</title>
<meta name="keywords" content="<?php echo ($glo["web_keywords"]); ?>" />
<meta name="description" content="<?php echo ($glo["web_descript"]); ?>" />
<link href="__ROOT__/Style/Help/css/bangzhu.css" rel="stylesheet" type="text/css">
<table width="979" border="0" cellspacing="0" cellpadding="0" class="cc">
  <tbody>
    <tr>
      <td height="80" colspan="2"  style=" background:url(__ROOT__/Style/Help/images/touzhione.png) no-repeat;"><table width="205" border="0" cellspacing="0" cellpadding="0">
          <tbody>
            <tr>
              <td align="center" class="cabout"><span class="f22 baitis fya1">安全保障</span></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td width="21"></td>
      <td width="957"><div class="bkki"> <br>
          <table width="80%" border="0" cellspacing="0" cellpadding="0" class="cc">
            <tbody>
              <tr>
                <td width="58%" align="left"><p><span class="bkkifont f18 line_35"><strong><br>
                    严格的准入机制    多重筛选    铸就卓越风控</strong><strong> </strong><br>
                    <span class="bkkifont f15 line_35"> 与我平台达成战略合作的必要筛选条件：</span><br>
                    <span class="bkkifont  line_25 f15"><span class="f12"></span><strong> 有行业知名度的民营机构 </strong><br>
                    <span class="bkkifont  line_25 f15"><span class="f12">●</span> 知名担保机构和小贷公司<br>
                    <span class="f12">●</span> 近两年坏账率控制在2%以内<br>
                    <span class="f12">●</span> 具有成熟的业务体系和可考究的历史逾期数据</span></span></span></p>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p></td>
                <td width="42%" align="center" valign="top"><br>
                  <img src="__ROOT__/Style/Help/images/touzhione1.jpg" width="190" height="195"> <br></td>
              </tr>
              <tr>
                <td colspan="2"><div class="lineone5_1"></div>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p></td>
              </tr>
            </tbody>
          </table>
          <span>
          <table width="80%" border="0" cellspacing="0" cellpadding="0" class="cc">
            <tbody>
              <tr>
                <td width="49%" height="292" align="left"><img src="__ROOT__/Style/Help/images/ding.jpg" width="234" height="218"> </td>
                <td width="51%" align="left"><p class="bkkifont f14 line_28" align="left"> <strong class="f18 line_35 fya1">六道缜密审核    安全固若金汤</strong><br>
                    <strong><span class="bkkifont f18 line_35"><span class="bkkifont  line_25 f15"><span class="f12">●</span> </span></span>实地考察：</strong>合作担保机构实地考察线下借款人<br>
                    <strong><span class="bkkifont f18 line_35"><span class="bkkifont  line_25 f15"><span class="f12">●</span> </span></span>资料审核：</strong>审核包括银行流水、资产情况等十余项必备材料 <br>
                    <strong><span class="bkkifont f18 line_35"><span class="bkkifont  line_25 f15"><span class="f12">●</span> </span></span>背景调查：</strong>对借款人背景、联系人信息详尽调查 <br>
                    <strong><span class="bkkifont f18 line_35"><span class="bkkifont  line_25 f15"><span class="f12">●</span> </span></span>还款能力：</strong>结合资料审查和数据分析综合评估其还款能力 <br>
                    <strong><span class="bkkifont f18 line_35"><span class="bkkifont  line_25 f15"><span class="f12">●</span> </span></span>抵押办理：</strong>资产通过估值后办理相关抵押手续 <br>
                    <strong><span class="bkkifont f18 line_35"><span class="bkkifont  line_25 f15"><span class="f12">●</span> </span></span>二次核查：</strong>由本平台自有风控团队二次严格把关 </p>
                  <p class="bkkifont f14 line_28" align="left"><br>
                  </p></td>
              </tr>
              <tr>
                <td colspan="2"><div class="lineone5_1"></div></td>
              </tr>
            </tbody>
          </table>
          <table width="80%" border="0" cellspacing="0" cellpadding="0" class="cc">
            <tbody>
              <tr>
                <td width="56%" height="291"><p class="f14 bkkifont line_28"><br>
                    <span class="f18 fya1 line_35"><strong>专业评估体系     360°全方位把关</strong></span><br>
                    合作担保机构提供的所有抵押项目均需通过专业评估师按<br>
                    照严谨、权威的一套评估体系流程进行估值。严格的抵押<br>
                    操作流程办理、定期的贷后管理和全方位严格把关，确保<br>
                    其抵押物在项目期限内的保值性最大化 </p>
                  <p>&nbsp;</p></td>
                <td width="44%" align="center"><img src="__ROOT__/Style/Help/images/de.jpg" width="196" height="199"></td>
              </tr>
              <tr>
                <td colspan="2"><div class="lineone5_1"></div></td>
              </tr>
            </tbody>
          </table>
          <br>
          <table width="85%" border="0" cellspacing="0" cellpadding="0" class="cc">
            <tbody>
              <tr>
                <td width="51%" height="319"><p class="f14 bkkifont line_28"><img src="__ROOT__/Style/Help/images/fent.jpg" width="339" height="262"><br>
                  </p>
                  <p>&nbsp;</p></td>
                <td width="49%" align="left"><p><strong class="f18 fya1 line_35 bkkifont">一对多的交易机制    充分有效分散风险</strong></p>
                  <p class="f14 bkkifont line_28 fya1">投资人在本平台可以通过分散投资多个不同</p>
                  <p class="f14 bkkifont line_28 fya1">项目，进而充分、有效地分散风险</p>
                  <p class="bkkifont f14 line_28" align="left">&nbsp;</p></td>
              </tr>
              <tr>
                <td colspan="2"><div class="lineone5_1"></div></td>
              </tr>
            </tbody>
          </table>
          <table width="85%" border="0" cellspacing="0" cellpadding="0" class="cc">
            <tbody>
              <tr>
                <td width="66%" height="299"><p class="f14 bkkifont fya1 line_28"><br>
                  </p>
                  <p><strong class="f18 fya1 line_35 bkkifont">本息保障制度保护投资人权益</strong></p>
                  <p class="f14 bkkifont fya1 line_28"><span class="f12">●</span> 合作担保机构为其提供的每一笔项目承担100%的</p>
                  <p class="f14 bkkifont fya1 line_28">　连带担保责任</p>
                  <p class="f14 bkkifont fya1 line_28">● 逾期、坏账的项目由与该项目对应的合作担保机构全额垫付</p>
                  <p>&nbsp;</p></td>
                <td width="34%" align="center"><p class="bkkifont f14 line_28" align="left"><img src="__ROOT__/Style/Help/images/baoxiao.jpg" width="180" height="173"></p></td>
              </tr>
              <tr>
                <td colspan="2"><div class="lineone5_1"></div></td>
              </tr>
            </tbody>
          </table>
          <br>
          <table width="85%" border="0" cellspacing="0" cellpadding="0" class="cc">
            <tbody>
              <tr>
                <td width="51%" height="291"><p class="f14 bkkifont line_28"><br>
                    <img src="__ROOT__/Style/Help/images/shai.jpg" width="250" height="220"> </p>
                  <p>&nbsp;</p></td>
                <td width="49%" align="left"><p><strong class="bkkifont f18 fya1 line_35">健全的善后措施    完善的消费者保护</strong></p>
                  <p class="bkkifont f14 fya1 line_28"><span class="f14 bkkifont fya1 line_28"><span class="f12">●</span> </span>投资人与借款人签订的借贷合同在任意情况下（签订期限内）</p>
                  <p class="bkkifont f14 fya1 line_28">　均有效，并受法律保护</p>
                  <p class="bkkifont f14 fya1 line_28"><span class="f14 bkkifont fya1 line_28"><span class="f12">●</span> </span>借款发生逾期，本平台有最终连带担保责任。将会同</p>
                  <p class="bkkifont f14 fya1 line_28">　专门的律师团队及业务遍及全国的催收机构，促成借贷合</p>
                  <p class="bkkifont f14 fya1 line_28">　同的完整执行</p>
                  <p class="bkkifont f14 line_28" align="left">&nbsp;</p></td>
              </tr>
              <tr>
                <td colspan="2"><div class="lineone5_1"></div></td>
              </tr>
            </tbody>
          </table>
          <table width="85%" border="0" cellspacing="0" cellpadding="0" class="cc">
            <tbody>
              <tr>
                <td width="51%"><br>
                <td width="49%" align="left"><p class="bkkifont f18 line_35" align="left">&nbsp; </p>
                  <p class="bkkifont f18 line_35" align="left"><strong>　　　　　　数据安全与维护</strong> </p>
                  <p class="bkkifont f14 line_28" align="left"> 本平台拥有独立的网站服务器，安装了更具安全优势的<br>
                    操作系统。专人维护、定期安检升级，配以先进</p>
                  <p class="bkkifont f14 line_28" align="left">的软硬件防火墙设备，确保网站被攻击几率最低，有效防</p>
                  <p class="bkkifont f14 line_28" align="left">止来自外部的安全威胁</p>
                  <p class="bkkifont f14 line_28" align="left">&nbsp;</p></td>
              </tr>
            </tbody>
          </table>
          <br>
          </span></div></td>
    </tr>
  </tbody>
</table>
</div>
</div>
<div> 
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
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
<script type="text/javascript" src="__ROOT__/Style/H/js/common.js" language="javascript"></script>
<script type="text/javascript">
var Transfer_invest_url = "__APP__/tinvest";
</script>
<script type="text/javascript" src="__ROOT__/Style/H/js/area.js"></script>
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



<script type="text/javascript">
var url = window.location.href;
if(url)var allargs = url.split("?")[1];
if(allargs)var tab1= allargs.split("=")[1];
if(tab1)var tab= tab1.split("&")[0];

$(function(){ 
    if(tab==9){
        $('#a1').addClass("show_style");
    }
    if(tab==4){
        $('#a2').addClass("show_style");
        $('#a1').removeClass("show_style");
    }
    if(tab==6){
        $('#a3').addClass("show_style");
        $('#a1').removeClass("show_style");
    };
    if(tab==7){
        $('#a4').addClass("show_style");
        $('#a1').removeClass("show_style");
    };
    if(tab==10){
        $('#a5').addClass("show_style");
        $('#a1').removeClass("show_style");
        $('#black').attr('style','display:block');
        $('#con').attr('style','display:none');
    };
});

</script>
<script type="text/javascript">
function buy_debt(invest_id)
{
    $.jBox("get:__URL__/buydebt?invest_id="+invest_id, {
        title: "购买债权",
        width: "auto",
        buttons: {}
    });
}
</script>

<div class="list_banner" style="height:150px;">
  <div class="list_banner_left" >
    <div class="list_banner_left_l" style="height:122px;">
      <h2>筛选债权</h2>
      <ul>
        <li class="saixuanlx">债权状态</li>
        <?php foreach($searchMap['status'] as $key=>$v){ ?>
        <?php if($key==$searchUrl['status']['cur']){ ?>
        <li class="buxz"><a><?php echo ($v); ?></a></li>
        <?php }else{ ?>
        <li><a class="a_lb_2" href="__URL__/index.html?type=search&<?php echo ($searchUrl["status"]["url"]); ?>&status=<?php echo ($key); ?>"><?php echo ($v); ?></a></li>
        <?php } ?>
        <?php } ?>
      </ul>
      <ul class="dierge">
        <li  class="saixuanlx">信用等级</li>
        <?php foreach($searchMap['leve'] as $key=>$v){ ?>
        <?php if($key==$searchUrl['leve']['cur']){ ?>
        <li class="buxz"><a><?php echo ($v); ?></a></li>
        <?php }else{ ?>
        <li><a class="a_lb_2" href="__URL__/index.html?type=search&<?php echo ($searchUrl["leve"]["url"]); ?>&leve=<?php echo ($key); ?>"><?php echo ($v); ?></a></li>
        <?php } ?>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>
<div class="list_main main">
  <div class="list_main_top">
  <div class="wleft"><h3 class="title_03">债权列表<a id="wpass" class="more" href="/tools/tool.html">理财计算器</a></h3> </div>
  <div class="wright"></div>   
</div>
    
     <table border="0" style="padding:0 5px;">
            <tr class="diyige borrowlistl">
            <td width="286">借款标题</td>
			<td width="286">借款类型</td>
            <td class="dengji" width="124">信用等级</td>
            <td class="dengji" width="124">借款利率</td>
            <td class="dengji" width="100">转让价格</td>
            <td class="dengji" width="100">待收本息</td>
            <td class="dengji jindu" width="120">转让期数/总期数</td>
            <td class="dengji" width="160">状态</td>
          </tr>
  <?php if(is_array($list["data"])): $i = 0; $__LIST__ = $list["data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vb): $mod = ($i % 2 );++$i;?><tr height="80" class="borrowlist borrowlistl <?php if(($key+1)%10 == 0): ?>delline<?php endif; ?>">
	    <td width="286" align="left" style="text-align:left;">&nbsp;&nbsp;<?php echo getIco($vb);?><a href="<?php echo (getinvesturl($vb["id"])); ?>"title="<?php echo ($vb["borrow_name"]); ?>" class="BL_name"><?php echo (cnsubstr($vb["borrow_name"],12)); ?></a></td>
	    <td class="dengji" width="100"><?php echo ($borrowtype[$vb['borrow_type']]); ?></td>
		<td class="dengji" width="124"><?php echo (getleveico($vb["credits"],2)); ?></td>
	    <td class="dengji" width="124"><span class="BL_time"><?php echo ($vb["borrow_interest_rate"]); ?></span>&nbsp;%</td>
	    <td class="dengji" width="100"><span class="BL_time"><?php echo (($vb["transfer_price"])?($vb["transfer_price"]):0); ?></span>&nbsp;元</td>
	    <td class="dengji" width="100"><span class="BL_time">￥<?php echo (($vb["money"])?($vb["money"]):0); ?></span>&nbsp;元</td>
	    <td class="dengji jindu" width="100"> <span class="BL_time"><?php echo ($vb["period"]); ?></span>期/<span class="BL_time"><?php echo ($vb["total_period"]); ?></span>期
</td>
	    <td class="dengji" width="160">
        
         <?php if($vb["status"] == '2'): ?><a href="javascript:;" onclick="buy_debt('<?php echo ($vb["invest_id"]); ?>')"><img class="anNiuYLB" src="__ROOT__/Style/H/images/tb.gif" /></a>
                            <?php elseif($vb["status"] == '1'): ?>
                            <img  class="anNiuYLB" src="__ROOT__/Style/H/images/ywc.gif"  />
							<?php elseif($vb["status"] == '4'): ?>
                            <img  class="anNiuYLB" src="__ROOT__/Style/H/images/yts.gif"  /><?php endif; ?>
                    
                  <input id="hid<?php echo ($vo["debt_id"]); ?>" type="hidden" value="<?php echo ($vo['valid']-time()); ?>" />
			  <script type="text/javascript">
                var seconds<?php echo ($vo["debt_id"]); ?>;
                var timer<?php echo ($vo["debt_id"]); ?>=null;
                function setLeftTime<?php echo ($vo["debt_id"]); ?>() {
                    seconds<?php echo ($vo["debt_id"]); ?> = parseInt($("#hid<?php echo ($vo["debt_id"]); ?>").val(), 10);
                    timer<?php echo ($vo["debt_id"]); ?> = setInterval(showSeconds<?php echo ($vo["debt_id"]); ?>,1000);
                }
                
                function showSeconds<?php echo ($vo["debt_id"]); ?>() {
                    var day1<?php echo ($vo["debt_id"]); ?> = Math.floor(seconds<?php echo ($vo["debt_id"]); ?> / (60 * 60 * 24));
                    var hour<?php echo ($vo["debt_id"]); ?> = Math.floor((seconds<?php echo ($vo["debt_id"]); ?> - day1<?php echo ($vo["debt_id"]); ?> * 24 * 60 * 60) / 3600);
                    var minute<?php echo ($vo["debt_id"]); ?> = Math.floor((seconds<?php echo ($vo["debt_id"]); ?> - day1<?php echo ($vo["debt_id"]); ?> * 24 * 60 * 60 - hour<?php echo ($vo["debt_id"]); ?> * 3600) / 60);
                    var second<?php echo ($vo["debt_id"]); ?> = Math.floor(seconds<?php echo ($vo["debt_id"]); ?> - day1<?php echo ($vo["debt_id"]); ?> * 24 * 60 * 60 - hour<?php echo ($vo["debt_id"]); ?> * 3600 - minute<?php echo ($vo["debt_id"]); ?> * 60);
                    
                    $("#loan_time<?php echo ($vo["debt_id"]); ?>").html(day1<?php echo ($vo["debt_id"]); ?> + " 天 " + hour<?php echo ($vo["debt_id"]); ?> + " 小时 " + minute<?php echo ($vo["debt_id"]); ?> + " 分 " + second<?php echo ($vo["debt_id"]); ?> + " 秒");
                    
                    seconds<?php echo ($vo["debt_id"]); ?>--;
                    if(seconds<?php echo ($vo["debt_id"]); ?>==0){
                       $("#endtime<?php echo ($vo["debt_id"]); ?>").html("已结束");
                       $("#buy_button").html('<img  class="anNiuHKZ" src="__ROOT__/Style/H/images/ywc.gif"  />'); 
                    }
                }                
                setLeftTime<?php echo ($vo["debt_id"]); ?>();
            </script>

</td>
		
	  </tr><?php endforeach; endif; else: echo "" ;endif; ?>  </table> 
    
</div>
<div class="list_bottom">
  <div class="list_bottom_right">
    <ul>
      <?php echo ($list["page"]); ?>
    </ul>
  </div>
</div>
  <script language="javascript">
	$(function() {
		$(".borrowlistp").bind("mouseover", function(){
			$(this).css("background", "#fce8e1");
		})

		$(".borrowlistp").bind("mouseout", function(){
			$(this).css("background", "#fff");
		})


		$(".borrowlistl").bind("mouseover", function(){
			$(this).css("background", "#f8f8f8");
		})

		$(".borrowlistl").bind("mouseout", function(){
			$(this).css("background", "#fff");
		})
	});

</script>
								
<!--中部结束-->
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
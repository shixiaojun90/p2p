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

<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<title><?php echo ($vo["borrow_name"]); ?>-我要投资-<?php echo ($glo["web_name"]); ?></title>
<meta name="keywords" content="<?php echo ($glo["web_keywords"]); ?>" />
<meta name="description" content="<?php echo ($glo["web_descript"]); ?>" />
<link rel="stylesheet" href="__ROOT__/Style/H/css/reset.css" />
<link rel="stylesheet" href="__ROOT__/Style/H/css/detail.css" />
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


<div class="state_main">
  <div class="xw_main_state">
    <div class="state_project">
      <div class="project_left">
        <h3> <span class="tailuser">借款用户&nbsp;:&nbsp;<?php echo ($minfo["user_name"]); ?>&nbsp;<?php echo (getleveico($minfo["credits"],2)); ?></span><span style="display:block; float:left;"><?php echo getIco($vo);?></span> <?php echo (cnsubstr($vo["borrow_name"],16)); ?>&nbsp; </h3>
        <div class="clear"></div>
        <p> <span class="width1">借款金额</span> <span class="width2">预期年利率</span> <span class="width3">借款期限</span> </p>
        <ul>
          <li><span class="width1"><strong>￥<?php echo (getmoneyformt($vo["borrow_money"])); ?></strong>元</span><span class="width2"><strong><?php echo ($vo["borrow_interest_rate"]); ?></strong>&nbsp;%/年&nbsp;</span> <span class="width3">&nbsp;<strong><?php echo ($vo["borrow_duration"]); ?> </strong>
            <?php if($vo["repayment_type"] == 1): ?>天
              <?php else: ?>
              个月<?php endif; ?>
            </span></li>
          <li> <span class="width1">还款方式：<?php echo ($Bconfig['REPAYMENT_TYPE'][$vo['repayment_type']]); ?></span>投标进度： <span class="ui-list-field"> <span class="ui-progressbar-mid ui-progressbar-mid-<?php echo (intval($vo["progress"])); ?>"><em><?php echo (intval($vo["progress"])); ?>%</em></span> </span> </li>
          <li> <span class="width1">借款用途：<?php echo ($gloconf['BORROW_USE'][$vo['borrow_use']]); ?></span><span>投标奖励：<?php echo ($vo["reward_num"]); ?>%</span>
            <?php if($vo["money_collect"] > 0): ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="width3" style="color:red;"> 待收限制：
              <?php echo (fmoney($vo["money_collect"])); ?>元 </span>
              <?php else: endif; ?>
          </li>
          <li> 
       <!--  <?php if($vo["danbao"] == 0): ?>-->
        <span class="width1">发布时间 : <?php echo (date("Y-m-d H:i",$vo["add_time"])); ?></span>
		<!-- <?php else: ?> -->
        <span class="width1">担保公司 :<a class="newdanbao"  href="/news/<?php echo ($vo["danbao"]); ?>.html"> <?php echo ($vo["title"]); ?></a></span>
     <!--<?php endif; ?> -->
		<span>剩余时间：<span id="endtime"><span class="red"><span  id="loan_time">-- 天 -- 小时 -- 分 -- 秒</span></span></span></span>

 </li>
        </ul>
      </div>
      <div class="project_right">
        <h3><a href="/tools/tool.html">理财计算器</a>我要投标</h3>
        <form method="get" action="">
          <p class="remain"> <span>您的可用余额：</span> <strong>
            <?php if(session('u_id') ==''): ?>￥0.00元
            <?php else: ?> <?php echo ($investInfo['account_money']+$investInfo['back_money']); ?>元
           <!-- <?php echo Fmoney(getFloatValue($investInfo['account_money']+$investInfo['back_money'],2));?>元--><?php endif; ?></strong>
            <a class="fRight icon-gree-link f16 mr20" style="padding:3px 15px;" href="__APP__/member/charge#fragment-1" target="_blank">充值</a>
          </p>
          <p class="jx_end"> 
            <?php if($vo["borrow_status"] > 5): ?>已满标&#12288;&#12288;<a href="__APP__/member/tendout#fragment-3" class="bot03">借款合同</a>
            <?php else: ?>
				 满标还差:<?php echo (getmoneyformt($vo["need"])); ?>元<?php endif; ?>
          </p>
          <p class="jx_notice" id="jx_notice"></p>
          	<p class="jx_input">
			<?php if(session('u_id') ==''): ?><input type="text" class="jx_input_disabled" disabled="disabled" value="请先登录"/>
			<?php elseif($vo["borrow_status"] == 3 or $vo["borrow_status"] == 5): ?>
            	<input type="text" class="jx_input_disabled" disabled="disabled" value="已流标"/>
            <?php elseif($vo["borrow_status"] == 4): ?>
            	<input type="text" class="jx_input_disabled" disabled="disabled" value="复审中"/>
            <?php elseif($vo["borrow_status"] == 6): ?>
            	<input type="text" class="jx_input_disabled" disabled="disabled" value="还款中"/>
            <?php elseif($vo["borrow_status"] > 6): ?>
            	<input type="text" class="jx_input_disabled" disabled="disabled" value="已完成"/>
			<?php elseif($tim > $endtime): ?>
				<input type="text" class="jx_input_disabled" disabled="disabled" value="已过期"/>
           	<?php else: ?>
           		<input id="enter_value" type="text" /><?php endif; ?>
			</p>
			<p class="jx_desc">
				<?php if($vo["borrow_max"] != 0): ?><span>最多投资金额:<?php echo (($vo["borrow_max"])?($vo["borrow_max"]):"无限制"); ?></span><?php endif; ?>起投金额:<?php echo (fmoney($vo["borrow_min"])); ?>
			</p>
			<?php if($vo["borrow_status"] == 3 or $vo["borrow_status"] == 5 ): ?><div class="jx_payment jx_payment_disabled">已流标</div>
            <?php elseif($vo["borrow_status"] == 4): ?>
            	<div class="jx_payment jx_payment_disabled">复审中</div>
            <?php elseif($vo["borrow_status"] == 6): ?>
            	<div class="jx_payment jx_payment_disabled">还款中</div>
            <?php elseif($vo["borrow_status"] > 6): ?>
            	<div class="jx_payment jx_payment_disabled">已完成</div>
			<?php elseif($tim > $endtime): ?>
				<div class="jx_payment jx_payment_disabled">已过期</div>
            <?php else: ?>
            	<div id="jx_payment" class="jx_payment" onclick="invest(<?php echo ($vo["id"]); ?>);">立即投标</div><?php endif; ?>
        </form>
      </div>
    </div>
    <div class="clear"></div>
        <div class="state_info">
      <ul class="state_info_nav" id="state_info_nav">
        <!--<li class="active"><a class="invest-tab current" href="javascript:void(0)" onclick="showTail('userintro',this);">借款者信息</a></li>-->
        <li class="active"><a class="invest-tab current" href="javascript:void(0)" onclick="showTail('picintro',this);">借款详情</a></li>
        <li class=""><a class="invest-tab" href="javascript:void(0)" onclick="showTail('record',this);">投资记录</a></li>
        <li class=""><a class="invest-tab" href="javascript:void(0)" onclick="showTail('comment',this);">用户评论</a></li>
      </ul>
      <div class="clear"></div>
      <div class="state_info_con"  id="userintro" style="display:none;">
        <h3> 个人信息 </h3>
        <ul class="state_person">
          <?php if($UID > '0'): ?><li><span class="width1">性别：<?php echo (($minfo["sex"])?($minfo["sex"]):"未填写"); ?></span><span class="width2">年龄：<?php echo (($minfo["age"])?($minfo["age"]):"0"); ?>岁（<?php echo (getagename($minfo["age"])); ?>）</span><span class="width3">学历：<?php echo (($minfo["education"])?($minfo["education"]):"未填写"); ?></span><span class="width4">婚姻状况：<?php echo (($minfo["marry"])?($minfo["marry"]):"未填写"); ?></span><span class="width5">月收入(元)：<?php echo (getmoneyformt($minfo["fin_monthin"])); ?></span></li>
            <li><span class="width1">邮箱：<?php echo (($minfo["user_email"])?($minfo["user_email"]):"未填写"); ?></span><span class="width2">所属客服：<?php echo (($minfo["customer_name"])?($minfo["customer_name"]):"未指定"); ?></span><span class="width3">是否购车：<?php echo (($minfo["fin_car"])?($minfo["fin_car"]):"未填写"); ?></span><span class="width4">投资积分：<?php echo (($minfo["integral"])?($minfo["integral"]):"0"); ?>分</span><span class="width5">职位：<?php echo (($minfo["zy"])?($minfo["zy"]):"未填写"); ?></span></li>
            <li><span class="width1">户籍所在地：<?php echo (($minfo["location"])?($minfo["location"]):"未填写"); ?></span><span class="width2"></span><span class="width3"></span><span class="width4"></span><span class="width5"></span></li>
            <?php else: ?>
            <p style="font-size:18px; text-align:center; line-height:3em;">个人信息登陆后才可以查看！</p><?php endif; ?>
        </ul>
        <h3> 账户详情 </h3>
        <ul class="state_person">
          <?php if($UID > '0'): ?><li><span class="width1">资产总额：<?php echo (getmoneyformt($minfo["zcze"])); ?></span><span class="width2">待还总额：<?php echo (getmoneyformt($capitalinfo["tj"]["dhze"])); ?></span><span class="width3">已还总额：<?php echo (getmoneyformt($capitalinfo["tj"]["yhze"])); ?></span><span class="width4">借出本金：<?php echo (getmoneyformt($capitalinfo["tj"]["jcze"])); ?></span><span class="width5">待收总额：<?php echo (getmoneyformt($capitalinfo["tj"]["dsze"])); ?></span></li>
            <li><span class="width1">回款总额：<?php echo (getmoneyformt($capitalinfo["tj"]["ysze"])); ?></span><span class="width2">负债情况：
              <?php if($capitalinfo['tj']['fz'] < 0): ?>(<?php echo (getmoneyformt($capitalinfo["tj"]["fz"])); ?>)
                <?php else: ?>
                (<?php echo (getmoneyformt($capitalinfo["tj"]["fz"])); ?>)<?php endif; ?>
              </span><span class="width3">信用额度：<?php echo (getmoneyformt($mainfo["credit_limit"])); ?></span><span class="width4"></span><span class="width5"></span></li>
            <?php else: ?>
            <p style="font-size:18px; text-align:center; line-height:3em;">账户详情登陆后才可以查看！</p><?php endif; ?>
        </ul>
        <h3> 还款信用 </h3>
        <ul class="state_person">
          <?php if($UID > '0'): ?><li><span class="width1">成功借款次数：<?php echo (($capitalinfo["tj"]["jkcgcs"])?($capitalinfo["tj"]["jkcgcs"]):0); ?>次</span><span class="width2">正常还款次数：<?php echo (($capitalinfo["repayment"]["1"]["num"])?($capitalinfo["repayment"]["1"]["num"]):0); ?>次</span><span class="width3">迟还次数：<?php echo (($capitalinfo["repayment"]["3"]["num"])?($capitalinfo["repayment"]["3"]["num"]):0); ?>次</span><span class="width4">待还款笔数：<?php echo (($xin_list["6"]["num"])?($xin_list["6"]["num"]):"0"); ?>次</span><span class="width5">提前还款次数：<?php echo (($capitalinfo["repayment"]["2"]["num"])?($capitalinfo["repayment"]["2"]["num"]):0); ?>次</span></li>
            <li><span class="width1">网站代还次数：<?php echo (($capitalinfo["repayment"]["4"]["num"])?($capitalinfo["repayment"]["4"]["num"]):0); ?>次</span><span class="width2">逾期还款笔数：<?php echo (($capitalinfo["repayment"]["5"]["num"])?($capitalinfo["repayment"]["5"]["num"]):0); ?>次</span><span class="width3"></span><span class="width4"></span><span class="width5"></span></li>
            <?php else: ?>
            <p style="font-size:18px; text-align:center; line-height:3em;">还款信用登陆后才可以查看！</p><?php endif; ?>
        </ul>
        
      </div>
      <div class="state_info_con"  id="picintro" style="display:block;">
        <?php if($UID > '0'): ?><!-- <h3>借款说明</h3> -->
          <ul class="state_person">
		   <style type="text/css">
			.state_person  p {
				TEXT-TRANSFORM: none; BACKGROUND-COLOR: rgb(255,255,255); TEXT-INDENT: 0px; 
				FONT: 16px/30px 宋体; WHITE-SPACE: normal; FLOAT: none; LETTER-SPACING: normal; COLOR: rgb(102,102,102); WORD-SPACING: 0px; -webkit-text-stroke-width: 0px
			 }
			</style>
			<?php echo (($vo["borrow_info"])?($vo["borrow_info"]):"投资人没有添加借款说明"); ?>
            <!-- <p style="font-size:14px; text-align:left; line-height:2em;">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo (($vo["borrow_info"])?($vo["borrow_info"]):"投资人没有添加借款说明"); ?></p> -->
          </ul>
          <?php if($vo['updata'] == 'N;'): else: ?>
            <table style="width:99%">
              <tr>
                <td><div  style="float:left;" id="preview">
                    <div id="spec-n5">
                      <div class="spec-button spec-left" id="spec-left" style="cursor: default;"> <img id="imgLeft" src="__ROOT__/Style/H/images/left_g.gif"></div>
                      <div id="spec-list" class="bot05">
                        <div class="bot06">
                          <ul class="list-h bot07">
                            <?php $i=0;foreach(unserialize($vo['updata']) as $v){ $i++; ?>
                            <li id="display2"> <a href="__ROOT__/<?php echo $v['img']; ?>" title="<?php echo $v['info']; ?>" rel="img_group"> <img  title="<?php echo $v['info']; ?>" src="__ROOT__/<?php echo get_thumb_pic($v['img']); ?>"> </a> <span>
                              <?php echo $v['info']; ?>
                              </span> </li>
                            <?php } ?>
                          </ul>
                        </div>
                      </div>
                      <div class="spec-button" id="spec-right" style="cursor: default;"> <img id="imgRight" src="__ROOT__/Style/H/images/scroll_right.gif"></div>
                    </div>
                  </div>
                  <script type="text/javascript">
								var lilenth = $(".list-h li").length+1;
								$(".list-h").css("width", lilenth * 160);
								var leftpos = 0;
								var leftcount = 0;
				
								$("#imgLeft").attr("src", "__ROOT__/Style/H/images/left_g.gif");
								$("#spec-left").css("cursor", "default");
				
								if (lilenth > 1) {
									$(function() {
										$("#spec-right").click(function() {
											if (leftcount >= 0) {
												$("#imgLeft").attr("src", "__ROOT__/Style/H/images/scroll_left.gif");
												$("#spec-left").css("cursor", "pointer");
											}
											if (lilenth - leftcount < 3) {
												$("#imgRight").attr("src", "__ROOT__/Style/H/images/right_g.gif");
												$("#spec-right").css("cursor", "default");
											}
											else {
												leftpos = leftpos - 160;
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
										$("#spec-left").click(function() {
											if (lilenth - leftcount > 2) {
												$("#imgRight").attr("src", "__ROOT__/Style/H/images/scroll_right.gif");
												$("#spec-right").css("cursor", "pointer");
											}
				
											if (leftcount < 1) {
												$("#imgLeft").attr("src", "__ROOT__/Style/H/images/left_g.gif");
												$("#spec-left").css("cursor", "default");
											}
											else {
												leftpos = leftpos + 160;
												leftcount = leftcount - 1;
												$(".list-h").animate({ left: leftpos }, "slow");
												if (leftcount < 1) {
													$("#imgLeft").attr("src", "__ROOT__/Style/H/images/left_g.gif");
													$("#spec-left").css("cursor", "default");
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
									$("#spec-list").css("width", 820).css("margin-right", 8);
				
								});
				
								$(function() {
									$("#spec-list img").bind("mouseover", function() {
										$(this).css({
											"border": "2px solid #FFFFFF",
											"padding": "1px"
										});
									}).bind("mouseout", function() {
										$(this).css({
											"border": "1px solid #ccc",
											"padding": "2px"
										});
									});
								})
								</script>
                </td>
              </tr>
            </table><?php endif; ?>
          <?php else: ?>
          <p style="font-size:18px; text-align:center; line-height:3em;">借款人披露信息登陆后才可以查看！</p><?php endif; ?>
        </ul>
      </div>
      <div class="state_info_con"  id="record" style="display:none;">
        <div class="bidbox">
          <table class="bid" cellspacing="0" width="100%">
            <thead>
              <tr class="">
                <th class="" width="148">投标人</th>
                <th class="" width="148">投标类型</th>
                <th class="" width="158">投标金额</th>
                <th class="" width="198">投标时间</th>
              </tr>
            </thead>
            <tbody id="investrecord" class="tender-list">
            </tbody>
			<table>
            <tr>
            <td colspan="6"> <div class="pages" style="width:650px; margin-left:0;"><?php echo ($page); ?></div></td>
			</tr>
          </table>
          </table>
        </div>
        <div class="totalAmount posa fn-clear" id="totalAmount" style="left: 701px; ">
          <p class="f16">已投标金额</p>
          <p><em class="f24" id="total-money"><?php echo (getmoneyformt($vo["has_borrow"])); ?></em>元</p>
          <p class="f16 mt20">加入人次</p>
          <p><em class="f24" id="total-time"><?php echo (($vo["borrow_times"])?($vo["borrow_times"]):"0"); ?></em>人</p>
        </div>
        <?php if($borrow_investor_num < 2): ?><div class="clear h60"></div><div class="clear h30"></div><?php else: ?><div class="clear h30"></div><?php endif; ?>

        <div class="clear"></div>
      </div>

	  	<!-- 评论模块开始-->
	<div class="state_info_con"  id="comment" style="display:none;">
      <!-- <h3> 用户讨论 </h3> -->
        <table width="950" border="0" cellspacing="0" cellpadding="0" >
          <tr>
            <td align="center" valign="top" style=" padding-bottom:5px;" id="scomment"><?php if(is_array($commentlist)): $i = 0; $__LIST__ = $commentlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vc): $mod = ($i % 2 );++$i;?><table width="880" border="0" cellspacing="0" cellpadding="0" style=" margin-top:15px; margin-bottom:15px;">
                  <tr>
                    <td width="113" align="left" valign="top"><div class="dv_l_4_1"><img  src="<?php echo (get_avatar($vc["uid"])); ?>" /></div></td>
                    <td width="767" align="left" valign="top"><table width="740" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #CCC;">
                        <tr>
                          <td height="28" align="left" valign="top" style="color:#248DCC; font-weight:bolder; font-size:14px;"><?php echo ($vc["uname"]); ?></td>
                        </tr>
                        <tr>
                          <td height="28" align="left" valign="top" style="color:#333"><?php echo ($vc["comment"]); ?></td>
                        </tr>
                        <tr>
                          <td height="28" align="left" valign="top" style="color: #999;">发布日期：<?php echo (date("Y-m-d H:i:s",$vc["add_time"])); ?></td>
                        </tr>
                      </table>
                      <?php if($vc["deal_time"] > 0): ?><table width="740" border="0" cellspacing="0" cellpadding="0" >
                          <tr>
                            <td height="15" colspan="2" align="center" valign="top">&nbsp;</td>
                          </tr>
                          <tr>
                            <td width="74" align="center" valign="top"><img src="/Style/H/images/touxiang.jpg" width="60" height="60" /></td>
                            <td width="666" align="left" valign="top"><table width="660" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td height="28" align="left" valign="top" style="color:#248DCC; font-weight:bolder; font-size:12px;">官方回复</td>
                                </tr>
                                <tr>
                                  <td height="28" align="left" valign="top"><?php echo ($vc["deal_info"]); ?></td>
                                </tr>
                                <tr>
                                  <td height="28" align="left" valign="top" style="color: #999;">发布日期：<?php echo (date("Y-m-d H:i:s",$vc["deal_time"])); ?></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table><?php endif; ?></td>
                  </tr>
                </table>
                <div style="width:880px; height:1px; border-bottom:1px solid #CCC;"></div><?php endforeach; endif; else: echo "" ;endif; ?>
              <div class="yahoo2 ajaxpagebar" data="scomment" style="margin-left:10px"><?php echo ($commentpagebar); ?></div></td>
          </tr>
        </table>
        <table width="950" border="0" cellspacing="0" cellpadding="0" >
          <tr>
            <td height="170" align="center" valign="middle"><table width="820" border="0" cellspacing="0" cellpadding="0" height="150">
                <tr>
                  <td height="40" colspan="2" align="left" valign="middle"><strong>发表评论</strong></td>
                </tr>
                <tr>
                  <td width="701"><textarea name="comments" id="comments" cols="30" rows="4" style="width:600px; height:110px;"  ></textarea></td>
                  <td width="199"><a href="javascript:;" onclick="addComment();" class="bot09"><img src="__ROOT__/Style/H/images/comment.gif" /></a></td>
                </tr>
              </table></td>
          </tr>
        </table>
	</div>
	<!-- 评论模块结束-->


    </div>

  </div>
</div>
<script>
var ROOT_PATH="__ROOT__";
</script>
<script src="__ROOT__/Style/fancybox/jwin.js" type="text/javascript" charset="utf-8"></script>

<link href="__ROOT__/Style/fancybox/projectsp.css" rel="stylesheet" type="text/css" charset="utf-8">
<link href="__ROOT__/Style/fancybox/detail.css" rel="stylesheet" type="text/css" charset="utf-8">
<script src="__ROOT__/Style/fancybox/jquery.mousewheel-3.0.4.pack.js" type="text/javascript" charset="utf-8"></script>
<script src="__ROOT__/Style/fancybox/jquery.fancybox-1.3.4-mod.js" type="text/javascript" charset="utf-8"></script>
<link href="__ROOT__/Style/fancybox/jquery.fancybox-1.3.4-mod.css" rel="stylesheet" type="text/css" charset="utf-8" media="screen">
<script type="text/javascript">
	$(document).ready(function() {
		$("a[rel=img_group]").fancybox({
			'transitionIn'		: 'none',
			'transitionOut'		: 'none',
			'titlePosition' 	: 'over',
			'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
				return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
			}
		});
		ajax_show(1);

	});
	function ajax_show(p)
	{
	   $.get("__URL__/investRecord?borrow_id=<?php echo ($borrow_id); ?>&p="+p, function(data){
		  $("#investrecord").html(data);
	   });

	   $(".pages a").removeClass('current');
	   $(".pages a").eq(p).addClass("current");
	}

	$(function() {
		$(".borrowlist5").bind("mouseover", function(){
			$(this).css("background", "#c9edff");
		})

		$(".borrowlist5").bind("mouseout", function(){
			$(this).css("background", "#ecf9ff");
		})


		$(".borrowlist3").bind("mouseover", function(){
			$(this).css("background", "#c9edff");
		})

		$(".borrowlist3").bind("mouseout", function(){
			$(this).css("background", "#fff");
		})
	});

</script>
<input id="hid" type="hidden" value="<?php echo ($vo["lefttime"]); ?>" />
<script type="text/javascript">
	function showht(){
		var status = '<?php echo ($invid); ?>';
		if(status=="no"){
			$.jBox.tip("您未投此标");
		}else if(status=="login"){
			$.jBox.tip("请先登陆");
		}else{
			window.location.href="__APP__/member/agreement/downfile?id="+status;
		}
	}

	var seconds;
	var pers = <?php echo (($vo["progress"])?($vo["progress"]):0); ?>/100;
	var timer=null;
	function setLeftTime() {
		seconds = parseInt($("#hid").val(), 10);
		timer = setInterval(showSeconds,1000);
	}
	
	function showSeconds() {
		var day1 = Math.floor(seconds / (60 * 60 * 24));
		var hour = Math.floor((seconds - day1 * 24 * 60 * 60) / 3600);
		var minute = Math.floor((seconds - day1 * 24 * 60 * 60 - hour * 3600) / 60);
		var second = Math.floor(seconds - day1 * 24 * 60 * 60 - hour * 3600 - minute * 60);
		if (day1 < 0) {
			clearInterval(timer);
			$("#loan_time").html("投标已经结束！");
		} else if (pers >= 1) {
			clearInterval(timer);
			$("#loan_time").html("投标已经结束！");
		} else {
			$("#loan_time").html(day1 + " 天 " + hour + " 小时 " + minute + " 分 " + second + " 秒");
		}
		seconds--;
	}                
	if (pers >= 1) {
		$("#loan_time").html("投标已经结束！");
	}else{
		setLeftTime();
	}
	$(document).ready(function(){
		if($("#display2").length>0){ 
			$('#display1').show();
		}
						
	});
</script>
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
<script language="javascript" src="__ROOT__/Style/H/js/index.js"></script>
<script language="javascript" src="__ROOT__/Style/H/js/borrow.js"></script>
<script>
function invest(id){
	var flag = validate_enter(),
		num = $('#enter_value').val();
		if(!_validate_enter_flag || !flag){
			return;
		}
		
		$.jBox("get:__URL__/ajax_invest?id="+id+'&num='+num, {title: "立即投标"});
}
var investmoney = 0;
var borrowidMS = 0;
var borrow_min = 0;
var borrow_max = 0;
function PostData() {			
		money = $("#enter_value").val(),		// 输入投资金额
		borrow_id = $('#borrow_id').val(),		// 投标编号
		borrow_pass = $("#borrow_pass");		// 定向标密码
		
		if(borrow_pass.length && !borrow_pass.val()){
			$.jBox.tip("请输入定向标密码");  
			return false;
		}
		
		var flag = validate_enter();
			if(!flag){
				return;
			}
  $.ajax({
	  url: "__URL__/investcheck",
	  type: "post",
	  dataType: "json",
	  data: {"money":money,'borrow_id':borrow_id,"borrow_pass":borrow_pass.val()},
	  success: function(d) {
			  if (d.status == 1) {
			  		investmoney = money;
			  var content = '<div class="jbox-custom"><p>'+ d.message +'</p><div class="jbox-custom-button"><span onclick="$.jBox.close()">取消</span><span onclick="isinvest(true)">确定投标</span></div></div>';
			  	$.jBox(content, {title:'会员投标提示'});
			  }
			  else if(d.status == 2)// 无担保贷款多次提醒
			  {
				  var content = '<div class="jbox-custom"><p>'+ d.message +'</p><div class="jbox-custom-button"><span onclick="$.jBox.close()">取消</span><span onclick="ischarge(true)">去充值</span></div></div>';
				  	$.jBox(content, {title:'会员投标提示'});
			  }
			  else if(d.status == 3)// 无担保贷款多次提醒
			  {
				  $.jBox.tip(d.message);
			  }else{
				  $.jBox.tip(d.message);  
			  }
	  }
  });
}


// 提交支付当前要投标表单
function isinvest(d){
	if(d===true) document.forms.investForm.submit();
}
// 充值
function ischarge(d){
	if(d===true) location.href='/member/charge#fragment-1';
}

// 是否验证成功 默认不允许投钱
$('#enter_value').on('focus', function (){
	var notice = document.getElementById('jx_notice');
	notice.innerHTML = '';
	notice.className = 'jx_notice';
});

var _validate_enter_flag = false;

function validate_enter()
{
	var getId = function (ele){ return document.getElementById(ele);},
		need_max = <?php echo ($vo["need"]); ?>,
		allow_max = (<?php echo ($vo["borrow_max"]); ?> == 0 ? need_max : <?php echo ($vo["borrow_max"]); ?>),
		allow_min = <?php echo ($vo["borrow_min"]); ?>,
		notice = getId('jx_notice'),
		owner = getId('enter_value'),
		payment = getId('jx_payment');
	
		if(!owner)
		{
			return null; // 在金额输入框为禁用状态
		}
		else
		{
			value = owner.value;
		}
		
		if(isNaN(value))
		{ // 不是数字
			notice.innerHTML = '投资金额不正确，默认最小投资金额！'
			notice.className = 'jx_notice jx_error';
			payment.className = 'jx_payment';
			owner.value = allow_min;
			_validate_enter_flag = false;
		}
		else
		{
			var max = Math.min(need_max, allow_max),
				int = parseInt(value);
				if(int%allow_min != 0)
				{
					notice.innerHTML = '投资金额为起投金额的整数倍！'
					notice.className = 'jx_notice jx_error';
					owner.value = allow_min;
					_validate_enter_flag = false;
				}
				else
				{
					if(int > max){
						notice.innerHTML = '投资金额不正确，大于最多投标金额！'
						notice.className = 'jx_notice jx_error';
						owner.value = max;
						_validate_enter_flag = false;
					}else if(int < allow_min){
						notice.innerHTML = '投资金额不正确，默认最小投资金额！'
						notice.className = 'jx_notice jx_error';
						owner.value = allow_min;
						_validate_enter_flag = false;
					}else{
						_validate_enter_flag = true;
						notice.className = 'jx_notice jx_success';
						notice.innerHTML = '输入正确！';
						payment.className = 'jx_payment';
					}
				}
		}
		
		return _validate_enter_flag;
}

function bindpage(){
	$('.ajaxpagebar a').click(function(){
		try{	
			var geturl = $(this).attr('href');
			var id = $(this).parent().attr('data');
			var x={};
			$.ajax({
				url: geturl,
				data: x,
				cache: false,
				type: "get",
				dataType: "json",
				success: function (d, s, r) {
					if(d) $("#"+id).html(d.html);//更新客户端竞拍信息 作个判断，避免报错
				}
			});
		}catch(e){};
		return false;
	})
}

//添加评论
function addComment(){
	var tid = <?php echo (($vo["id"])?($vo["id"]):0); ?>;
	
	var cm = $("#comments").val();
	if(cm=="") {
		$.jBox.tip("留言内容不能为空",'tip');
		return;
	}
	$.jBox.tip("提交中......","loading");
	$.ajax({
		url: "__URL__/addcomment",
		data: {"comment":cm,"tid":tid},
		timeout: 5000,
		cache: false,
		type: "post",
		dataType: "json",
		success: function (d, s, r) {
			if(d){
				if(d.status==1){
					refreshComment();
					$.jBox.tip('留言成功');
					$("#comments").val('');
				}else{
					$.jBox.tip(d.message,'fail');
				}
			}
		}
	});
}
bindpage();
function refreshComment(){
	var geturl = "<?php echo (getinvesturl($vo["id"])); ?>?type=commentlist&id=<?php echo ($vo["id"]); ?>&p=1";
	
	var id = "scomment";
	var x={};
	
	$.ajax({
		url: geturl,
		data: x,
		timeout: 5000,
		cache: false,
		type: "get",
		dataType: "json",
		success: function (d, s, r) {
			if(d){ 
				$("#"+id).html(d.html);
			}
		}
	});
}



</script>
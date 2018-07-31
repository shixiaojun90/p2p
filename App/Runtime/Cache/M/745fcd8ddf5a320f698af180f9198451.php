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
        
	 <!---	<div class="m_banner"><a href="../tzrlapp"><img src="__ROOT__/Style/newmobile/images/tzrl_320_app.jpg" width="300" height="127" /></a></div>--->
				

     
        <div class="hot_com" style="margin-top:10px;">
            <h4>
                <a href="javascript:;" class="a_hot_title">债权转让</a></h4>
            <ul>
           <li class="liborder"> <a href="#"><img src="__ROOT__/Style/newmobile/images/zhaiquan.jpg" width="100%" height="127" /></a></li> 	
				 	
		<?php if(is_array($list["data"])): $i = 0; $__LIST__ = $list["data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vb): $mod = ($i % 2 );++$i;?><li class="liborder"><a href="index/seeinvest?id=<?php echo ($vb["id"]); ?>">
                              <table width="100%"  style="background:#fff;">
							  
							<tr>  <td colspan="3">  <dl> <dt>
                                   <?php echo (cnsubstr($vb["borrow_name"],12)); ?>
                                </dt>  </dl> </td>  </tr>  
							    <tr>
								
						
								    <td  width="70%">   <dl>
                                
                                <dd>
                                  待收本息:  ￥<?php echo (($vb["money"])?($vb["money"]):0); ?>元
                                </dd>
                   
                                <dd >
                                   借款利率:<?php echo ($vb["borrow_interest_rate"]); ?>%</php>
                                </dd>
								 <dd >
                                   转让价格:<?php echo (getmoneyformt($vb["transfer_price"])); ?>元</php>
                                </dd>
								 <dd> 
								   转让期数/总期数:<?php echo ($vb["period"]); ?>期/<?php echo ($vb["total_period"]); ?>期
								  </dd>
								
                            </dl> </td>
							
                           <td>  
		 
			
			  <?php if($vb["status"] == '2'): ?><a href="__URL__/seedebt?id=<?php echo ($vb["invest_id"]); ?>"  class="buybutton" >立刻投标</a> 
                            <?php elseif($vb["status"] == '1'): ?>
                            <a href="#" class="buybutton" >已完成</a>
							<?php elseif($vb["status"] == '4'): ?>
                          <a href="#" class="buybutton" >已停售</a><?php endif; ?>
			
			</td>

							     </tr>
							  </table>
                        
						</li><?php endforeach; endif; else: echo "" ;endif; ?>				
 
                    
            </ul>
 <div class="pagebar"> <?php echo ($list["page"]); ?>  </div><!-------分页栏目------->	
        </div>
        

<!------顶部布局开始------>		
﻿	
<div class="footer">
   
    <ul class="copyright">
        <li><a href="http://hebangjiedai.com/">电脑版</a><span><!-- |</span><a href="__ROOT__/m/linkus/">联系我们</a> --></li>
		 <li><a href="tel:4006290211">联系电话：400-106-1506</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1256061766'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/z_stat.php%3Fid%3D1256061766%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script></li>
    </ul>
</div>

 </div> <!-----控制容器结束---->  
<!-----底部布局结束----->
  </div> <!-------mainpage end------->


 <!----------底部导航菜单start------>
  	<div data-role="widget" data-widget="nav4" class="nav4">
		<nav>
			<div id="nav4_ul" class="nav_4">
				<ul class="boxheader">
					<li>
						<a href="javascript:;" class=""><span>我要投资</span></a>                
						<dl id="invest" style="border: 1px solid #ddd;">
							<dd><a href="__ROOT__/m/index/"><span>个人直投</span></a></dd>
							<div style="border-top:1px solid #DDDDDD; width:100%;height:1px;"></div>
							<dd><a href="__ROOT__/m/debt/"><span>债权转让</span></a></dd>
						</dl>
					</li>

					<li>
						<a href="javascript:;" class=""><span>我要借款</span></a>                
						<dl id="tinvest" style="border: 1px solid #ddd;">
							<dd><a href="__ROOT__/m/borrow/index/type/normal.html"><span>信用标</span></a></dd>
							<div style="border-top:1px solid #DDDDDD; width:100%;height:1px;"></div>
							<dd><a href="__ROOT__/m/borrow/index/type/vouch.html"><span>担保标</span></a></dd>
							<div style="border-top:1px solid #DDDDDD; width:100%;height:1px;"></div>
							<dd><a href="__ROOT__/m/borrow/index/type/net.html"><span>净值标</span></a></dd>
							<div style="border-top:1px solid #DDDDDD; width:100%;height:1px;"></div>
							<dd><a href="__ROOT__/m/borrow/index/type/normal.html"><span>抵押标</span></a></dd>
						</dl>
					</li>
					
					<li>
						<a href="javascript:;" class=""><span>关于贺邦</span></a>              
						<dl id="isuser" style="border: 1px solid #ddd;">
							<dd><a href="__ROOT__/m/user/"><span>我的账户</span></a></dd>
							<div style="border-top:1px solid #DDDDDD; width:100%;height:1px;"></div>
							<dd><a href="__ROOT__/m/pub/login"><span>登陆注册</span></a></dd>
							<div style="border-top:1px solid #DDDDDD; width:100%;height:1px;"></div>
							<dd><a href="__ROOT__/m/aboutus/content/id/10"><span>公司简介</span></a></dd>
							<div style="border-top:1px solid #DDDDDD; width:100%;height:1px;"></div>
							<dd><a href="__ROOT__/m/aboutus/content/id/11"><span>公司证件</span></a></dd>
							<div style="border-top:1px solid #DDDDDD; width:100%;height:1px;"></div>
							<dd><a href="__ROOT__/m/aboutus/content/id/16"><span>资费说明</span></a></dd>
							<div style="border-top:1px solid #DDDDDD; width:100%;height:1px;"></div>
							<dd><a href="__ROOT__/m/aboutus/content/id/17"><span>政策法规</span></a></dd>
						</dl>
					</li>
				</ul>
			</div>
		</nav>
      <div id="nav4_masklayer" class="masklayer_div on"> </div>
     
    </div>

	<script>
		$(function(){
			$("#nav4_ul .boxheader > li > a").each(function(){
				$(this).click(function(){
					var check = $(this).text();
					if(check == "我要投资"){
						$("#invest").toggle();
						$("#tinvest").hide();
						$("#isuser").hide();
					}else if(check == "我要借款"){
						$("#tinvest").toggle();
						$("#invest").hide();
						$("#isuser").hide();
					}else if(check == "关于贺邦"){
						$("#tinvest").hide();
						$("#invest").hide();
						$("#isuser").toggle();
					}else{
						$("#tinvest").hide();
						$("#invest").hide();
						$("#isuser").hide();
					}
				})
			})
		})
	</script>

	<script>
		function about(id){
			window.open("__APP__/m/aboutus/content/id/"+id);
		}
	</script>
 <!---------底部导航菜单end-->


</body>
</html>
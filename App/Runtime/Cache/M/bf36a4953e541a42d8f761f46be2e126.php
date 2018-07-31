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

		



		
      
	 <div class="mainpage job_content_style"  style="margin-top:10px;">	



 <div class="job_box" >
               <h1 class="d_posName"><?php echo ($vo["borrow_name"]); ?>  </h1>
              
                <div class="d_posInfo_box">
                  
                    <dl class="liborder liheight" >
                        <dt>借款金额：</dt>
                        <dd>
                           <strong>￥<?php echo (getmoneyformt($vo["borrow_money"])); ?></strong>元
                        </dd>
                    </dl>
					
                    <dl  class="liborder liheight" >
                        <dt>年化收益率：</dt>
                        <dd>
                            <strong><?php echo ($vo["borrow_interest_rate"]); ?></strong>&nbsp;%
                        </dd>
                    </dl>
					
                    <dl  class="liborder liheight" >
                        <dt>借款期限：</dt>
                        <dd>
						   <?php echo ($vo["borrow_duration"]); ?>
                           <?php if($vo["repayment_type"] == 1): ?>天
                         <?php else: ?>
                             个月<?php endif; ?>
                        </dd>
                    </dl>
                    <dl  class="liborder liheight" >
                        <dt>还款方式：</dt>
                        <dd>
                           <?php echo ($Bconfig['REPAYMENT_TYPE'][$vo['repayment_type']]); ?>
                        </dd>
                    </dl>
                    <dl  class="liborder liheight" >
                        <dt>借款用途：</dt>
                        <dd>
                          <?php echo ($gloconf['BORROW_USE'][$vo['borrow_use']]); ?>
                        </dd>
                    </dl>
                    <dl  class="liborder liheight" >
                        <dt>投标奖励：</dt>
                        <dd>
                           <?php echo ($vo["reward_num"]); ?>%
                        </dd>
                    </dl>
                    <dl  class="liborder  liheight" >
                        <dt>发布时间：</dt>
                        <dd>
                            <?php echo (date("Y-m-d H:i",$vo["add_time"])); ?>
                        </dd>
                    </dl>
                </div>
</div>
        <div class="c_menu">
            <ul>
                <li class="active"><a href="javascript:;">项目介绍</a> </li>
                <li><a href="javascript:;">借款者信息</a> </li>
                <li><a href="javascript:;">投标记录</a> </li>
            </ul>
        </div>
		
		
        <div class="job_content">
            <div class="job_box">
                <div class="d_description">
                    <h3 class="d_title">
                        项目描述</h3>
                    <div class="d_word">
                        <p>
                             <?php echo (($vo["borrow_info"])?($vo["borrow_info"]):"投资人没有添加借款说明"); ?>
                        </p>
                    </div>

					<div class="d_word">
                   <style type="text/css">.imglist{ text-align:center; margin:8px;}.imglist img{width:100%; height:300px;border:4px solid #f0f0f0;}   </style>       
					    <ul class="imglist">
                            <?php $i=0;foreach(unserialize($vo['updata']) as $v){ $i++; ?>
                            <li class="liborder"> <a href="__ROOT__/<?php echo $v['img']; ?>" title="<?php echo $v['info']; ?>" rel="img_group"> <img  title="<?php echo $v['info']; ?>" src="__ROOT__/<?php echo get_thumb_pic($v['img']); ?>"> </a> <span>
                              <?php echo $v['info']; ?>
                              </span> </li>
                            <?php } ?>
                          </ul>

					</div>
                   
					
                </div>
            </div>
			
	  <?php if($vo["need"] == 0): elseif( $time > $endtime): ?>

	    <?php else: ?>
            <div class="overlay">&nbsp;</div>
            <div class="apply_favorites">
                <button class="btn_apply"> 投标</button>
               
               
            </div><?php endif; ?>		
			
        </div>
		
		
        <div class="job_content hide">
		 <?php if($UID > '0'): ?><div class="job_box">
                <h1 class="d_posName">
                    <?php echo ($minfo["user_name"]); ?>&nbsp;<?php echo (getleveico($minfo["credits"],2)); ?>   
                </h1>
                <div class="d_posInfo_box" style="display:none">
                   <dl class="liborder liheight" >
                        <dt>月收入(元)：</dt>
                        <dd>
                            <?php echo (getmoneyformt($minfo["fin_monthin"])); ?>
                        </dd>
                    </dl>


                    <dl  class="liborder liheight" >
                        <dt>邮箱：</dt>
                        <dd>
                           <?php echo (($minfo["user_email"])?($minfo["user_email"]):"未填写"); ?>
                        </dd>
                    </dl>
                    <dl class="liborder liheight" >
                        <dt>所属客服：</dt>
                        <dd>
                             <?php echo (($minfo["customer_name"])?($minfo["customer_name"]):"未指定"); ?>
                        </dd>
                    </dl>
					
					<dl  class="liborder liheight" >
                        <dt>是否购车：</dt>
                        <dd>
                             <?php echo (($minfo["fin_car"])?($minfo["fin_car"]):"未填写"); ?>
                        </dd>
                    </dl>
					
					<dl  class="liborder liheight">
                        <dt>是否购车：</dt>
                        <dd>
                             <?php echo (($minfo["fin_car"])?($minfo["fin_car"]):"未填写"); ?>
                        </dd>
                    </dl>
					
                </div>
                <div class="d_description">
                    <h3 class="d_title">
                         账号信息</h3>
                    <div class="d_word">
                          <ul>
						    <li class="liheight lifloat"> 资产总额 ：<?php echo (getmoneyformt($minfo["zcze"])); ?></li> 
							<li class="liheight lifloat"> 待还总额：<?php echo (getmoneyformt($capitalinfo["tj"]["dhze"])); ?>  </li> 
							<li class="liheight lifloat"> 已还总额：<?php echo (getmoneyformt($capitalinfo["tj"]["yhze"])); ?> </li>
							<li class="liheight lifloat"> 借出本金：<?php echo (getmoneyformt($capitalinfo["tj"]["jcze"])); ?> </li>
							<li class="liheight lifloat"> 待收总额：<?php echo (getmoneyformt($capitalinfo["tj"]["dsze"])); ?> </li>
							<li class="liheight lifloat"> 回款总额：<?php echo (getmoneyformt($capitalinfo["tj"]["ysze"])); ?> </li>
							<li class="liheight lifloat"> 负债情况：
                                    <?php if($capitalinfo['tj']['fz'] < 0): ?>(<?php echo (getmoneyformt($capitalinfo["tj"]["fz"])); ?>)
                                         <?php else: ?>
                                         (<?php echo (getmoneyformt($capitalinfo["tj"]["fz"])); ?>)<?php endif; ?>
							</li>
							<li class="liheight lifloat"> 信用额度：<?php echo (getmoneyformt($mainfo["credit_limit"])); ?> </li>
						 </ul>
						<div style="clear:both"> </div>
                    </div>
                    <h3 class="d_title">
                       还款信用</h3>
                       	
						<div class="d_word" >
                                <ul> 
							         <li class="liheight lifloat"> 成功借款次数：<?php echo (($capitalinfo["tj"]["jkcgcs"])?($capitalinfo["tj"]["jkcgcs"]):0); ?>次 </li>
									 <li class="liheight lifloat"> 正常还款次数：<?php echo (($capitalinfo["repayment"]["1"]["num"])?($capitalinfo["repayment"]["1"]["num"]):0); ?>次 </li>
									 <li class="liheight lifloat"> 迟还次数：<?php echo (($capitalinfo["repayment"]["3"]["num"])?($capitalinfo["repayment"]["3"]["num"]):0); ?>次 </li>
									 <li class="liheight lifloat">提前还款次数：<?php echo (($capitalinfo["repayment"]["2"]["num"])?($capitalinfo["repayment"]["2"]["num"]):0); ?>次  </li>
									 <li class="liheight lifloat"> 网站代还次数：<?php echo (($capitalinfo["repayment"]["4"]["num"])?($capitalinfo["repayment"]["4"]["num"]):0); ?>次 </li>
									 <li class="liheight lifloat">逾期还款笔数：<?php echo (($capitalinfo["repayment"]["5"]["num"])?($capitalinfo["repayment"]["5"]["num"]):0); ?>次</li>
									 
				               </ul>
							   <div style="clear:both"> </div>
					    </div>
						
                </div>
            </div>
          <?php else: ?>
            <ul><li> </li>&nbsp;&nbsp;登录后才可以查看 </ul><?php endif; ?>

        </div>
		
		
        <div class="job_content hide">
            <div class="job_box">
                <div class="p_list">
				
	<!------------投资记录start----------->
                      <!--realrecod start-->
					    <div id="recordcontent"> </div>
	           <div  style="clear:both;height:20px;"> </div>
           <div class="recordemore"><a href="#">更&nbsp;&nbsp;多</a> <span id="pnum" style="display:none;"> </span></div>
	<!-----------投资记录end----------->	
                </div>
            </div>
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
    $(function(){
			  
	//实现选项卡..................	      
    $(".c_menu ul li").click(function(){
            $(".active").removeClass("active"); 
            $(this).addClass("active"); 
            
            $(".job_content").hide();
            $(".job_content").eq($(".c_menu ul li").index($(this))).show();
            
      
        });
       
     });
    </script>  
 
 <script type="text/javascript">
   $(function(){
     
	 investrecord(1);
         
   })
</script> 
<script type="text/javascript" >
 function investrecord($p){
         var id=<?php echo ($vo["id"]); ?>;
         $.getJSON('__URL__/investrecord',{p:$p,id:id},function(json){
            if(json.status==1)
			 {
			    $("#recordcontent").append(json.data);
				$("#pnum").html(json.info);
			 }else{
			    $("#recordcontent").html(json.data); 
			   }
			     
		});
 
 }
</script>

<script type="text/javascript">
  $(function(){
     $(".recordemore a").click(function(){
	    var pnum=$(".recordemore span").html();
		 if(pnum=="" || pnum==null)
		  {
		    $(".recordemore a").html("没有更多了");
		  }else{
		     pnum++;
		     investrecord(pnum);
		  
		  }
	 
	 });
  
  })
</script> 
<script type="text/javascript">
  $(function(){
      $(".btn_apply").click(function(){
	     location.href='__URL__/buyinvest?bid=<?php echo ($vo["id"]); ?>';
	  
	  });
  
  
  })
   
</script>
	
</body>
</html>
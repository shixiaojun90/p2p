<?php if (!defined('THINK_PATH')) exit();?>    <style type="text/css">
.clear { clear: both; }
.mt0 { margin-top: 0 !important; }
.box_head { width: 766px; }
.box_head_t01 { height: 32px; line-height: 32px; background: url(box_head.gif) 10px -514px no-repeat #f6f6f6; font-weight: bold; padding-left: 30px; }
.box_head_info { padding: 10px 50px; }
.box_head_info p { line-height: 30px; }
.box_head_main { padding: 0 24px; }
.box_head_main_HEADER { width: 177px; height: 194px; padding: 10px 1px; border: 1px solid #dbdbdb; border-right: none 0; background: #f7f7f7; float: left; }
.dqtx { height: 25px; background: #fff; line-height: 25px; padding-left: 10px; text-align: left; text-indent: 15px; }

.dqtx_img { width: 136px; height: 136px; padding: 5px; overflow: hidden; margin: 10px auto 0 auto; }

.box_head_main_content { float: left; border: 1px solid #dbdbdb; width: 603px; padding: 0px 0px 10px 0px; }
.box_head_t02 { height: 25px; line-height: 25px; margin: 10px 2px 10px; background: #f7f7f7; padding-left: 10px; text-align: left; text-indent: 15px; }
.box_head_hlist_main { float: left; width: 450px; overflow: hidden; padding-left: 20px; text-align: left;   _padding-left: 16px;  }
.box_head_hlist_main a { float: left; display: block; display: inline; width: 60px; height: 60px; padding: 4px; overflow: hidden; background-image: url(__ROOT__/Style/H/images/bam_head.jpg); margin: 10px; }
.box_head_hlist_main a img { width: 60px; height: 60px; }
.box_head_more { float: right; width: 28px; padding:5px 13px; padding-top:6px; border-left: 2px #ccc solid; }
.box_head_more a { float: left; display: block; width: 23px; height: 23px;   line-height:23px;
                   background-image: url(__ROOT__/Style/H/images/ym02.jpg);
                  background-repeat:no-repeat;display: inline; margin: 5px 0px; margin-left:1px;  }

.box_head_more a.current,.box_head_more a:hover{ background-image: url(__ROOT__/Style/H/images/ym01.jpg); color:#fff; font-weight:bold; }      
.viewbk { width: 140px; height: 140px; padding: 3px; overflow: hidden; background: url(box_head.gif) 0 0 no-repeat; }
.box_head_file { text-align: left; vertical-align: top; padding: 10px 34px; }
.box_head_bt01, .box_head_bt02 { margin: 0 0 10px 20px; }
    </style>
<div style="padding: 10px 50px; text-align: left; line-height: 22px;">
	<p>
		1、用户头像能直观的向其他用户展示自己，推荐使用真实照片以作为头像，也可以使用系统推荐头像。</p>
	<p>
		2、使用上传图片时请不要小于200 * 200 像素，不要大于512KB。</p>
</div>
<div style="width: 785px; margin: 10px auto;">
	<div class="box_head_main_HEADER">
		<div class="dqtx">
			当前头像</div>
		<div class="dqtx_img" style="background-image: url(__ROOT__/Style/H/images/bav_head.jpg)">
			<img src="<?php echo (get_avatar($UID)); ?>" style="width: 136px; height: 136px;" alt=""></div>
	</div>
	<div class="box_head_main_content">
		<div class="box_head_t02">上传头像</div>
		<div class="sctx">
			<table style="text-align: left; float: left;" border="0" cellpadding="0" cellspacing="0">
				<tbody><tr>
					<td style="height: 223px; padding: 0px 69px;" valign="top">
					<iframe  style="border-top:#ccc solid 1px;" width="450px" scrolling="no" height="485px" frameborder="0" marginwidth="0" marginheight="0" src="__ROOT__/member/index/memberheaderuplad/?uid=<?php echo ($UID); ?>"></iframe>
					</td>
				</tr>
			</tbody></table>
		</div>
	</div>
</div>
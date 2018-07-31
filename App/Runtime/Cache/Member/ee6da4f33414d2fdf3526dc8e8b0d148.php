<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
.add-card{margin:0 auto;width:232px;}.add-card a:hover{border:1px dashed #8599B2;background:#DFEEF7;-webkit-transition:all 0.15s ease-in;transition:all 0.15s ease-in;}.add-card .iconfont{display:block;margin:0 auto;vertical-align:-5px;font-size:30px;color:#A8B5C4;cursor:pointer;}.add-card a,.add-card a:visited{display:block;overflow:hidden;zoom:1;height:112px;padding:48px 0 0 0;text-align:center;text-decoration:none;border-radius:4px;font-weight:700;border:1px dashed #AACCDD;background:#FAFAFB;outline:none;cursor:pointer;-webkit-transition:all 0.15s ease-in;transition:all 0.15s ease-in;}bankList.htmmedia="screen".add-card a,.add-card a:visited{display:block;overflow:hidden;zoom:1;height:112px;padding:48px 0 0 0;text-align:center;text-decoration:none;border-radius:4px;font-weight:700;border:1px dashed #AACCDD;background:#FAFAFB;outline:none;cursor:pointer;-webkit-transition:all 0.15s ease-in;transition:all 0.15s ease-in;}/** 绑定银行卡 **/.bank-bind-brief{margin:0 auto;width:231px;z-index:100;border:3px solid rgba(175,178,183,0.25);border-radius:7px;}.bank-bind-brief .bank-bind-logo{position:relative;padding:10px 0 0 15px;border-radius:4px 4px 0 0;border:1px solid #B6B9BE;border-bottom:none;background:#fff;}.bank-bind-brief .bank-bind-logo img{display:block;}.bank-bind-brief .bank-bind-logo .card-type-DC{background:url(https://i.alipayobjects.com/e/201305/MbrAtHLGP.png) no-repeat left top;}.bank-bind-account{font-size:14px !important;padding-bottom:10px;}.bank-bind-brief .bank-bind-name{padding:7px 5px 7px 15px;background:#FAFAFA;border:1px solid #B6B9BE;border-top:1px dashed #B6B9BE;color:#999999;border-radius:0 0 4px 4px;}.bank-bind-brief .bank-bind-logo .card-type{position:absolute;top:10px;right:10px;overflow:hidden;width:49px;height:18px;text-indent:-9999px;}
</style>
<?php if($vobank['bank_num'] == ''): ?><div class="add-card J-add-card">
	<a href="/member/bank#fragment-2" seed="zht_click_ZBAGAC_TJYH" target="_blank"><i class="iconfont"></i>添加银行卡</a>
</div>
<?php else: ?>
<br/> 
<div class="bank-bind-brief">
	<div class="bank-bind-logo">
		<img alt="<?php echo ($bank[$vobank['bank_name']]); ?>" src="/style/M/bank/<?php echo ($vobank['bank_name']); ?>.png" width="135" height="40" seed="bankBindLogo-iE201305Pocdh6pzr" smartracker="on">
		<span class="card-type card-type-DC">储蓄卡</span>
		<span class="bank-bind-account"><?php echo (hidecard($vobank["bank_num"],3)); ?></span>
		<div class="bank-bind-account" >
				&nbsp;                        
		</div>
	</div>
	<div class="bank-bind-name">
		<div class="hotline">
			开户人：<?php echo ($voinfo["real_name"]); ?>
		</div>
	</div>
</div><?php endif; ?>
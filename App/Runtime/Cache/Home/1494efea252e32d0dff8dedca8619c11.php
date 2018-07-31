<?php if (!defined('THINK_PATH')) exit();?><form class="ajax-invest" method="post" name="investForm" id="investForm" action="__URL__/investmoney">
	<input type="hidden" name="borrow_id" id="borrow_id" value="<?php echo ($vo["id"]); ?>" />
	<input type="hidden" name="money" id="money" value="<?php echo ($investMoney); ?>" />
    <ul class="item">
			    
				<?php if(!empty($vo['password'])): ?><li>
					<h6>定向标密码</h6>
					<input type="password" id="borrow_pass" name="borrow_pass" />
				</li><?php endif; ?>
				<li>
					<div>
					<a href="javascript:void(0);"  id="ceshi"  class="center" onclick="PostData()">立即投资</a>
					</div>
				</li>
			
	</ul>
</form>
<script type="text/javascript">
borrow_min = <?php echo (($vo["borrow_min"])?($vo["borrow_min"]):0); ?>;
borrow_max = <?php echo (($vo["borrow_max"])?($vo["borrow_max"]):0); ?>;
</script>
<?php if(empty($vo['password'])): ?><script type="text/javascript">
		$(".jbox-container").hide();
		$(".jbox-body").hide();
		$("#ceshi").click();
   </script><?php endif; ?>
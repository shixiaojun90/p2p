<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
.msgbox{padding:20px; line-height:25px; text-indent:20px; width:500px}
</style>
<div class="msgbox">

<?php echo ($msg); ?>

</div>
<script type="text/javascript">
var mid = "<?php echo ($mid); ?>";
$("#msg_"+mid).find("img").attr("src",readimg);
</script>
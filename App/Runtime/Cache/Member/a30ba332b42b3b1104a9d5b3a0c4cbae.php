<?php if (!defined('THINK_PATH')) exit();?><style type="text/css">
  .dv_header_8 { background-image: url(); }
.tdTitle { text-align: center; padding-left: 10px; font-size: 12px; height: 40; line-height: 40px; vertical-align: middle; width: 160px; font-weight: bold; background-color: #F9F9F9; border: #ccc solid 1px; }
.tdContent { text-align: left; padding-left: 10px; font-size: 12px; height: 40; height: 28px; vertical-align: middle; border: #ccc solid 1px; text-align: center; }
.fontred { color: #005B9F; }
.grayfont { color: #666; }
.grayfont span { color: #000; }
#buylist li { width: 112px; height: auto; overflow: hidden; text-align: center; float: left; margin: 20px 10px; }
.tdContent1 { text-align: left; padding-left: 10px; font-size: 12px; height: 40; line-height: 40px; vertical-align: middle; width: 535px; }
#pager { padding-right: 0px; }
.numRed { color: #FF0000; font-weight: bold; }
.numRedNormal { color: #FF0000; }
.dv_account_0 { margin-top: 10px; }
.mouseOn { border: solid 1px #ff9933; }
.mouseOut { border: solid 1px #e3e1d4; }
</style>
<script type="text/javascript">
$(function() {
	$("div table.mouseOut").mousemove(function() {
		$(this).addClass("mouseOn").removeClass("mouseOut");
	}).mouseout(function() { $(this).removeClass("mouseOn").addClass("mouseOut"); });
});
</script>
<div style="padding:0px 20px 5px 20px; text-align: left;">
  <table class="mouseOut" cellpadding="0" cellspacing="0">
    <tbody>
      <tr>
        <td style="width: 160px; text-align: right; background-color:#f6f6f6;"><a href="javascript:;" onclick="$('#x2').click();"> <img alt="" src="__ROOT__/Style/M/images/account/changshangdai1.jpg"></a> </td>
        <td style="width: 530px; padding-left: 10px;"><table style="width: 100%; height: 100%; line-height: 18px;">
            <tbody>
              <tr>
                <td colspan="2"> 您当前的普通标自动投标设置为： </td>
              </tr>
              <tr id="trLongNone">
                <td><?php if($vo["id"] > '0'): if($vo["interest_rate"] == '0'): else: ?>
                      最低利率≥ <font color="#000"><?php echo ($vo["interest_rate"]); ?> </font>%；<?php endif; ?>
                    <?php if($vo["duration_from"] == '0'): else: ?>
                      借款周期在 <font color="#000"><?php echo ($vo["duration_from"]); ?></font> 月到 <font color="#000"><?php echo ($vo['duration_to']%180); ?> </font>月；<?php endif; ?><!-- `mxl:autoday` -->
					  <?php if($vo["duration_to"] > '179'): ?>包括天标；<?php endif; ?><!-- `mxl:autoday` -->
                    <?php if($vo["account_money"] == '0'): else: ?>
                      账户余额≥ <font color="#000"><?php echo ($vo["account_money"]); ?> </font>元；<?php endif; ?>
                    <?php if($vo["invest_money"] == '0'): ?>自动满标
                      <?php else: ?>
                      投标每次等于 <font color="#000"><?php echo ($vo["invest_money"]); ?> </font>元；<?php endif; ?>
                    <?php if($vo["end_time"] == '0'): else: ?>
                      自动投标设置于 <font color="#000"><?php echo (date("Y-m-d",$vo["end_time"])); ?> </font>自动取消；<?php endif; endif; ?><br/>&nbsp;
				<?php if($vo["is_use"] == '1'): ?><p style="font-size:14px; line-height:14px;color:#006600;">您的前面还有<?php echo (($num)?($num):"0"); ?>位正在排队，您当前是第<font style=" color:#FF0000;"><?php echo ($now); ?></font>位</p><?php endif; ?>
                </td>
                <td style="text-align: right; padding-right: 30px; vertical-align: top; "><a href="javascript:;" onclick="$('#x2').click();"> <img src="__ROOT__/Style/M/images/account/edit.jpg"></a> </td>
              </tr>
            </tbody>
          </table></td>
      </tr>
    </tbody>
  </table>
</div>


<div style="padding: 5px 20px 20px 20px; text-align: left;">
<table class="mouseOut" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td style="width: 160px; text-align: right;"><a href="javascript:;" onclick="$('#x3').click();"> <img alt="" src="__ROOT__/Style/M/images/account/qiyeauto.jpg"></a> </td>
      <td style="width: 530px; padding-left: 10px;"><table style="width: 100%; height: 100%; line-height: 18px;">
          <tbody>
            <tr>
              <td colspan="2"> 您当前的企业直投自动投标设置为： </td>
            </tr>
            <tr id="tr1">
              <td><?php if($vot["id"] > '0'): if($vot["interest_rate"] == '0'): else: ?>
                    最低利率≥ <font color="#000"><?php echo ($vot["interest_rate"]); ?> </font>%；<?php endif; ?>
                  <?php if($vot["duration_from"] == '0'): else: ?>
                    借款周期在 <font color="#000"><?php echo ($vot["duration_from"]); ?></font> 月到 <font color="#000"><?php echo ($vot['duration_to']%180); ?> </font>月；<?php endif; ?><!-- `mxl:autoday` -->
					  <?php if($vot["duration_to"] > '179'): ?>包括天标；<?php endif; ?><!-- `mxl:autoday` -->
                  <?php if($vot["account_money"] == '0'): else: ?>
                    账户余额≥ <font color="#000"><?php echo ($vot["account_money"]); ?> </font>元；<?php endif; ?>
                  <?php if($vot["invest_money"] == '0'): ?>自动满标
                    <?php else: ?>
                    投标每次等于 <font color="#000"><?php echo ($vot["invest_money"]); ?> </font>元；<?php endif; ?>
                  <?php if($vot["end_time"] == '0'): else: ?>
                    自动投标设置于 <font color="#000"><?php echo (date("Y-m-d",$vot["end_time"])); ?> </font>自动取消；<?php endif; endif; ?><br/>&nbsp;
				<?php if($vot["is_use"] == '1'): ?><p style="font-size:14px; line-height:14px;color:#006600;">您的前面还有<?php echo (($tnum)?($tnum):"0"); ?>位正在排队，您当前是第<font style=" color:#FF0000;"><?php echo ($tnow); ?></font>位</p><?php endif; ?>
              </td>
              <td style="text-align: right; padding-right: 30px; vertical-align: top; padding-top: 9px;"><a href="javascript:;" onclick="$('#x2').click();"> <img src="__ROOT__/Style/M/images/account/edit.jpg"></a> </td>
            </tr>
          </tbody>
        </table>
		</td>
    </tr>
  </tbody>
</table>
</div>

<div style="padding: 5px 20px 20px 20px; text-align: left;">
<table class="mouseOut" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td style="width: 160px; text-align: right;"><a href="javascript:;" onclick="$('#x3').click();"> <img alt="" src="__ROOT__/Style/M/images/account/dingtouauto.jpg"></a> </td>
      <td style="width: 530px; padding-left: 10px;"><table style="width: 100%; height: 100%; line-height: 18px;">
          <tbody>
            <tr>
              <td colspan="2"> 您当前的定投宝自动投标设置为： </td>
            </tr>
            <tr id="tr1">
              <td><?php if($vod["id"] > '0'): if($vod["interest_rate"] == '0'): else: ?>
                    最低利率≥ <font color="#000"><?php echo ($vot["interest_rate"]); ?> </font>%；<?php endif; ?>
                  <?php if($vod["duration_from"] == '0'): else: ?>
                    借款周期在 <font color="#000"><?php echo ($vod["duration_from"]); ?></font> 月到 <font color="#000"><?php echo ($vod['duration_to']%180); ?> </font>月；<?php endif; ?><!-- `mxl:autoday` -->
					  <?php if($vod["duration_to"] > '179'): ?>包括天标；<?php endif; ?><!-- `mxl:autoday` -->
                  <?php if($vod["account_money"] == '0'): else: ?>
                    账户余额≥ <font color="#000"><?php echo ($vot["account_money"]); ?> </font>元；<?php endif; ?>
                  <?php if($vod["invest_money"] == '0'): ?>自动满标
                    <?php else: ?>
                    投标每次等于 <font color="#000"><?php echo ($vot["invest_money"]); ?> </font>元；<?php endif; ?>
                  <?php if($vod["end_time"] == '0'): else: ?>
                    自动投标设置于 <font color="#000"><?php echo (date("Y-m-d",$vot["end_time"])); ?> </font>自动取消；<?php endif; endif; ?><br/>&nbsp;
				<?php if($vod["is_use"] == '1'): ?><p style="font-size:14px; line-height:14px;color:#006600;">您的前面还有<?php echo (($tnum)?($tnum):"0"); ?>位正在排队，您当前是第<font style=" color:#FF0000;"><?php echo ($dnow); ?></font>位</p><?php endif; ?>
              </td>
              <td style="text-align: right; padding-right: 30px; vertical-align: top; padding-top: 9px;"><a href="javascript:;" onclick="$('#x2').click();"> <img src="__ROOT__/Style/M/images/account/edit.jpg"></a> </td>
            </tr>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>
</div>


<div style="height: 20px; width: 720px; margin: 0 auto; border-top: solid 1px #e3e1d4;"> &nbsp; </div>
<div style="padding: 0 20px 20px 20px;" id="cont_safe">
  <div style="text-align: left; padding-left: 20px;">
    <div style="overflow: hidden;"> <img alt="" src="__ROOT__/Style/M/images/minilogo.gif"> <strong><?php echo ($glo["web_name"]); ?>自动投标设置规则说明：</strong> </div>
    <div style="line-height: 24px; padding: 0 25px; margin-top: 10px;color:#900000">
      <table>
        <tbody>
          <tr>
            <td> 1、 </td>
            <td> 单笔借出金额最小投资金额为50元，最大投资金额必须大于或等于200元。 </td>
          </tr>
          <tr>
            <td style="vertical-align: top;"> 2、 </td>
            <td> 设置的自动投标金额<=可用金额-账户保留金额，否则不能自动投标。 </td>
          </tr>
          <!--tr>
            <td style="vertical-align: top;"> 3、 </td>
            <td> 每次自动投标的金额需<=所投标额的10%，若超出，投标金额就是所投标额度的10%.<br/>例如:您设置自动投标金额为3万，如果有借款人借款20万，那么您最高投标金额为2万。 </td>
          </tr-->
        </tbody>
      </table>
    </div>
  </div>
</div>

<div style="clear: both;">
  <div style="padding: 0 20px 20px 20px;" id="cont_safe">
    <div style="text-align: left; padding-left: 20px;">
      <div style="overflow: hidden;"> <img alt="" src="__ROOT__/Style/M/images/minilogo.gif"> <strong><?php echo ($glo["web_name"]); ?>自动投标排序规则说明：</strong> </div>
      <div style="line-height: 24px; padding: 0 25px; margin-top: 10px;">
        <table>
          <tbody>
            <tr>
              <td> 1、 </td>
              <td> 投标顺序按照开启自动投标功能的时间先后进行排序。 </td>
            </tr>
            <tr>
              <td style="vertical-align: top;"> 2、 </td>
              <td> 每个会员每个借款仅自动投标一次，投标成功后，排到所有自动投标会员的末尾。 </td>
            </tr>
            <tr>
              <td style="vertical-align: top;"> 3、 </td>
              <td> 中间对自动投标进行修改的，排名不变。 </td>
            </tr>
            <tr>
              <td style="vertical-align: top;"> 4、 </td>
              <td> 新开启自动投标用户，自动排到所有自动投标会员的末尾。 </td>
            </tr>
            <tr>
              <td style="vertical-align: top;"> 5、 </td>
              <td> 当账户余额不足时，系统按顺序进行，但不投标，依次转移到下一个自动投标。 </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div style="clear: both;"> </div>
</div>
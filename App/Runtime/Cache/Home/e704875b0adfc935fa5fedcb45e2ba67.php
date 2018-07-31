<?php if (!defined('THINK_PATH')) exit();?>

<?php if(is_array($commentlist)): $i = 0; $__LIST__ = $commentlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><table width="880" border="0" cellspacing="0" cellpadding="0" style=" margin-top:15px; margin-bottom:15px;">
              <tr>
                <td width="113" align="left" valign="top"><div class="dv_l_4_1"><img  src="<?php echo (get_avatar($vo["uid"])); ?>" /></div></td>
                <td width="767" align="left" valign="top">
                <table width="740" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #CCC;">
                  <tr>
                    <td height="28" align="left" valign="top" style="color:#248DCC; font-weight:bolder; font-size:14px;"><?php echo ($vo["uname"]); ?></td>
                  </tr>
                  <tr>
                    <td height="28" align="left" valign="top" style="color:#333"><?php echo ($vo["comment"]); ?></td>
                  </tr>
                  <tr>
                    <td height="28" align="left" valign="top" style="color: #999;">发布日期：<?php echo (date("Y-m-d H:i:s",$vo["add_time"])); ?></td>
                  </tr>
                </table>
                <?php if($vo["deal_time"] > 0): ?><table width="740" border="0" cellspacing="0" cellpadding="0" >
  <tr>
    <td height="15" colspan="2" align="center" valign="top">&nbsp;</td>
    </tr>
  <tr>
    <td width="74" align="center" valign="top"><img src="/Style/H/images/touxiang.jpg" width="60" height="60" /></td>
    <td width="666" align="left" valign="top"><table width="660" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="28" align="left" valign="top" style="color:#248DCC; font-weight:bolder; font-size:12px;"><?php echo ($glo["web_name"]); ?>客服</td>
      </tr>
      <tr>
        <td height="28" align="left" valign="top"><?php echo ($vo["deal_info"]); ?></td>
      </tr>
      <tr>
        <td height="28" align="left" valign="top" style="color: #999;">发布日期：<?php echo (date("Y-m-d H:i:s",$vo["deal_time"])); ?></td>
      </tr>
    </table></td>
  </tr>
</table><?php endif; ?>
                </td>
              </tr>
            </table>
            <div style="width:880px; height:1px; border-bottom:1px solid #CCC;"></div><?php endforeach; endif; else: echo "" ;endif; ?>

<div class="yahoo2 ajaxpagebar" data="scomment" style="margin-left:10px"><?php echo ($commentpagebar); ?></div>
<script type="text/javascript">bindpage()</script>
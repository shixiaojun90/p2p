<?php if (!defined('THINK_PATH')) exit();?><table style=" margin:10px; font-size:12px; text-align:left; line-height:24px;" id="tips">
<tbody>
<tr>
	<td colspan="2"><div smsdata="email" style="display:inline; margin:10px;">邮箱</div><div smsdata="phone" style="display:inline; margin:10px;">短信</div></td><!-- 增加短信选项、增加切换功能`mxl 20150121` -->
</tr>
<tr class="email"><!-- 增加class="email"`mxl 20150120` -->
	<td style=" padding-top:10px;" colspan="2"><input type="text" id="emailname" style="width:200px; height:25px; line-height:25px" />
	<span style="color:darkslategray; cursor:pointer; margin-left:20px;" onclick="jfun_dogetpass();">发送邮件</span></td>
</tr>
<tr class="email"><!-- 增加class="email"`mxl 20150120` -->
	<td colspan="2">请输入您在<?php echo ($glo["web_name"]); ?>的用户名或邮件，我们会向您的邮箱发送一个重置密码的链接<br />请您按邮件中提示重置密码。</td>
</tr>
<!-- `mxl 20150120` -->
<tr class="phone"><td>用户名称：</td><td width="300px"><input type="text" id="username" style="width:150px; height:25px; line-height:25px; margin:5px 0;" maxlength="16" /></td></tr>
<tr class="phone"><td>手机号码：</td><td><input type="text" id="phonenum" style="width:150px; height:25px; line-height:25px; margin:5px 0;" maxlength="11" />
	<span style="color:darkslategray; cursor:pointer; margin-left:20px;" onclick="getPassByPhone('test',$(this));" id="sendrecode">发送验证码</span></td></tr>
<tr class="phone"><td>验证码&nbsp;&nbsp;&nbsp;：</td><td><input type="text" id="phonecode" style="width:150px; height:25px; line-height:25px; margin:5px 0;" maxlength="12" />
	<span style="color:darkslategray; cursor:pointer; margin-left:20px;" onclick="getPassByPhone('edit',$(this));">发送临时密码</span></td></tr>
<!-- <tr class="phone"><td colspan="2"><div></div></td></tr> -->

<!-- <tr class="phone"><td colspan="2"><sub>原来的密码将被更改，如不确定手机的短信接收功能是否有效，可先进行短信接收测试</sub></td></tr> -->
<!-- `mxl 20150120` -->
</tbody></table>
<!-- `mxl 20150120`start -->
<script type="text/javascript">
	var secRecode=60;
	$(document).ready(function(){
		$("[smsdata]").each(function(){
			$(this).css("cursor","pointer");
			$(this).unbind("click");
			$(this).bind("click",function(){
				$("[smsdata]").each(function(){ $("."+$(this).attr("smsdata")).hide(); $(this).css("color","gray"); });
				$(this).css("color","red");
				$("."+$(this).attr("smsdata")).show();
			});
		});
		$("[smsdata='email']").trigger("click");
	});
	function timerRecode(){
		var o=$("#sendrecode");
		secRecode=secRecode-1;
		o.attr("disabled",true);
		o.text(secRecode);
		if (1>secRecode){
			o.text("发送验证码");
			o.attr("disabled",false);
			secRecode=60;
		}
		else{ setTimeout(timerRecode,1000); }
	}
	function getPassByPhone(mode,o){
		$.ajax({
			url: "__URL__/getPassByPhone",
			data: {"uname":$("#username").val(),"phone":$("#phonenum").val(),"code":$("#phonecode").val(),"mode":mode},
			timeout: 5000,
			cache: false,
			type: "get",
			dataType: "json",
			success: function (d, s, r) {
				if(d){
					if(d.status==1){
						$.jBox.tip(d.message);
						$.jBox.close();
					}
					else if(d.status==2){
						if (mode==="test"){
							secRecode=60;
							o.attr("disabled",true);
							setTimeout(timerRecode,1000);
						}
						$.jBox.tip(d.message, "warning");
					}
					else{ $.jBox.tip(d.message,"error"); }
				}
			}
		});
	}
</script>
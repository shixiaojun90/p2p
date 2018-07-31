function Blurphone(obj) {
	var id = $(obj).attr("id");
   var txt = "#"+id;
    var td = "#dv"+id;
    var pat = new RegExp("^(13|15|18|14)[0-9]{9}$");
    var str = $(txt).val();
    if (pat.test(str)) {
        $(td).html(GetP("reg_info", "<img style='margin:2px;' src='"+imgpath+"images/zhuce3.gif'/>&nbsp;手机号码格式正确！"));
    }
    else {
        $(td).html(GetP("reg_wrong", "<img style='margin:2px;' src='"+imgpath+"images/zhuce2.gif'/>&nbsp;手机号码格式错误！"));
    }
}

//验证中文名称
function Cn_name(obj) {
	var id = $(obj).attr("id");
   var txt = "#"+id;
    var td = "#dv"+id;
    var pat = new RegExp("^[\u2E80-\uFE4F]+$");
    var str = $(txt).val();
	if (pat.test(str)) {
        $(td).html(GetP("reg_info", "<img style='margin:2px;' src='"+imgpath+"images/zhuce3.gif'/>&nbsp;联系人格式正确！"));
	}else {
        $(td).html(GetP("reg_wrong","<img style='margin:2px;' src='"+imgpath+"images/zhuce2.gif'/>&nbsp;联系人格式错误！"));
    }
}

//返回数字
function NumberCheck(t){
	var num = t.value;
	var re=/^\d*$/;
	if(!re.test(num)){
		isNaN(parseInt(num))?t.value=0:t.value=parseInt(num);
	}
}



function GetP(clsName, c) { return "<div class='" + clsName + "'>" + c + "</div>"; }


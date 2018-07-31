function mysubmit(){
		//alert(vkev);
		var borrow_name = $("#borrow_name").val();//借款标题
		var borrow_money = $("#borrow_money").val();//借款金额
		var borrow_interest_rate = $("#borrow_interest_rate").val();//年化利率
		var borrow_use = $("#borrow_use").val();//借款用途
		var borrow_duration = $("#borrow_duration").val();//借款期限
		var borrow_min = $("#borrow_min").val();//投标金额
		var borrow_max = $("#borrow_max").val();//投标总额
		var borrow_time = $("#borrow_time").val();//有效时间
		var repayment_type = $("#repayment_type").val();//还款方式
		var borrow_info = $("#borrow_info").val();//借款说明

		if(borrow_name == ""){
			$("#fadeautomess").html("借款标题不能为空");
			errors();
			return false;
		}

		if(borrow_money == ""){
			$("#fadeautomess").html("借款金额不能为空");
			errors();
			return false;
		}

		if(borrow_interest_rate == ""){
			$("#fadeautomess").html("年化利率不能为空");
			errors();
			return false;
		}

		if(borrow_use == ""){
			$("#fadeautomess").html("借款用途不能为空");
			errors();
			return false;
		}

		if(borrow_duration == ""){
			$("#fadeautomess").html("借款期限不能为空");
			errors();
			return false;
		}

		if(borrow_min == ""){
			$("#fadeautomess").html("投标金额不能为空");
			errors();
			return false;
		}

		if(borrow_max == ""){
			$("#fadeautomess").html("投标总额不能为空");
			errors();
			return false;
		}

		if(borrow_time == ""){
			$("#fadeautomess").html("有效时间不能为空");
			errors();
			return false;
		}

		if(repayment_type == ""){
			$("#fadeautomess").html("还款方式不能为空");
			errors();
			return false;
		}

		if(borrow_info == ""){
			$("#fadeautomess").html("借款说明不能为空");
			errors();
			return false;
		}
		

		/*$.ajax({
			cache: false,
			url:cpurl+"save",
			type:"post",
			async: false,
			datatype:"json",
			data:$("#myform").serialize(),
			//data:{"vkey":vkey},
			success:function(d){
				alert(d.status);
				if(d.status == 0){
					$("#fadeautomess").html(d.message);
					errors();
					return false;
				}else{
					$("#fadeautomess").html(d.message);
					errors();
				}
			}
		})*/

	}

	function errors(){
		$("#fadeautomess").show();
		$("#fadeautomess").fadeOut(5000);
	}
/*<![CDATA[*/
$(function () {
	var Email;
	var Pass;
	$("#SigninError").hide();
	/*
	//------------------------------------//
	//     ENCRYPTION CONFIGURATION       //
	//------------------------------------//
	$('#FormSignin').jqcrypt({
		keyname:    'cafe123app',
		callback:   function(form){ form.submit(); }
	});
	*/
	//---------------------------------//
	//  CONTROLL WHEN TEXTBOX KEYDOWN  //
	//---------------------------------//
	$("#SigninEmail").keydown(function () {
		$("#SigninEmailLabel").hide();
		if (event.keyCode == '13') {
			document.$("#FormSignin").submit();
		}
	});
	
	$("#SigninEmail").blur(function () {
		if($("#SigninEmail").val() == "") {
			$("#SigninEmailLabel").show();
		}
	});
	
	$("#SigninPass").keydown(function () {
		$("#SigninPassLabel").hide();
	});
	
	$("#SigninPass").blur(function () {
		if($("#SigninPass").val() == "") {
			$("#SigninPassLabel").show();
		}
	});
	
	//---------------------------------//
	//    CONTROLL WHEN FORM SUBMIT    //
	//---------------------------------//
	$("#FormSignin").submit(function() {
		Email = $("#SigninEmail").val();
		Pass = $("#SigninPass").val();
		
		if(Email == "" || Pass == "") {
			$("#SigninError").show();
			return false;
		} else {
			return true;
		}
	});

});
/*]]>*/
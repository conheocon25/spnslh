/*<![CDATA[*/
$(function(){
	$("#dialogContact").dialog({
		autoOpen: false,
		height: 320,
		width: 480,
		modal: true
	});	
	$(".Contact").click(function(){
		$("#dialogContact").dialog('open');
	});
});
/*]]>*/
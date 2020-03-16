/*$("#subCom").click(function(){
	$.post(
		$("#commentform").attr("action"),
		$("#commentform :input").serializeArray(),
		function(result1){
			$("#commentresponse").html(result1);
		}
		);
	clearInput();
});
*/
$("#commentform").submit(function(){
	return false;
});
/*
function clearInput(){
	$("#commentform :input").each(function(){
		$(this).val('');
	});
}
*/
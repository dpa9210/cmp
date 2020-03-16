$("#sub").click(function(){
	$.post(
		$("#nbpform").attr("action"),
		$("#nbpform :input").serializeArray(),
		function(result){
			$("#insertresponse").html(result);
		}
		);
	clearInput();
});

$("#nbpform").submit(function(){
	return false;
});

function clearInput(){
	$("#nbpform :input").each(function(){
		$(this).val('');
	});
}
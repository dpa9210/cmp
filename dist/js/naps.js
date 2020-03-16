$(document).ready(function() {
$('#newAdSubBtn').click(function() {
$.post(
$('#newAdForm').attr('action'),
$('#newAdForm :input').serializeArray(),
function(info) {
$('#postResult').html(info)
}
);
clearInput();
});


("#newAdForm").submit(function(){
	return false;
});

function clearInput(){
 	$("#newAdForm:input").each(function(){
 		$(this).val('');
 	});
 
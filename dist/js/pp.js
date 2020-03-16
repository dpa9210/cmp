function checkPasswordMatch() {
    var password = $("#pass").val();
    var confirmPassword = $("#confpass").val();

    if (password != confirmPassword)
        $("#divCheckPasswordMatch").html("<p style='color:red;'>Passwords do not match, try again!<p>");
    else
        $("#divCheckPasswordMatch").html("<p style='color:green;'>Passwords match .....proceed.</p>");
}

$(document).ready(function () {
   $("#confpass").keyup(checkPasswordMatch);
});

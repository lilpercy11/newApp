// JavaScript source code
function validform() {
    var a = document.forms["my-form"]["full_name"].value;
    var b = document.forms["my-form"]["email_address"].value;
    var c = document.forms["my-form"]["user_name"].value;
    var d = document.forms["my-form"]["Password"].value;
    var e = document.forms["my-form"]["phone_number"].value;

    if (a == null || a == "") {
        alert("Please Enter Your Full Name");
        return false;
    } else if (b == null || b == "") {
        alert("Please Enter Your Email Address");
        return false;
    } else if (c == null || c == "") {
        alert("Please Enter Your Username");
        return false;
    } else if (d == null || d == "") {
        alert("Please Enter a Password");
        return false;
    } else if (e == null || e == "") {
        alert("Please Enter Your Phone Number Number");
        return false;
    }
    
}

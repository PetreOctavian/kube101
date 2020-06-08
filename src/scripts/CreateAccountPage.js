function validare() {

    var username = document.getElementsByName('user').value;
    var email = document.getElementsByName('email').value;
    var password = document.getElementsByName('pass').value;
    var repassword = document.getElementsByName('repass').value;
    var firstname = dodocument.getElementsByName('fname').value;
    var lastname = document.getElementsByName('lname').value;
    var address = document.getElementsByName('add').value;
    var telephone = document.getElementsByName('tel').value;

    var simpleEmail = new RegExp("^[a-zA-Z0-9]+@[a-zA-Z]+\.com$");
    var justLettersAndNumbers = new RegExp("^[a-zA-Z0-9]{8,}$");
    var goodPass = new RegExp("^(?=.*[a-zA-Z])(?=.*[0-9])(?=.{8,})");
    var goodname = new RegExp("^[a-zA-Z\s\.-]*$");
    var goodphone = new RegExp("^[0-9\-\+]{9,15}$");
    var goodadd = new RegExp("^[0-9a-zA-Z\s\.-]*$"); 

    if (!username.match(justLettersAndNumbers))alert("invalid Username(min 8 letters or numbers)");
    if (!email.match(simpleEmail)) alert("invalid Email adress(Exempl3@Exemple.com)");
    if (!password.match(goodPass)) alert("invalid Password(min 8 letters or numbers)");
    if (password != repassword) alert("Password must be the same in both fields");
    //else if (!repassword.match(goodPass)) alert("invalid RePassword(min 8 letters or numbers)");
    if (!firstname.match(goodname)) alert("invalid First name");
    if (!lastname.match(goodname)) alert("invalid Last name");
    if (!telephone.match(goodphone)) alert("invalid Telephone number");
    if (!address.match(goodadd)) alert("invalid Adress");

}
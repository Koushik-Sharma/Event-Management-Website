let loginBox = document.getElementById("login-box");
let signUpBox = document.getElementById("sign-up-box");
let signUpLink = document.getElementById("sign-up");
let loginLink = document.getElementById("login");
signUpLink.onclick = function() {
    loginBox.style.display = "none";
    signUpBox.style.display = "block";
}
loginLink.onclick = function() {
    signUpBox.style.display = "none";
    loginBox.style.display = "block";
}
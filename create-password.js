document.addEventListener("DOMContentLoaded", function() {
    var showPassword1 = document.getElementById("hidden-1");
    var hidePassword1 = document.getElementById("visible-1");
    var showPassword2 = document.getElementById("hidden-2");
    var hidePassword2 = document.getElementById("visible-2");
    var passwordField1 = document.getElementById("password");
    var passwordField2 = document.getElementById("re-password");

    showPassword1.addEventListener("click", function() {
        passwordField1.type = "text";
        showPassword1.style.display = "none";
        hidePassword1.style.display = "block";
    })
    hidePassword1.addEventListener("click", function() {
        passwordField1.type = "password";
        showPassword1.style.display = "block";
        hidePassword1.style.display = "none";
      }
    )
    showPassword2.addEventListener("click", function() {
        passwordField2.type = "text";
        showPassword2.style.display = "none";
        hidePassword2.style.display = "block";
    })
    hidePassword2.addEventListener("click", function() {
        passwordField2.type = "password";
        showPassword2.style.display = "block";
        hidePassword2.style.display = "none";
      }
    )
    });
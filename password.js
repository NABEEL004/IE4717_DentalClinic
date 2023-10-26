document.addEventListener("DOMContentLoaded", function() {
    var showPassword = document.getElementById("hidden");
    var hidePassword = document.getElementById("visible");
    var passwordField = document.getElementById("password");

    showPassword.addEventListener("click", function() {
        passwordField.type = "text";
        showPassword.style.display = "none";
        hidePassword.style.display = "block";
    })
    hidePassword.addEventListener("click", function() {
        passwordField.type = "password";
        showPassword.style.display = "block";
        hidePassword.style.display = "none";
      }
    )
    });
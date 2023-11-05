document.addEventListener("DOMContentLoaded", function () {
  var showPassword1 = document.getElementById("hidden-1");
  var hidePassword1 = document.getElementById("visible-1");
  var showPassword2 = document.getElementById("hidden-2");
  var hidePassword2 = document.getElementById("visible-2");
  var passwordField1 = document.getElementById("password");
  var passwordField2 = document.getElementById("re-password");

  showPassword1.addEventListener("click", function () {
    passwordField1.type = "text";
    showPassword1.style.display = "none";
    hidePassword1.style.display = "block";
  })
  hidePassword1.addEventListener("click", function () {
    passwordField1.type = "password";
    showPassword1.style.display = "block";
    hidePassword1.style.display = "none";
  }
  )
  showPassword2.addEventListener("click", function () {
    passwordField2.type = "text";
    showPassword2.style.display = "none";
    hidePassword2.style.display = "block";
  })
  hidePassword2.addEventListener("click", function () {
    passwordField2.type = "password";
    showPassword2.style.display = "block";
    hidePassword2.style.display = "none";
  }
  )
});



window.onload = function () {

  document.getElementById("info").addEventListener("submit", function (event) {
    event.preventDefault();
    var name = document.getElementById("name");
    var pwd = document.getElementById("password");
    var re_pwd = document.getElementById("re-password");
    var email = document.getElementById("email");
    var phone_number = document.getElementById("number");
    var prevent = false;

    // username validation
    const name_reg = /^(?![-\s']+$)[A-Za-z\s-']+$/;
    if (!name_reg.test(name.value.trim())) {
      var name_alert = document.getElementById("name_alert");
      name_alert.innerHTML = "Name must only contain alphabetical characters. Hyphens, apostrophes and spaces can be used (optional).";
      prevent = true;
    }
    else { document.getElementById("name_alert").innerHTML = ''; }

    const email_reg = /^[\w\.\-_]+@(\w+\.){1,3}\w{2,3}$/;
    if (!email_reg.test(email.value.trim())) {
      var email_alert = document.getElementById("email_alert");
      email_alert.innerHTML = "Please provide a valid email.";
      prevent = true;
    }
    else { document.getElementById("email_alert").innerHTML = ''; }

    const phone_reg = /^[89]\d{7}$/;
    if (!phone_reg.test(phone_number.value.trim())) {
      var phone_alert = document.getElementById("phone_alert");
      phone_alert.innerHTML = "Please provide a valid local mobile number.";
      prevent = true;
    }
    else { document.getElementById("phone_alert").innerHTML = '';}

    if (pwd.value != re_pwd.value) {
      prevent = true;
    }
    else {
      if (!(pwd.value.length >= 8 && (/[a-z]/.test(pwd.value) && /[A-Z]/.test(pwd.value)) && /\d/.test(pwd.value) && /[!@#\$%^&*()_+{}\[\]:;<>,.?~\\`|="'-/]/.test(pwd.value) && !(/\s/.test(pwd.value)))) {
        prevent = true;
      }
    }

    // Until here, all the frontend valdaitons are completed!
    // The backend validaiton:
    // 1. retrieve the email and phone numbers in the database to make sure patients register the
    // account with different phone numbers and emails

    if(!prevent) {
      // Use AJAX
      // send data in JSON format
      var form_submit = event;
      var data = {
        "email": email.value.trim().toLowerCase(),
        "phone": phone_number.value,
        "name":name.value.trim()
      };

      const xhr = new XMLHttpRequest();
      xhr.open("POST", "doctor_uniqueness.php", true);
      xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
      xhr.send(JSON.stringify(data));
      xhr.onload = function () {
        console.log("xhr connection!");
        if (xhr.status === 200) {
          const count = parseInt(xhr.responseText);
          if (count > 0) {
            alert("Username, Email or Mobile number has been linked with existing accounts!");
          }
          else
          {
            document.getElementById("info").submit();
          }
        } else {
          console.log("Failed!");
        }
      };

    }


  });


}

function checkPasswordStrength(password) {
  // Check for at least 8 characters
  const rule1 = password.length >= 8;
  document.getElementById('rule1').checked = rule1;

  // Check for a mix of upper-case and lower-case characters
  const rule2 = /[a-z]/.test(password) && /[A-Z]/.test(password);
  document.getElementById('rule2').checked = rule2;

  // Check for at least one number
  const rule3 = /\d/.test(password);
  document.getElementById('rule3').checked = rule3;

  // Check for at least one special character
  // const rule4 = /[!@#\$%^&*()_+{}\[\]:;<>,.?~\\`\|-]/.test(password);
  const rule4 = /[!@#\$%^&*()_+{}\[\]:;<>,.?~\\`|="'-/]/.test(password)
  document.getElementById('rule4').checked = rule4;

  const noSpaces = /\s/.test(password);
  document.getElementById('rule5').checked = noSpaces;


  compare_pwd(password, document.getElementById("re-password").value);

}

function checkRePassword(repassword) {
  compare_pwd(repassword, document.getElementById("password").value);
}

function compare_pwd(pwd1, pwd2) {
  document.getElementById("consistent").checked = pwd1 != pwd2;
}


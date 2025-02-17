function myFunction() {
    var x = document.getElementById("password-register");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
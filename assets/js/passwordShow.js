function myFunction() {
    var x = document.getElementById("sifra-login");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
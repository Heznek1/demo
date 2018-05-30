function validate(txt1,txt2,txt3,txt4) {
        document.getElementById("fullname").textContent=" ";
        document.getElementById("Email").textContent="";
        document.getElementById("pass").textContent="";
        document.getElementById("pass2").textContent="";
      var emailvalid = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var letters = /^[a-zA-Z]+$/;
          var regexp1 = /^[a-zA-Z0-9]+$/;
          var b = "true";

      if(txt1.value.match(letters)){
      }
      else{
      var  b = "false";
        document.getElementById("fullname").textContent="Please enter only alphabetical letters.";
      }
      if( txt2.value == txt3.value){

      }
      else{
      var  b = "false";
      document.getElementById("pass2").textContent="The new password was not correctly confirmed";
      }
        if(txt2.value.match(regexp1)){

        }
        else{
          var  b = "false";
        document.getElementById("pass").textContent="the password must include letters or numbers";
        }
        if( txt4.value.match(emailvalid)){

        }
        else{
        var  b = "false";
      document.getElementById("Email").textContent="The email must to be aa@example.com";
        }
      if(b=="true"){
          alert("Login succefully");
      }

}
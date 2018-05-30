<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Research4U</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">
    <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/hero-slider-style.css">
<link rel="stylesheet" href="css/magnific-popup.css">
<link rel="stylesheet" href="css/templatemo-style.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="fol.js"></script>
<link rel="stylesheet" href="path/to/easy-autocomplete.min.css">
<link rel="stylesheet" href="path/to/easy-autocomplete.themes.min.css">
<link href="../dist/easy-autocomplete.min.css" rel="stylesheet" type="text/css">
<link href="resources/flags.css"  rel="stylesheet" type="text/css" >
<script src="../lib/jquery-1.11.2.min.js"></script>
<script src="../dist/jquery.easy-autocomplete.min.js" type="text/javascript" ></script>
<script>
var refreshId = setInterval(function()
{
     $('#id1').fadeOut("slow").load('respone.php').fadeIn("slow");
}, 10000);
</script>

</head>

    <body>
      <form id="myForm" action="profile.php" method="post">
      <div>
      <input id="flags" name="name"/>
      <input id="admin" style="display:none" value="Admin" name="user">
       <input type="button" name="button" value="Search" onclick="loadQuestions()" class="button"/>
    </div>
    <a>Welcome <?php echo ($_POST["name"]); ?></a>
  </form>
  <form id="myForm1" action="profile.php" method="post">

</form>

  <script>

  function loadQuestions1(name) {
    var myList = name;
    getList1(myList);

  }

  function getList1(name) {
  $.getJSON('Following.json')
    .done(function (data) {
      my1 = data;
      for(i =0; i < my1.Following.length; i++){
        if(my1.Following[i].name == name){
          document.getElementById('flags').value = name;
        document.getElementById('myForm').submit();
      }
      }

  });
  }


  </script>


  <script>


  function loadQuestions() {
    var myList;
    getList(document.getElementById('flags').value);

  }

  function getList(name) {
  $.getJSON('Following.json')
    .done(function (data) {
      my1 = data;
      for(i =0; i < my1.Following.length; i++){
        if(my1.Following[i].name == name){
          document.getElementById('flags').value = name;
        document.getElementById('myForm').submit();
      }
      }

  });
  }


  </script>
  		<script>

  		var options = {
  			url: "resources/countries.json",

  			getValue: "name",

  			list: {
  				match: {
  					enabled: true
  				},
  				maxNumberOfElements: 10
  			},

  			template: {
  				type: "custom",
  				method: function(value, item) {
  					return "<span class='flag flag-" + (item.Description).toLowerCase() + "' ></span>" + value;
  				}
  			}
  		};

  		$("#flags").easyAutocomplete(options);

  		</script>

    <script>
    <?php  session_start(); ?>  // session starts with the help of this function

<?php

if(isset($_SESSION['use']))   // Checking whether the session is already there or not if
                              // true then header redirect it to the home page directly
 {
    header("Location:1234.php");
 }

if(isset($_POST['login']))   // it checks whether the user clicked login button or not
{
     $user = $_POST['user'];
     $pass = $_POST['pass'];

      if($user == "Admin" && $pass == "Admin")  // username is  set to "Ank"  and Password
         {                                   // is 1234 by default

          $_SESSION['use']=$user;


         echo '<script type="text/javascript"> window.open("1234.php","_self");</script>';            //  On Successful Login redirects to home.php

        }

        else
        {
            echo "invalid UserName or Password";
        }
}
 ?>
    function setPosition1(){
       var $input = $('<input type="button" value="new button" />');
      $(document).ready(function(){
          $.getJSON("projects.json",function(data){
            $.each(data,function(i,item){
              $.each(item,function(j,result){
                $(".divtest").append("<br>").append("Author: ").append(result.FirstName).append("<br>").append(" Public date: ").append(result.PublicDate);
                  $(".divtest").append("<br>").append(" Research name: ").append(result.Name).append("<br>").append(" Description: ").append(result.Description).append("<br>").append(" Num of read: ").append(result.NumOfRead).append("<br>");
                    $(".divtest").append("<input type='button' value='Recommend' onclick='return change(this);' />")
                      $(".divtest").append("<br>");
          });
        });
      });
    });
  }
    </script>

<script type="text/javascript">
function change1( el,el1 )
{
  var div = document.getElementById(el);
   if (div.style.display !== 'none') {
       div.style.display = 'none';
       el1.value = "Show";
   }
   else {
       div.style.display = 'block';
        el1.value = "Hide";
   }

}
</script>
    <script type="text/javascript">
function change( el )
{
    if ( el.value === "Recommend" )
        el.value = "Recommended";
    else
        el.value = "Recommend";
}
</script>
    <script>
    function setJobs(){
      $(document).ready(function(){
          $.getJSON("jobs.json",function(data){
            $.each(data,function(i,item){
              $.each(item,function(j,result){
                $(".divtest1").append("<br>").append("Role: ").append(result.Role).append("<br>").append("University: ").append(result.University);
                  $(".divtest1").append("<br>").append("Location: ").append(result.Location).append("<br>").append("Description: ").append(result.Description).append("<br>");

          });
        });
      });
    });
  }

    </script>
    <script>
    function setFollowing2(){
      $(document).ready(function(){
          $.getJSON("Following.json",function(data){
            $.each(data,function(i,item){
              $.each(item,function(j,result){
                $(".divtest1").append("<br>").append("Role: ").append(result.Role).append("<br>").append("University: ").append(result.University);
                  $(".divtest1").append("<br>").append("Location: ").append(result.Location).append("<br>").append("Description: ").append(result.Description).append("<br>");

          });
        });
      });
    });
  }
    </script>



    <script>
    function setNewF(){
      $(document).ready(function(){
          $.getJSON("newF.json",function(data){
            $.each(data,function(i,item){
              $.each(item,function(j,result){
                $(".divtest3").append("<br>").append(result.Name).append(" start follow of you").append("<br>");

          });
        });
      });
    });
    }
  </script>

  <script>
  function setNewP(){
    $(document).ready(function(){
        $.getJSON("newP.json",function(data){
          $.each(data,function(i,item){
            $.each(item,function(j,result){
              $(".divtest4").append("<br>").append(result.FirstName).append(" post new project: ").append(result.Name).append("<br>");

        });
      });
    });
  });
  }
</script>

<script>
function setMessages(){
  $(document).ready(function(){
      $.getJSON("Messages.json",function(data){
        $.each(data,function(i,item){
          $.each(item,function(j,result){
            $(".divtest5").append("<br>").append(result.FirstName).append(": ").append(result.Name).append("<br>");

      });
    });
  });
});
}
</script>

    <script>
    function setFollowing1(){
      $(document).ready(function(){
          $.getJSON("Following.json",function(data){
            $.each(data,function(i,item){
              $.each(item,function(j,result){
                $(".divtest2").append("<br>").append(result.name).append("<br>").append(result.Description).append("<br>");

          });
        });
      });
    });
    }
</script>
<script>
function setFollowing(){
  $.getJSON('Following.json')
    .done(function (data) {
      myList = data;

      for(j =0; j < myList.Following.length; j++){
        $('<div id=\'li' + j + '\' class="newbox"></div>').appendTo('.divtest2');
          $("#li"+j).append("<br>");
        $("#li"+j).append("Author: ").append(myList.Following[j].name).append("<br>").append(" Description: ").append(myList.Following[j].Description);
        $(".divtest2").append('<input id=\'' + j + '\' type="button" value="view profile" onclick="return loadQuestions1(myList.Following[this.id].name);" />')
        $("#li"+j).append("<br>");
      }

  });
}
</script>
<script>
function setPosition(){
   var html = '';
  $.getJSON('projects.json')
    .done(function (data) {
      myList = data;
      for(i =0; i < myList.Projects.length; i++){

        $('<div id=\'' + i + '\' class="newbox1"></div>').appendTo('.divtest');
          $("#"+i).append("<br>");
        $("#"+i).append("Author: ").append(myList.Projects[i].FirstName).append("<br>").append(" Public date: ").append(myList.Projects[i].PublicDate);
          $("#"+i).append("<br>").append(" Research name: ").append(myList.Projects[i].Name).append("<br>").append(" Description: ").append(myList.Projects[i].Description).append("<br>").append(" Num of read: ").append(myList.Projects[i].NumOfRead).append("<br>");
          $(".divtest").append('<input id=\'' + i + '\' type="button" value="Hide" onclick="return change1(this.id,this);" />')
        $("#"+i).append("<input type='button' value='Recommend' onclick='return change(this);' />");
        $("#"+i).append("<br>");
      }

  });
}
</script>
<script>
function myProjects1(){
  $(document).ready(function(){
      $.getJSON("Myprojects.json",function(data){
        $.each(data,function(i,item){
          $.each(item,function(j,result){
            $(".divtest7").append("<br>").append(" Public date: ").append(result.PublicDate);
              $(".divtest7").append("<br>").append(" Research name: ").append(result.Name).append("<br>").append(" Description: ").append(result.Description).append("<br>").append(" Num of read: ").append(result.NumOfRead).append("<br>");

      });
    });
  });
});
}
</script>
<script>
function myProjects(){
  $.getJSON('Myprojects.json')
    .done(function (data) {
      myList = data;
      for(j =0; j < myList.projects.length; j++){
        $('<div id=\'lii' + j + '\' class="newbox"></div>').appendTo('.divtest7');
          $("#lii"+j).append("<br>");
        $("#lii"+j).append("PublicDate: ").append(myList.projects[j].PublicDate).append("<br>").append("Research name: ").append(myList.projects[j].Name).append("<br>").append("Description: ").append(myList.projects[j].Description).append("<br>").append("NumOfRead: ").append(myList.projects[j].NumOfRead);
        $(".divtest7").append('<input id=\'lii' + j + '\' type="button" value="Hide" onclick="return change1(this.id,this);" />')
        $("#lii"+j).append("<br>");
      }

  });
}
</script>
<script>
function myskills(){
  $(document).ready(function(){
      $.getJSON("skiils.json",function(data){
        $.each(data,function(i,item){
          $.each(item,function(j,result){
            $(".tm-figure-description").append(result.Skills1).append(", ").append(result.Skills2).append(", ").append(result.Skills3).append(".");

      });
    });
  });
});
}
</script>
<script>
function myInterests(){
  $(document).ready(function(){
      $.getJSON("interests.json",function(data){
        $.each(data,function(i,item){
          $.each(item,function(j,result){
            $(".tm-figure-description1").append(result.interests1).append(", ").append(result.interests2).append(", ").append(result.interests3).append(".");

      });
    });
  });
});
}
</script>
        <!-- Content -->
        <div class="cd-hero">

            <!-- Navigation -->
            <div class="cd-slider-nav">
                <nav class="navbar">
                    <div class="tm-navbar-bg">

                        <a class="navbar-brand text-uppercase" href="#" onclick="window.location = '1234.php';"><i class="fa fa-flash tm-brand-icon" ></i>Research4U</a>

                        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#tmNavbar">
                            &#9776;
                        </button>
                        <div class="collapse navbar-toggleable-md text-xs-center text-uppercase tm-navbar" id="tmNavbar">
                            <ul class="nav navbar-nav">

                                <li class="nav-item active selected">
                                    <a class="nav-link" href="#0" data-no="1">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#0" data-no="2">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#0" data-no="3">Following</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#0" data-no="4">Messages</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#0" data-no="5">Notifications</a>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#0" data-no="6" onclick="window.location = 'logout.php';">Logout</a>
                                    <a href="logout.php"></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </nav>
            </div>

            <ul class="cd-hero-slider">

                <!-- Page 1 Home -->

                <li class="selected">
                    <div class="cd-full-width">
                        <div class="container-fluid js-tm-page-content tm-page-pad" data-page-no="1">
                          <div class="tm-contact-page">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="tm-flex">
                                        <div class="tm-bg-white-translucent text-xs-left tm-textbox tm-textbox-padding tm-white-box-margin-b">
                                          <h2 class="tm-text-title">News Feed</h2>
                                          <b>What project are you working on right now?</b>
                                          <input type="text"  id="text1" /></input>
                                          <input type="button" value="Add"  onclick= />
                                          <iframe style="display:none" onload="not()"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div id="row1">
                                <div id="id1" class="col-xs-12">
                                    <div class="tm-flex">
                                      <div id="row">
                                        <div class="tm-bg-white-translucent text-xs-left tm-textbox tm-2-col-textbox-2 tm-textbox-padding">
                                          <h2 style="color:black">New jobs:</h2>
                                          <iframe style="display:none" onload="setJobs()"></iframe>
                                          <b><div class="divtest1"></div></b>
                                        </div>
                                        <div class="tm-bg-white-translucent text-xs-left tm-textbox tm-2-col-textbox-2 tm-textbox-padding">
                                          <h2 style="color:black">Last posts:</h2>
                                          <iframe style="display:none" onload="setPosition()"></iframe>
                                          <b><div id="divtest" class="divtest"></div></b>
                                        </div>
                                      </div>

                                    </div>
                                </div>
                            </div>
                          </div>
                          <script>
                          $(".btn1").click(function() {
                              $("#row").toggle();
                          });
</script>

                </li>



                <!-- Page 2 Gallery One -->
                <li>
                    <div class="cd-full-width">
                        <div class="container-fluid js-tm-page-content" data-page-no="2" data-page-type="gallery">
                            <div class="tm-img-gallery-container">
                                <div class="tm-img-gallery gallery-one">
                                <!-- Gallery One pop up connected with JS code below -->
                                    <div class="tm-img-gallery-info-container">
                                        <h2 class="tm-text-title tm-gallery-title tm-white"><span class="tm-white">My profile: </span></h2>
                                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>
$("#profileImage").click(function(e) {
    $("#imageUpload").click();
});
</script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
<image id="profileImage" img src="img/profile.png" />
<input id="imageUpload" type="file"
       name="profile_photo" placeholder="Photo" required="" capture>
       <script>
       function previewProfileImage( uploader ) {
    //ensure a file was selected
    if (uploader.files && uploader.files[0]) {
        var imageFile = uploader.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            //set the image data as source
            $('#profileImage').attr('src', e.target.result);
        }
        reader.readAsDataURL( imageFile );
    }
}
$("#imageUpload").change(function(){
    previewProfileImage( this );
});
</script>
<div class="tm-img-gallery-info-container">
 <h1>John Snow</h1>
 <p class="title">CEO & Founder, Example</p>
 <p>Harvard University</p>
 <a href="#"><i class="fa fa-dribbble"></i></a>
 <a href="#"><i class="fa fa-twitter"></i></a>
 <a href="#"><i class="fa fa-linkedin"></i></a>
 <a href="#"><i class="fa fa-facebook"></i></a>
</div>

                                    </div>
                                    <div class="grid-item">
                                        <figure class="effect-ruby">
                                            <img src="img/tm-img-01-tn.jpg" alt="Image" height="350" width="1000">
                                            <figcaption>
                                                <h2 class="tm-figure-title">SKILLS </h2>
                                                <iframe style="display:none" onload="myskills()"></iframe>
                                                <p  class="tm-figure-description"></p>

                                            </figcaption>
                                        </figure>
                                    </div>
                                    <div class="grid-item">
                                        <figure class="effect-ruby">
                                            <img  src="img/tm-img-02-tn.jpg" alt="Image" height="350" width="1000">
                                            <figcaption>
                                                <h2 class="tm-figure-title">Research interests</h2>
                                                <iframe style="display:none" onload="myInterests()"></iframe>
                                                <p class="tm-figure-description1"></p>
                                            </figcaption>
                                        </figure>
                                    </div>

                                    <div id="12">
                                        <div class="col-xs-12">
                                            <div class="tm-flex">
                                              <div id="row">
                                                <div  class="tm-bg-white-translucent text-xs-left tm-textbox tm-2-col-textbox-2 tm-textbox-padding">
                                                  <h2 style="color:black">My projects:</h2>
                                                  <iframe style="display:none" onload="myProjects()"></iframe>
                                                  <b><div class="divtest7"></div></b>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>><br>
                                  <script>
                                  $(".btn2").click(function() {
                                    $("#12").toggle();
                                  });
                                  </script>
                            </div>
                        </div>
                    </div>
                </li>


                <!-- Page 3 Gallery Two -->
                <li>
                    <div class="cd-full-width">
                        <div class="container-fluid js-tm-page-content" data-page-no="3" data-page-type="gallery">
                          <div class="column">
                      <div class="tm-3-col-container">
                              <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 tm-3-col-textbox">
                                  <div class="text-xs-left tm-textbox tm-textbox-padding tm-bg-white-translucent tm-3-col-textbox-inner">
                                      <i class="fa fa-4x fa-pagelines tm-home-fa"></i>
                                        <h2 style="color:black">Following:</h2>
                                        <iframe style="display:none" onload="setFollowing()"></iframe>
                                        <b><div class="divtest2"></div></b>
                                </div>
                              </div>
                        </div>
                  </div>

                            </div>
                        </div>

                </li>

                <!-- Page 4 Gallery Three -->
                <li>
                    <div class="cd-full-width">
                        <div class="container-fluid js-tm-page-content" data-page-no="4" data-page-type="gallery">
                            <div class="tm-img-gallery-container tm-img-gallery-container-3">
                              <div class="row">
                                  <div class="col-xs-12">
                                      <div class="tm-flex">

                                          <div class="tm-bg-white-translucent text-xs-left tm-textbox tm-2-col-textbox-2 tm-textbox-padding">
                                              <h2 class="tm-text-title">Messages:</h2>
                                              <iframe style="display:none" onload="setMessages()"></iframe>
                                              <b><div class="divtest5"></div></b>                                        </div>
                                      </div>
                                  </div>
                              </div>
                            </div> <!-- .tm-img-gallery-container -->
                        </div>
                    </div>
                </li>

                <!-- Page 5 About -->
                <li>
                    <div class="cd-full-width">
                        <div class="container-fluid js-tm-page-content tm-page-width" data-page-no="5">


                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="tm-flex">
                                        <div class="tm-bg-white-translucent text-xs-left tm-textbox tm-2-col-textbox-2 tm-textbox-padding">
                                            <h2 class="tm-text-title">New Following:</h2>
                                            <iframe style="display:none" onload="setNewF()"></iframe>
                                            <b><div class="divtest3"></div></b>
                                        </div>
                                        <div class="tm-bg-white-translucent text-xs-left tm-textbox tm-2-col-textbox-2 tm-textbox-padding">
                                            <h2 class="tm-text-title">New projects:</h2>
                                            <iframe style="display:none" onload="setNewP()"></iframe>
                                            <b><div class="divtest4"></div></b>                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- .cd-full-width -->

                </li>

                <!-- Page 6 Logout -->
                <li>
                    <div class="cd-full-width">
                        <div class="container-fluid js-tm-page-content tm-page-pad" data-page-no="6">
                            <div class="tm-contact-page">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="tm-flex tm-contact-container">
                                            <div class="tm-bg-white-translucent text-xs-left tm-textbox tm-2-col-textbox-2 tm-textbox-padding tm-textbox-padding-contact">
                                                <h2 class="tm-contact-info">Contact Us</h2>
                                                <p class="tm-text">Praesent tempus dapibus odio nec elementum. Sed elementum est quis tortor faucibus, et molestie nibh finibus. Mauris condimentum ex vestibulum fringilla consectetur.</p>

                                                <!-- contact form -->
                                                <form action="index.html" method="post" class="tm-contact-form">

                                                    <div class="form-group">
                                                        <input type="text" id="contact_name" name="contact_name" class="form-control" placeholder="Name"  required/>
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="email" id="contact_email" name="contact_email" class="form-control" placeholder="Email"  required/>
                                                    </div>

                                                    <div class="form-group">
                                                        <textarea id="contact_message" name="contact_message" class="form-control" rows="5" placeholder="Your message" required></textarea>
                                                    </div>

                                                    <button type="submit" class="pull-xs-right tm-submit-btn">Send</button>

                                                </form>
                                            </div>

                                            <div class="tm-bg-white-translucent text-xs-left tm-textbox tm-2-col-textbox-2 tm-textbox-padding tm-textbox-padding-contact">
                                                <h2 class="tm-contact-info">123 New Street 11000, San Francisco, CA</h2>
                                                <!-- google map goes here -->
                                                <div id="google-map"></div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div> <!-- .cd-full-width -->
                </li>
                <!-- Page 6 Contact Us -->

            </ul> <!-- .cd-hero-slider -->

            <footer class="tm-footer">

                <div class="tm-social-icons-container text-xs-center">
                    <a href="#" class="tm-social-link"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="tm-social-link"><i class="fa fa-google-plus"></i></a>
                    <a href="#" class="tm-social-link"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="tm-social-link"><i class="fa fa-behance"></i></a>
                    <a href="#" class="tm-social-link"><i class="fa fa-linkedin"></i></a>
                </div>

                <p class="tm-copyright-text">Copyright &copy; 302702204 (Dean Lichtenshtein) & 302662580 (Or Barazani)



            </footer>

        </div>
        <div id="loader-wrapper">

            <div id="loader"></div>
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>

        </div>

        <!-- load JS files -->
        <script src="js/jquery-1.11.3.min.js"></script>         <!-- jQuery (https://jquery.com/download/) -->
        <script src="https://www.atlasestateagents.co.uk/javascript/tether.min.js"></script> <!-- Tether for Bootstrap (http://stackoverflow.com/questions/34567939/how-to-fix-the-error-error-bootstrap-tooltips-require-tether-http-github-h) -->
        <script src="js/bootstrap.min.js"></script>             <!-- Bootstrap js (v4-alpha.getbootstrap.com/) -->
        <script src="js/hero-slider-main.js"></script>          <!-- Hero slider (https://codyhouse.co/gem/hero-slider/) -->
        <script src="js/jquery.magnific-popup.min.js"></script> <!-- Magnific popup (http://dimsemenov.com/plugins/magnific-popup/) -->

        <script>

            function adjustHeightOfPage(pageNo) {

                var offset = 80;
                var pageContentHeight = 0;

                var pageType = $('div[data-page-no="' + pageNo + '"]').data("page-type");

                if( pageType != undefined && pageType == "gallery") {
                    pageContentHeight = $(".cd-hero-slider li:nth-of-type(" + pageNo + ") .tm-img-gallery-container").height();
                }
                else {
                    pageContentHeight = $(".cd-hero-slider li:nth-of-type(" + pageNo + ") .js-tm-page-content").height();
                }

                if($(window).width() >= 992) { offset = 120; }
                else if($(window).width() < 480) { offset = 40; }

                // Get the page height
                var totalPageHeight = 15 + $('.cd-slider-nav').height()
                                        + pageContentHeight + offset
                                        + $('.tm-footer').height();

                // Adjust layout based on page height and window height
                if(totalPageHeight > $(window).height())
                {
                    $('.cd-hero-slider').addClass('small-screen');
                    $('.cd-hero-slider li:nth-of-type(' + pageNo + ')').css("min-height", totalPageHeight + "px");
                }
                else
                {
                    $('.cd-hero-slider').removeClass('small-screen');
                    $('.cd-hero-slider li:nth-of-type(' + pageNo + ')').css("min-height", "100%");
                }
            }

            /*
                Everything is loaded including images.
            */
            $(window).load(function(){

                adjustHeightOfPage(1); // Adjust page height

                /* Gallery One pop up
                -----------------------------------------*/
                $('.gallery-one').magnificPopup({
                    delegate: 'a', // child items selector, by clicking on it popup will open
                    type: 'image',
                    gallery:{enabled:true}
                });

				/* Gallery Two pop up
                -----------------------------------------*/
				$('.gallery-two').magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    gallery:{enabled:true}
                });

                /* Gallery Three pop up
                -----------------------------------------*/
                $('.gallery-three').magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    gallery:{enabled:true}
                });

                /* Collapse menu after click
                -----------------------------------------*/
                $('#tmNavbar a').click(function(){
                    $('#tmNavbar').collapse('hide');

                    adjustHeightOfPage($(this).data("no")); // Adjust page height
                });

                /* Browser resized
                -----------------------------------------*/
                $( window ).resize(function() {
                    var currentPageNo = $(".cd-hero-slider li.selected .js-tm-page-content").data("page-no");

                    // wait 3 seconds
                    setTimeout(function() {
                        adjustHeightOfPage( currentPageNo );
                    }, 1000);

                });

                // Remove preloader (https://ihatetomatoes.net/create-custom-preloading-screen/)
                $('body').addClass('loaded');

            });



        </script>

</body>
</html>

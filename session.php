<?php
   session_start();
   // Checking user exist in session for every page
   if(strpos($_SERVER['REQUEST_URI'], '/login.php') === false and strpos($_SERVER['REQUEST_URI'], '/register.php') === false) {
	   if(empty($_SESSION['user'])) {
	   		header('Location: /login.php');
	   }
   }

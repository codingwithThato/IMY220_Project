<?php 
// /* session_unset();
	// session_destroy();
	// response(true, $message); 
    session_start(); 
    unset($_SESSION['username']);
    unset($_SESSION['name']);
    unset($_SESSION['surname']);
    header('location:login.php'); //no access to index.php if logged out lol 
    die();
?>
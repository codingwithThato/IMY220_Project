<?php
    //see all errors and warnings
	// error_reporting(E_ALL);
	// ini_set('error_reporting', E_ALL);

    // //connecting to database for USERS
    // $servername = "localhost";
    // $user = "u21487279";
    // $passw = "ucorktzu";
    // $dbname = "u21487279";

    // //create a database connection
    // $conn = new mysqli($servername, $user, $passw, $dbname);

    // //check for connection errors!
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }

    ///CONNECTING TO DATABASE USING LOCALHOST
    $servername = "localhost";
    $user = "root";
    $passw = "";
    $dbname = "u21487279";

    //create a database connection
    $conn = new mysqli($servername, $user, $passw, $dbname);

    //check for connection errors!
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


?>
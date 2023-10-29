<?php

    //connecting to database 
    $servername = "localhost";
    $user = "u21487279";
    $passw = "ucorktzu";
    $dbname = "u21487279";

    //create a database connection
    $conn = new mysqli($servername, $user, $passw, $dbname);

    //check for connection errors!
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


?>
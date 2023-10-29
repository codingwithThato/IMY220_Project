<?php
    include "config.php";

    $name = $_POST["fname"];
	$surname = $_POST["lname"];
	$username = $_POST["user"];
	$contact = $_POST["contact"];
	$email = $_POST["email"];
	$password = $_POST["pass"];

    //VALIDATION TIME
    
    //check if empty:
    if(empty($name)) die("All fields are required.");
    if(empty($surname)) die("All fields are required.");
    if(empty($username)) die("All fields are required.");
    if(empty($email)) die("All fields are required.");
    if(empty($password)) die("All fields are required.");
    if(empty($contact)) die("All fields are required.");

    //check if email == valid
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) die("Please enter a valid email address.");

    //check if password == valid
    if(!preg_match('/\d/', $password)) die("Password must contain at least one digit.");
    if(!preg_match('/[A-Z]/', $password)) die("Password must contain at least one uppercase letter.");
    if(!preg_match('/[a-z]/', $password)) die("Password must contain at least one lowercase letter.");
    if(!preg_match('/[^\w\d\s]/', $password)) die("Password must contain at least one symbol");
    if(strlen($password) < 8) die("Password must be at least 8 characters long.");

    //hashing the password!!
    // $hashPass = password_hash($password, PASSWORD_DEFAULT); //why this hashing alg ? creates random salts by itself! but look it up.

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //duplicate emails!
    $query = "SELECT * FROM users WHERE email='$email'";
    $res = $conn->query($query);
    if($res->num_rows > 0) die("This email has already been taken.");

    // //INSERTS data into table :)
    // $query = "INSERT INTO users (name, surname, username, email, password, contact) VALUES ('$name', '$surname', '$username', '$email', '$hashPass', '$contact')"; //update this in future to account for BIRTHDAY?
    // Prepare and bind the query
    $query = "INSERT INTO users (name, surname, username, email, password, contact) VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssss", $name, $surname, $username, $email, $password, $contact);

    // Execute the query
    if ($stmt->execute()) {
        // Successfully registered
        header("location:index.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();

?>
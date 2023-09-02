<?php
    $userid = $_POST['user'];
    $passwordField = $_POST['pass'];

    $userid = filter_var($userid, FILTER_SANITIZE_STRING);
    $passwordField = filter_var($passwordField, FILTER_SANITIZE_STRING);
    
    //Check if username and password are not empty
    if (!empty($userid) && !empty($passwordField)) {

        include "config.php";

        $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->bind_param("s", $userid);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        //Compare hashed password with input password
        if (password_verify($passwordField, $hashed_password)){
            //Prepare a SELECT statement to check if the user exists
            $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
            $stmt->bind_param("s", $userid);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows > 0) {
                // User exists
                session_start();
                $_SESSION['username'] = session_id();

                $row = $result->fetch_assoc();
                
                $name = $row['name'];
                $_SESSION['name'] = $name;

                $surname = $row['surname'];
                $_SESSION['surname'] = $surname;
                
                header("Location: index.php");
                exit();
            }
        }
        else{
            error_log("Invalid username or password");
            header("Location: login.php?error=invalid_login");
            exit();
        }
        $stmt->close();
        $conn->close();
    }
    else {
    // User does not exist, fail login
        error_log("Empty username or password");
        header("Location: login.php?error=empty_fields");
        exit();
    }

?>
<?php
session_start();
include "config.php";

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
}

// Fetch user data from the database
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Handle form submission to update user information
if (isset($_POST['update_profile'])) {
    $newName = $_POST['new_name'];
    $newSurname = $_POST['new_surname'];
    $newEmail = $_POST['new_email'];
    
    // Update user information in the database
    $updateQuery = "UPDATE users SET name = ?, surname = ?, email = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("sssi", $newName, $newSurname, $newEmail, $_SESSION['id']);
    
    if ($updateStmt->execute()) {
        // Redirect to the profile page after updating
        header("Location: profile.php");
        exit();
    } else {
        echo "Error: " . $updateStmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8" />
        
        <meta name="author" content="Thato Kalagobe" />
        <title>Beanpedia</title> 
    
        <!-- embedding fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Gilda+Display&family=Suranna&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
        
        <!--Bootstrap & CSS cdn linking -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="css/style.css"/> 
        <link rel="stylesheet" type="text/css" href="css/index.css"/> 
        <!-- <link rel="stylesheet" type="text/css" href="css/profile.css"/>  -->
       
        <!-- the parallax.js -->
        <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.js"></script> -->
        
        <!-- jQuery -->
        <!-- <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script> -->
		<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- favicon -->
        <link rel="icon" type="image/x-icon" href="images/logo.svg">
    </head>
<body>
    <div class="container">
        <h2>Edit Profile</h2>
        <form action="edit_profile.php" method="POST">
            <div class="form-group row">
                <div class="col-12">
                    <label for="new_name">Name:</label>
                    <input type="text" id="new_name" name="new_name" value="<?php echo $user['name']; ?>"><br/><br/>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                    <label for="new_surname">Surname:</label>
                    <input type="text" id="new_surname" name="new_surname" value="<?php echo $user['surname']; ?>"><br/><br/>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                    <label for="new_email">Email:</label>
                    <input type="email" id="new_email" name="new_email" value="<?php echo $user['email']; ?>"><br/><br/>
                </div>
            </div>
            <button type="submit" class="btn btn-dark" name="update_profile">Save Changes</button>
        </form>
    </div>
</body>
</html>

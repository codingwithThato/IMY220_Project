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

include "head.php";

?>

        <link rel="stylesheet" type="text/css" href="css/style.css"/> 
        <link rel="stylesheet" type="text/css" href="css/index.css"/> 
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

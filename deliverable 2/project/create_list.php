<?php
if (isset($_POST['create_list'])) {
    
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    include "config.php";
    session_start();

    // Retrieve data from the form
    $listName = $_POST['list_name'];
    $listDescription = $_POST['list_description'];
    $userID = $_SESSION['id'];

    // Insert the new list into the lists table
    $query = "INSERT INTO lists (name, description, user_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $listName, $listDescription, $userID);

    if ($stmt->execute()) {
        // Get the ID of the newly created list
        $listID = $stmt->insert_id;
        // echo $listID;
        // Redirect to the page where users can add articles to this list
        header("Location: list.php?list_id=$listID");
    } else {
        // Handle the error
        echo "Error: " . $stmt->error;
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}

?>
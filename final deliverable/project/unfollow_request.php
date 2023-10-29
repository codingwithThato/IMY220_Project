<?php
session_start();
include "config.php"; // Include your database configuration file

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("HTTP/1.1 403 Forbidden");
    exit();
}

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user ID to unfollow from the request data
    $userIdToUnfollow = $_POST['userId'];

    // Get the current user's ID from the session
    $currentUserId = $_SESSION['id'];

    // Check if the user is trying to unfollow themselves
    if ($currentUserId == $userIdToUnfollow) {
        echo json_encode(["message" => "You cannot unfollow yourself."]);
        exit();
    }

    // Perform the unfollow action in your database
    // Replace 'your_unfollow_table' and 'follower_id_column' and 'following_id_column' with the actual table and column names.
    $query = "DELETE FROM follows WHERE follower_id = ? AND following_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $currentUserId, $userIdToUnfollow);

    if ($stmt->execute()) {
        echo json_encode(["message" => "User unfollowed successfully."]);
    } else {
        echo json_encode(["message" => "Failed to unfollow user."]);
    }
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    exit();
}
?>

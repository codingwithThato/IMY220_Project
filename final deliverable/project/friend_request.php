<?php
session_start();
include "config.php";

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("HTTP/1.1 403 Forbidden");
    exit();
}

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the sender's ID from the session
    $senderId = $_SESSION['id'];

    // Get the recipient's ID from the request data
    if (isset($_POST['recipientId'])) {
        $recipientId = $_POST['recipientId'];
    } else {
        echo json_encode(["message" => "Recipient ID is missing."]);
        exit();
    }

    // Check if the sender and recipient are not the same user
    if ($senderId == $recipientId) {
        echo json_encode(["message" => "You cannot follow yourself."]);
        exit();
    }

    $query = "INSERT INTO follows (follower_id, following_id) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $senderId, $recipientId);

    if ($stmt->execute()) {
        echo json_encode(["message" => "User followed successfully."]);
    } else {
        echo json_encode(["message" => "Failed to follow user."]);
    }
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    exit();
}
?>

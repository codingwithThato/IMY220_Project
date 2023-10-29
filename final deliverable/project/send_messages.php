<?php
session_start();
include "config.php"; // Include your database configuration file

if (!isset($_SESSION['id'])) {
    header("HTTP/1.1 403 Forbidden");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senderId = $_SESSION['id'];
    $recipientId = $_POST['recipient_id'];
    $message = $_POST['message'];

    // Insert the message into the database with sender, recipient, and content
    $query = "INSERT INTO chat_messages (sender_id, recipient_id, content) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iis", $senderId, $recipientId, $message);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Message sent successfully"]);
    } else {
        echo json_encode(["message" => "Failed to send message"]);
    }
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    exit();
}
?>

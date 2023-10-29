<?php
session_start();
include "config.php"; // Include your database configuration file

if (!isset($_SESSION['id'])) {
    header("HTTP/1.1 403 Forbidden");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $userId = $_SESSION['id'];
    $recipientId = $_GET['recipient_id'];

    // Fetch the chat messages between the current user and the recipient
    $query = "SELECT * FROM chat_messages WHERE (sender_id = ? AND recipient_id = ?) OR (sender_id = ? AND recipient_id = ?) ORDER BY timestamp ASC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iiii", $userId, $recipientId, $recipientId, $userId);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $messages = [];
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }
        echo json_encode($messages);
    } else {
        echo json_encode(["message" => "Failed to fetch messages"]);
    }
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    exit();
}
?>

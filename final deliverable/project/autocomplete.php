<?php
include "config.php"; // Include your database configuration

if (isset($_GET['q']) && isset($_GET['search_type'])) {
    $searchTerm = $_GET['q'];
    $searchType = $_GET['search_type'];

    // Perform an autocomplete search based on the selected search type
    switch ($searchType) {
        case "articles":
            // Perform a fuzzy search for article names
            $query = "SELECT * FROM articles WHERE name LIKE ? ORDER BY name ASC";
            $stmt = $conn->prepare($query);
            $searchTerm = '%' . $searchTerm . '%';
            $stmt->bind_param("s", $searchTerm);
            break;
        case "users":
            // Perform a fuzzy search for user names, usernames, or email addresses
            $query = "SELECT * FROM users WHERE name LIKE ? OR username LIKE ? OR email LIKE ?";
            $stmt = $conn->prepare($query);
            $searchTerm = '%' . $searchTerm . '%';
            $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
            break;
        case "hashtags":
            // Perform a fuzzy search for hashtags
            $query = "SELECT * FROM articles WHERE name LIKE ? ORDER BY name ASC";
            $stmt = $conn->prepare($query);
            $searchTerm = '%' . $searchTerm . '%';
            $stmt->bind_param("s", $searchTerm);
            break;
        default:
            echo "Invalid search type.";
            exit();
    }

    $stmt->execute();
    $result = $stmt->get_result();

    // Create autocomplete suggestions
    while ($row = $result->fetch_assoc()) {
        echo "<div class='autocomplete-item'>";
        echo "<p>{$row['name']}</p>";
        echo "</div>";
    }
}
?>

<?php
session_start();
include "config.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if the user_id parameter is present in the URL
if (isset($_GET['user_id'])) {
    $profile_user_id = $_GET['user_id'];
} else {
    // Use the session's user_id if no user_id parameter is given
    $profile_user_id = $_SESSION['id'];
}

// Fetch user data from the database based on the $profile_user_id
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $profile_user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

include "head.php";

?>

        <link rel="stylesheet" type="text/css" href="css/style.css"/> 
        <link rel="stylesheet" type="text/css" href="css/index.css"/> 
        <link rel="stylesheet" type="text/css" href="css/profile.css"/> 
    </head>
    <body>


    <div class="container justify-content-center align-items-center">
    <?php include "header.php";?>
    
    
    <!-- <img src="<?php //echo $user['profile_image'] ?: 'default-image.jpg'; ?>" class="img-fluid rounded-circle" alt="Profile Image"> -->

        
    <div class="container justify-content-center align-items-center">
    
    <div id="notification" class="alert alert-success">
        Followed user successfully!
    </div>

    <div id="notificationUn" class="alert alert-success">
        Unfollowed user successfully.
    </div>

    <button id="sending"></button>
    <div class="row">
        <div class="col-md-6 align-items-center">
            <img src="images/profile.jpg" class="w-50 img-fluid rounded-circle" alt="Profile Image">
        </div>
        
        <div class="col-md-6">
            <h2>Profile Information</h2>
            <p class="p"><strong>Name:</strong> <?php echo $user['name']; ?></p>
            <p class="p"><strong>Surname:</strong> <?php echo $user['surname']; ?></p>
            <p class="p"><strong>Email:</strong> <?php echo $user['email']; ?></p>
            <p class="p"><strong>Birthday:</strong> <?php echo $user['birthday']; ?></p>
        </div>
    </div>    
</div>
        

    <?php if (!isset($_GET['user_id'])) {

        echo '<p><a class="editing" href="edit_profile.php">Edit Profile</a></p>
    
        <br/><br/>
    
        <div class="row justify-content-center">
    <div class="col-md-6">
        <h3>My Lists:</h3>';
    
        
        include "config.php";
    
        // Retrieve the lists created by the user
        $query2 = "SELECT * FROM lists WHERE user_id = ?";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bind_param("i", $_SESSION["id"]);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
    
        while ($row2 = $result2->fetch_assoc()) {
            $listname = $row2["name"];
            $id = $row2["id"];
        
        echo    '<div class="card mb-3">
                <div class="card-header">';
                    echo $listname; 
        echo        '</div>
                <ul class="list-group list-group-flush">';
                   
                    // Retrieve articles in the list
                    $query = "SELECT articles.name FROM `list_articles` 
                            INNER JOIN articles ON list_articles.article_id = articles.id
                            INNER JOIN lists ON list_articles.list_id = lists.id 
                            INNER JOIN users ON lists.user_id = users.id WHERE users.id = ? AND lists.id = ?;";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("ii", $_SESSION["id"], $id);
                    $stmt->execute();
                    $result = $stmt->get_result();
    
                    // Display the articles
                    while ($row = $result->fetch_assoc()) {
                    
                    echo '<li class="list-group-item">';
                    echo $row["name"]; 
                    echo '</li>';
                
                    }
                    
                echo '</ul>
            </div>';
        }
        // Close the statement
        $stmt->close();
        
    echo '</div>
    </div>';
    }?>

        
    <div class="row">

        <!-- Add Friend Button (Follow/Unfollow) -->
        <div class="col-12">
            <?php
            $loggedInUserId = $_SESSION['id'];

            if(isset($_GET['user_id'])){
                $query = "SELECT * FROM users WHERE id = ?";
                $stmt = $conn->prepare($query);
                // $temp = 
                $stmt->bind_param("i", $_GET['user_id']);
                $stmt->execute();
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();
                
                $profileUserId = $user['id']; //The user ID of the profile being viewed
                if ($loggedInUserId !== $profileUserId) {
                    $query = "SELECT 1 FROM follows WHERE follower_id = ? AND following_id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("ii", $loggedInUserId, $profileUserId);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        echo '<button class="btn btn-danger mt-3 w-50 mb-2" id="unfollowBtn" data-action="unfollow">Unfollow</button>
                            <a href="messages.php?user_id=' . $profileUserId . '"><button class="btn btn-dark w-50" id="sendMessageBtn">Send Message</button></a>';
                    } else {
                        echo '<button class="btn btn-success mt-3 w-50 mb-2" id="followBtn" data-action="follow">Follow</button>';
                    }
                }
            }
            ?>    
        </div>
        </div>
    </div>
        <script src="js/profile.js"></script>
    </div>
    </body> 
</html>
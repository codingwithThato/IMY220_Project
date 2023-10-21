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
        <link rel="stylesheet" type="text/css" href="css/profile.css"/> 
       
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
    <?php
        session_start();
        include "config.php";

        ini_set('display_errors', 1);
        error_reporting(E_ALL);

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
    ?>

<div class="container justify-content-center align-items-center">
    <!-- header -->
    <div class="row">
    <div class="col-lg-6">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-transparent mt-3">
            <h1 id="main-heading"><a href="index.php">B<img src="images/logo.svg" width="40">ANPEDIA</a></h1>
        </nav>
    </div>
    

    <div class="col-lg-6">
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent justify-content-end mt-3">
            <div class="row ml-auto ul">
                <div class="col-auto li">
                    <a class="nav-link" href="index.php">Home</a>
                </div>
                <div class="col-auto li">
                    <a class="nav-link" href="search.php">Explore</a>
                </div>
                <div class="col-auto li">
                    <a class="nav-link" href="profile.php">Profile</a>
                </div>
                <div class="col-auto li">
                    <a class="nav-link" href="list.php">Lists</a>
                </div>
                <div class="col-auto li">
                    <a class="nav-link" href="logout.php">Logout</a>
                </div>
            </div>
        </nav>
    </div>

        <div class="row mt-3">
        <!-- Display user information -->
        <h2>Profile Information</h2>
        <p class="p">Name: <?php echo $user['name']; ?></p>
        <p class="p">Surname: <?php echo $user['surname']; ?></p>
        <p class="p">Email: <?php echo $user['email']; ?></p>
        <p class="p">Birthday: <?php echo $user['birthday']; ?></p>

        <!-- Add an edit profile button/link -->
        <p><a class="editing" href="edit_profile.php">Edit Profile</a></p>

        <br/><br/>

        <h3>My Lists:</h3>
        
        <?php
            include "config.php";
            // session_start();
            // Retrieve the lists created by the user

            $query2 = "SELECT * FROM lists WHERE user_id = ?";
            $stmt2 = $conn->prepare($query2);
            $stmt2->bind_param("i", $_SESSION['id']);
            $stmt2->execute();
            $result2 = $stmt2->get_result();
            
            while ($row2 = $result2->fetch_assoc()) {
                $listname = $row2['name'];
                $id = $row2['id'];
                echo "<h3>$listname</h3>";

                echo '<ul id="ul">';
                $query = "SELECT articles.name FROM `list_articles` 
                                INNER JOIN articles ON list_articles.article_id = articles.id
                                INNER JOIN lists ON list_articles.list_id = lists.id 
                                INNER JOIN users ON lists.user_id = users.id WHERE users.id = ? AND lists.id = ?;";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ii", $_SESSION['id'], $id);
                $stmt->execute();
                $result = $stmt->get_result();

                // Display the lists
                while ($row = $result->fetch_assoc()) {
                    echo "<li>{$row['name']}</li>";
                }
                echo "</ul>";
            }
            

            // Close the statement
            $stmt->close();
            ?>

        </div>
        <div class="row">
        <div class="col-12">
            <!-- placeholder for push notification preferences -->
            
        </div>
        <div class="col-12">
            <!-- Add Friend Button (Placeholder Functionality) -->
            <button class="btn btn-dark w-50 mb-2" id="addFriendBtn" onclick="addFriend()">Add Friend</button>
        </div>
        
        <div class="col-12">
            <!-- Send Message Button (Placeholder Functionality) -->
            <button class="btn btn-dark w-50" id="sendMessageBtn" onclick="sendMessage()">Direct Messages</button>
        </div>
    </div>
        <script src="profile.js"></script>
    </div>
    </body>
</html>
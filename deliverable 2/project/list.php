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
            <div id="progress-bar-container">
                <div id="progress-bar"></div>
                <!-- <progress id="progress-bar" max="100" value="0"></progress> -->
            </div>

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
            </div>

            <?php
                // list.php
                ini_set('display_errors', 1);
                 error_reporting(E_ALL);

                include "config.php";
                session_start();

                // Check if a list ID is provided in the URL
                if (!isset($_GET['list_id'])) {
                    header("Location: index.php"); // Redirect to the home page if list ID is not provided
                    exit();
                }
                 
                
                    $listID = $_GET['list_id'];

                    // Retrieve the list details from the database
                    $query = "SELECT * FROM lists WHERE id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $listID);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $list = $result->fetch_assoc();

                    // Retrieve a list of available articles 
                    $quer = "SELECT * FROM articles";
                    $res = $conn->query($quer);
                    $articles = $res->fetch_all(MYSQLI_ASSOC);

                    // Handle form submission to add articles to the list
                    if (isset($_POST['add_to_list'])) {
                        $articleID = $_POST['article_id'];

                        // Insert the article ID and list ID into a pivot table
                        $query = "INSERT INTO list_articles (list_id, article_id) VALUES (?, ?)";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("ii", $listID, $articleID);
                        
                        if ($stmt->execute()) {
                            // Redirect to the list page after adding the article
                            header("Location: list.php?list_id=$listID");
                            exit();
                        } else {
                            // Handle the error if the insertion fails
                            echo "Error: " . $stmt->error;
                        }

                        // Close the statement
                        $stmt->close();
                    }


                    // Close the database connection
                    $stmt->close();
                    $conn->close();
            ?>

            <br/>
            <h3>Add Articles to List: <i>"<?php echo $list['name']; ?>"</i></h3>
            <p id="p">Description: <?php echo $list['description']; ?></p>

            <h3>Available Articles</h3>
            <div class="container row">
                <form action="list.php?list_id=<?php echo $listID; ?>" method="POST">
                    <div class="form-group">
                        <select class="form-control" name="article_id">
                            <?php foreach ($articles as $article): ?>
                                <option value="<?php echo $article['id']; ?>"><?php echo $article['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="btn btn-dark mt-3 mb-3" name="add_to_list">Add to List</button>
                    </div>
                </form>

                <br/><br/>

                <!-- <h3>My Lists</h3>
                <ul id="ul">
                    <?php
                    // include "config.php";
                    // // session_start();
                    // // Retrieve the lists created by the user
                    // $query = "SELECT * FROM lists WHERE user_id = ?";
                    // $stmt = $conn->prepare($query);
                    // $stmt->bind_param("i", $_SESSION['id']);
                    // $stmt->execute();
                    // $result = $stmt->get_result();

                    // // Display the lists
                    // while ($row = $result->fetch_assoc()) {
                    //     echo "<li><a href='list.php?list_id={$row['id']}'>{$row['name']}</a></li>";
                    // }

                    // // Close the statement
                    // $stmt->close();
                    ?>
                </ul> -->

            </div>  
            
    </div>
    </body>
</html>
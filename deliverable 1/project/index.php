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
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- favicon -->
        <link rel="icon" type="image/x-icon" href="images/logo.svg">
    </head>
    <body>

        <?php
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
            
            session_start();

            if (!isset($_SESSION['username'])) {
                header('location:login.php'); //no access to index.php if logged out lol
            }
        ?>

        <div class="container">

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
                                <a class="nav-link" href="logout.php">Logout</a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
                


                <!-- search bar :-->
                <!-- <div class="box">
                    <form name="search">
                        <input type="search" class="input" name="txt" placeholder="Search" onmouseout="this.value = ''; this.blur();"> 
                    </form>
                    <i class="fas fa-search"></i>
                </div> -->

            

            <!-- the home feed!! -->
            <main id="main">
            
            <?php
                include "config.php";

            //Fetch articles from the database
            $query = "SELECT * FROM articles ORDER BY date DESC";
            $result = $conn->query($query);

            // Display articles
            while ($row = $result->fetch_assoc()) {
                echo "<div class='card row p-2 mb-5'>";
                echo "<div class='card-body d-flex justify-content-between'>";
                echo "<div class='col-md-4'>";
                echo "<img src='images/starbucks.jpeg' class='card-img-top' alt='Starbucks Image'>";
                echo "</div>";
                echo "<div class='col-md-7'>";
                echo "<h2 class='card-title'>{$row['name']}</h2>";
                echo "<p class='card-text'>{$row['summary']}</p>";
                echo "<p class='card-text'>Date: {$row['date']}</p>"; 
                echo "<p class='card-text'>Hashtags: {$row['hashtags']}</p>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }

            // Close the database connection    
            $conn->close();
            ?>

                <!-- form to upload an article!! -->
                <h2 id="artform"> Create an article below: </h2>

                <form action="index.php" method="POST">
                    <fieldset>
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <label for="regName">Title:</label>
                                <input type="text" id="regName" class="form-control" placeholder="CoffeeBazz Coffee" name="name">
                            </div>

                            <!-- <form action="/upload" method="post" enctype="multipart/form-data">
                            <label for="fileUpload">Select a file:</label>
                            <input type="file" id="fileUpload" name="fileUpload">
                            <input type="submit" value="Upload">
                            </form> -->

                            <div class="col-12 col-lg-6">
                                <label for="image">Upload an Image:</label>
                                <input type="file" id="image" class="form-control" name="image">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 col-lg-12">
                                <label for="summary">Summary:</label>
                                <textarea id="summary" name="summary" rows="4" class="form-control" name="summary"></textarea>
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="date">Date:</label>
                                <input type="date" id="date" class="form-control" name="datey">
                            </div>
                        </div>

                        <div class="col-12 col-lg-12">
                            <label for="hashtags">Hashtags:</label>
                            <input type="text" id="hashtags" class="form-control" placeholder="#coffeeRules" name="hashtags">
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-dark">Post</button>
                            </div>
                        </div>
                        
                    </fieldset>
                </form>
            </main>
        </div>

        <!-- footer -->
        <footer class="text-center text-lg-start">
            <div class="text-center p-4">
                © 2023
                <a class="text-reset fw-bold" href="index.php">beanpedia.com</a>
            </div>
        </footer>

        <?php
            // dealing with article form submission !!
            include "config.php";
            $aname = $_POST["name"];
            // $image = $_POST["image"];
            $summary = $_POST["summary"];
            $datey = $_POST["datey"];
            $hashtags = $_POST["hashtags"];

            
            // if(empty($aname)) die("All fields are required.");
            // // if(empty($image)) die("All fields are required.");
            // if(empty($summary)) die("All fields are required.");
            // if(empty($datey)) die("All fields are required.");
            // if(empty($hashtags)) die("All fields are required.");

            // Prepare and bind the query
            $q = "INSERT INTO articles (name, summary, date, hashtags) VALUES (?, ?, ?, ?)";

            $stmt = $conn->prepare($q);
            $stmt->bind_param("ssss", $aname, $summary, $datey, $hashtags);

            // Execute the query
            if (!$stmt->execute()) {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        ?>
    </body>
</html>
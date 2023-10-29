<?php include "head.php"?>
    <link rel="stylesheet" type="text/css" href="css/style.css"/> 
    <link rel="stylesheet" type="text/css" href="css/index.css"/> 
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

        <!-- the article progress bar thingy -->
            <div id="progress-bar-container">
                <div id="progress-bar"></div>
                <!-- <progress id="progress-bar" max="100" value="0"></progress> -->
            </div>

        
            <?php include "header.php";?>
                
            <!-- search bar :-->
            <form class="mb-3" action="search.php" method="GET">
                <input type="text" name="q" placeholder="Search..." />
                <select name="search_type">
                    <option value="articles">Articles</option>
                    <option value="date">Date</option>
                    <option value="summary">Summary</option>
                    <option value="hashtags">Hashtags</option>
                </select>
                <button type="submit">Search</button>
            </form>
                        

            <!-- the home feed!! -->
            <main id="main">
            
            <?php
            
            include "config.php";

            // Fetch articles from the database
            $query = "SELECT * FROM articles ORDER BY date DESC";
            $result = $conn->query($query);

            
            // Display articles
            while ($row = $result->fetch_assoc()) {
                
                //fetching users from database
                $usid = $row['user_id'];
                $articleCreatorQuery = "SELECT * FROM users WHERE id = '$usid'";
                $articleCreatorResult = $conn->query($articleCreatorQuery);
                $articleCreator = $articleCreatorResult->fetch_assoc();

                echo "<div class='card row p-2 mb-5'>";
                echo "<div class='card-body d-flex justify-content-between'>";
                echo "<div class='col-md-4'>";


                // Check if an image path is available
                if (!empty($row['image_path'])) {
                    echo "<img src='uploads/{$row['image_path']}' class='card-img-top' alt='{$row['name']} Image'>";
                } else {
                    // Display a default image or a placeholder image if no image is available
                    echo "<img src='images/starbucks.jpeg' class='card-img-top' alt='Placeholder Image'>";
                }
                
                echo "</div>";
                echo "<div class='col-md-7'>";
                echo "<h2 class='card-title'><a href='articles.php?id={$row['id']}'>{$row['name']}</a></h2>";
                
                // Check if the logged-in user is the creator of this article  
                if ($row['user_id'] == $_SESSION['id']) {
                    echo "<a class='editing mb-3 mt-3' href='edit_article.php?id={$row['id']}'>Edit</a>";
                }
                else {
                    echo "<p class='editing mb-3 mt-3'>Created by: <a href='profile.php?user_id={$row['user_id']}'>{$articleCreator['name']} {$articleCreator['surname']}</a></p>";
                }
                
                echo "<p class='card-text'>Date: {$row['date']}</p>"; 
                echo "<p class='card-text'>Hashtags: {$row['hashtags']}</p>";
                echo "<p class='card-text'>Category: {$row['category']}</p>";

                $summary = $row['summary'];
                $summaryWords = str_word_count($summary, 1);
                $summaryLimited = implode(' ', array_slice($summaryWords, 0, 50)); 
                echo "<p class='card-text'>$summaryLimited...</p>";
                
                // Display Rating and Review Form
                echo "<div class='row mt-3'>";
                echo "<div class='col-12'>";
                echo "<form action='index.php' method='POST'>";
                echo "<input type='hidden' name='article_id' value='{$row['id']}'>"; // Pass the article_id in a hidden field
                //Rating Slider
                echo "<div class='form-group slider'>";
                echo "<label for='fader' class='text-dark'>Rating:</label>";
                echo "<input type='range' name='rating' min='0' max='100' value='50' id='fader' step='20' list='volsettings'>";
                echo "<datalist id='volsettings'><option>0</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option></datalist>";
                echo "</div>";
                // echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='review' class='text-dark'>Review:</label>";
                echo "<textarea id='review' class='form-control' name='review' rows='2'></textarea>";
                echo "</div><br/>";
                echo "<button type='submit' class='btn btn-dark' name='submit_rating_review'>Submit Rating & Review</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";

                echo "</div>";
                echo "</div>";
                echo "</div>";

            }
            
            
            // echo $id;

            // Close the database connection    
            $conn->close();
            ?>

                <!-- form to upload an article!! -->
                <h2 id="artform"> Create an article below: </h2>

                <form action="index.php" method="POST" enctype="multipart/form-data">
                    <fieldset>
                        
                        <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <label for="regName">Title:</label>
                                <input type="text" id="regName" class="form-control" placeholder="CoffeeBazz Coffee" name="name"/>
                            </div>

                            <form action="/upload" method="post" enctype="multipart/form-data">
                            <label for="fileUpload">Select a file:</label>
                            <input type="file" id="fileUpload" name="fileUpload">
                            <input type="submit" value="Upload">
                            </form>

                            <!-- <div class="col-12 col-lg-6">
                                <label for="image">Upload an Image:</label>
                                <input type="file" id="image" class="form-control" name="image">
                            </div> -->
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

                        <div class="col-12 col-lg-12">
                            <label for="categories">Category:</label>
                            <select name="category_type">
                                <option value="Cafe Bakery">Cafe Bakery</option>
                                <option value="Pop-up Cafe">Pop-up Cafe</option>
                                <option value="Themed Cafe">Themed Cafe</option>
                            </select>
                        </div>

                        <div class="row mt-3">
                            <!-- <div class="col-12"> -->
                                <button type="submit" class="btn btn-dark justify-content-center" name="submit">Post</button>
                            <!-- </div> -->
                        </div>
                        </div>
                    </fieldset>
                </form>

                <br/><br/>

                <!-- CREATION OF LIST -->
                <h2>Create a List Below:</h2>
                <div class="container">
                    <form action="create_list.php" method="POST">
                        <fieldset>
                            <div class="row">
                                <label for="list_name">List Name:</label>
                                <input type="text" id="list_name" name="list_name" required>

                                <label for="list_description">Description:</label>
                                <textarea id="list_description" name="list_description" rows="4"></textarea><br/><br/>
                                
                                <!-- <div class="col-12"> -->
                                    <button type="submit" class="btn btn-dark mt-3" name="create_list">Create List</button>
                                <!-- </div> -->
                            </div>
                    </fieldset>
                    </form>
                </div>
            </main>
        </div>


        
            <!-- footer -->
        <?php
            include "footer.php";

            // dealing with article form submission !!
            if(isset($_POST['submit'])){
                include "config.php";
                $aname = $_POST["name"];
                $summary = $_POST["summary"];
                $datey = $_POST["datey"];
                $hashtags = $_POST["hashtags"];
                $category = $_POST["category_type"];
                // $pic = $_POST["fileUpload"];
                $targetDirectory = "uploads/";  // Define the directory where uploaded images will be stored
                $targetFile = $targetDirectory . basename($_FILES["fileUpload"]["name"]);  // Get the filename
                $uploadOK = 1;
                $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
                
                // Handle the uploaded image
                
                // Check if an image file was uploaded
                // if (!empty($_FILES["image"]["tmp_name"]) && is_uploaded_file($_FILES["image"]["tmp_name"])) {
                    if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $targetFile)) {
                        // Image uploaded successfully
                    
                        // Save the file path in your database
                        // $imagePath = $targetFile; // This is the path where the uploaded image is stored

                        //This is to get the USER id
                        $sname = $_SESSION['surname'];
                        $quer = "SELECT * FROM users WHERE surname = '$sname'";
                        $resul = $conn->query($quer);
                        $ro = $resul->fetch_assoc();
                        $id = $ro['id'];

                        $image = basename($_FILES["fileUpload"]["name"],".jpg");

                        
                        //INSERTING A NEW ARTICLE TO DATABASE
                        $q = "INSERT INTO articles (name, summary, date, hashtags, category, image_path, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
                        
                        $stmt = $conn->prepare($q);
                        // $that = 'nothing for now';
                        $stmt->bind_param("sssssss", $aname, $summary, $datey, $hashtags, $category, $image, $id);  // Store the image path

                        
                        // Execute the query
                        if (!$stmt->execute()) {
                            echo "Error: " . $stmt->error;
                        }
                    
                        // Close the statement
                        $stmt->close();
                    
                        // Redirect the user to a success page or display a success message
                        header("Location: index.php?success=1");
                    } else {
                        echo "Error uploading the image.";
                    }
                // }                    
            }            
            
            //DEALING WITH THE RATINGS!!!
            if (isset($_POST['submit_rating_review'])) {
                include "config.php";
                
                //This is to get the USER id
                $sname = $_SESSION['surname'];
                $quer = "SELECT * FROM users WHERE surname = '$sname'";
                $resul = $conn->query($quer);
                $ro = $resul->fetch_assoc();
                $id = $ro['id'];

                // Retrieve data from the form
                $articleId = $_POST['article_id'];
                $userId = $id; // Use the user_id from your session
                $rating = $_POST['rating'];
                $review = $_POST['review'];
                
                // Insert the rating and review into the ratings_reviews table
                $query = "INSERT INTO ratings_reviews (article_id, user_id, rating, review) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("iiis", $articleId, $userId, $rating, $review);
                
                // Execute the query
                if (!$stmt->execute()) {
                    echo "Error: " . $stmt->error;
                }
                
                // Close the statement
                $stmt->close();
            }
        ?>

        <script src="js/index.js"></script>
    </body>
</html>
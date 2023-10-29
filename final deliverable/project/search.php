<?php include "head.php";?>
<link rel="stylesheet" type="text/css" href="css/style.css"/> 
<link rel="stylesheet" type="text/css" href="css/index.css"/> 
</head>
<body>
    <div class="container">
        <!-- the article progress bar thingy -->
        <div id="progress-bar-container">
                <div id="progress-bar"></div>
                <!-- <progress id="progress-bar" max="100" value="0"></progress> -->
            </div>

    <?php
        include "header.php";
        include "config.php"; // Connect to database script


    if (isset($_GET['q']) && isset($_GET['search_type'])) {
        $searchTerm = $_GET['q'];
        $searchType = $_GET['search_type'];

        // Perform a search based on the selected search type
        switch ($searchType) {
            case "articles":
                // Perform a fuzzy search for articles by name
                $query = "SELECT * FROM articles WHERE name LIKE ? ORDER BY date DESC";
                $stmt = $conn->prepare($query);
                $searchTerm = '%' . $searchTerm . '%';
                $stmt->bind_param("s", $searchTerm);
                
                break;
            case "date":
                // Perform a fuzzy search for users by name, username, or email
                $query = "SELECT * FROM articles WHERE date LIKE ? ORDER BY date DESC";
                $stmt = $conn->prepare($query);
                $searchTerm = '%' . $searchTerm . '%';
                $stmt->bind_param("s", $searchTerm);
                break;
            case "summary":
                // Perform a fuzzy search for users by name, username, or email
                $query = "SELECT * FROM articles WHERE summary LIKE ? ORDER BY date DESC";
                $stmt = $conn->prepare($query);
                $searchTerm = '%' . $searchTerm . '%';
                $stmt->bind_param("s", $searchTerm);
                break;
            case "hashtags":
                // Perform a fuzzy search for hashtags
                $query = "SELECT * FROM articles WHERE hashtags LIKE ? ORDER BY name ASC";
                $stmt = $conn->prepare($query);
                $searchTerm = '%' . $searchTerm . '%';
                $stmt->bind_param("s", $searchTerm);
                break;
            default:
            if (!isset($_GET['q']) || !isset($_GET['search_type'])) {
                echo "<p>Invalid search request. Please provide both a search query and select a search type.</p>";
                echo "<br>";
                echo "<a href='index.php' class='btn btn-secondary'>Go back to home page</a>";
            }
            
        }

        $stmt->execute();
        $result = $stmt->get_result();
        
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
            // if (!empty($row['image_path'])) {
            //     echo "<img src='{$row['image_path']}' class='card-img-top' alt='{$row['name']} Image'>";
            // } else {
                // Display a default image or a placeholder image if no image is available
                echo "<img src='images/starbucks.jpeg' class='card-img-top' alt='Placeholder Image'>";
            // }
            
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
    } else {
        echo "Invalid search request. Please provide both a search query and select a search type.";
        echo "<br>";
        echo "<a href='index.php' class='btn btn-secondary'>Go back to home page</a>";
    }
        include "footer.php";

        $conn->close();
    ?>
    </div>
    <script src="js/index.js"></script>
</body>
</html>
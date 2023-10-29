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
        include "config.php";

        if (isset($_GET['id'])) {
            $articleId = $_GET['id'];

            // Fetch the article by its ID
            $query = "SELECT * FROM articles WHERE id = $articleId";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                $article = $result->fetch_assoc();
                

                echo "<div class='card p-2 mb-5'>";
                echo "<div class='card-body justify-content-between'>";

                echo "<div class='row col-md-6 mb-3'>";

                // Check if an image path is available
                // if (!empty($row['image_path'])) {
                //     echo "<img src='{$row['image_path']}' class='card-img-top' alt='{$row['name']} Image'>";
                // } else {
                    // Display a default image or a placeholder image if no image is available
                    echo "<img src='images/starbucks.jpeg' class='card-img-top' alt='Placeholder Image'>";
                // }
                
                echo "</div>";
                echo "<div class='row col-10'>";
                echo "<h1 class='card-title'>{$article['name']}</h1>";


                echo "<p class='card-text'>Date: {$article['date']}</p>"; 
                echo "<p class='card-text'>Hashtags: {$article['hashtags']}</p>";

                // echo "<img src='images/starbucks.jpeg' width='50%' alt='Article Image'>"; 
                echo "<p class='card-text'>{$article['summary']}</p>";

                // Display Ratings and Reviews
                echo "<h2>Ratings and Reviews</h2>";
                $ratingsQuery = "SELECT * FROM ratings_reviews WHERE article_id = $articleId ORDER BY id DESC";
                $ratingsResult = $conn->query($ratingsQuery);

                if ($ratingsResult->num_rows > 0) {
                    while ($ratingReview = $ratingsResult->fetch_assoc()) {
                        echo "<p>Rating: {$ratingReview['rating']}</p>";
                        echo "<p>Review: {$ratingReview['review']}</p>";
                    }
                    $ratingsQuery = "SELECT AVG(rating) FROM ratings_reviews WHERE article_id = $articleId;";
                    $ratingsResult = $conn->query($ratingsQuery);
                    echo "<p>Average Rating: {$ratingsResult->fetch_assoc()['AVG(rating)']}</p>";
                } else {
                    echo "<p>No ratings or reviews available for this article.</p>";
                }

                echo "</div>";
            } else {
                echo "<p>Article not found.</p>";
            }
        } else {
            echo "<p>Invalid article ID.</p>";
        }

        include "footer.php";

        $conn->close();
    ?>
    </div>
    <script src="js/index.js"></script>
</body>
</html>
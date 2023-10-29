<?php include "head.php";?>

        <link rel="stylesheet" type="text/css" href="css/style.css"/> 
        <link rel="stylesheet" type="text/css" href="css/index.css"/> 
       
    </head>

    <body>        
        <h2 class="mt-2">Edit an Article</h2>
         <?php
            ini_set('display_errors', 1);
            error_reporting(E_ALL);

            include "config.php";

            // Get the article ID from the URL
            $articleId = $_GET['id'];

            // Fetch the article data from the database
            $query = "SELECT * FROM articles WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $articleId);
            $stmt->execute();
            $result = $stmt->get_result();
            $article = $result->fetch_assoc();

            if (isset($_POST['submit'])) {
                $newName = $_POST['name'];
                $newSummary = $_POST['summary'];
                $newDate = $_POST['date'];
                $newHashtags = $_POST['hashtags'];

                $updateQuery = "UPDATE articles SET name=?, summary=?, date=?, hashtags=? WHERE id=?";
                $stmt = $conn->prepare($updateQuery);
                $stmt->bind_param("ssssi", $newName, $newSummary, $newDate, $newHashtags, $articleId);
                if ($stmt->execute()) {
                    header("Location: index.php?success=1");
                } else {
                    // Handle the error
                    echo "Error: " . $stmt->error;
                }
            }

            if (isset($_POST['delete'])) {
                $deleteListArticlesQuery = "DELETE FROM list_articles WHERE article_id = ?";
                $stmtListArticles = $conn->prepare($deleteListArticlesQuery);
                $stmtListArticles->bind_param("i", $articleId);
                
                if ($stmtListArticles->execute()) {
                    $deleteRatingsQuery = "DELETE FROM ratings_reviews WHERE article_id = ?";
                    $stmtRatings = $conn->prepare($deleteRatingsQuery);
                    $stmtRatings->bind_param("i", $articleId);
                    
                    if ($stmtRatings->execute()) {
                        $deleteArticleQuery = "DELETE FROM articles WHERE id = ?";
                        $stmtDeleteArticle = $conn->prepare($deleteArticleQuery);
                        $stmtDeleteArticle->bind_param("i", $articleId);
                        
                        if ($stmtDeleteArticle->execute()) {
                            header("Location: index.php?deleted=1");
                        } else {
                            echo "Error: " . $stmtDeleteArticle->error;
                        }
                    } else {
                        echo "Error: " . $stmtRatings->error;
                    }
                } else {
                    echo "Error: " . $stmtListArticles->error;
                }
            }


        ?>
        <form action="edit_article.php?id=<?php echo $articleId; ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-12 col-lg-6">
                        <label for="name">Title:</label>
                        <input type="text" id="name" class="form-control" name="name" value="<?php echo $article['name']; ?>">
                    </div>
                    <div class="col-12 col-lg-6">
                        <label for="image">Upload an Image:</label>
                        <input type="file" id="image" class="form-control" name="image">
                    </div>
                    <div class="form-group col-12 col-lg-12">
                        <label for="summary">Summary:</label>
                        <textarea id="summary" class="form-control" name="summary"><?php echo $article['summary']; ?></textarea>
                    </div>
                    <div class="form-group col-12 col-lg-6">
                        <label for="date">Date:</label>
                        <input type="date" id="date" class="form-control" name="date" value="<?php echo $article['date']; ?>">
                    </div>
                    <div class="form-group col-12 col-lg-12">
                        <label for="hashtags">Hashtags:</label>
                        <input type="text" id="hashtags" class="form-control" name="hashtags" value="<?php echo $article['hashtags']; ?>">
                    </div>

                    <button type="submit" class="btn btn-dark mx-3 mt-3 col-3 justify-content-center" name="submit">Save Changes</button>
                </div>
        </form>

        <form action="edit_article.php?id=<?php echo $articleId; ?>" method="POST">
            <button type="submit" class="btn btn-danger mt-3 col-3" name="delete">Delete Article</button>
        </form>
        
    </body>
</html>
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
        <h2 class="mt-2">Edit an Article</h2>
        <!-- Display the edit form pre-filled with existing data -->
         <?php
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
            // var_dump($article);

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

            // Check if the logged-in user is the creator of this article
            // if ($article['user_id'] != $_SESSION['user_id']) {
            //     header('location: index.php'); // Redirect if they don't have permission
            // }

            // Handle the edit form submission
            if (isset($_POST['submit'])) {
                // Retrieve the updated article data from the form
                $newName = $_POST['name'];
                $newSummary = $_POST['summary'];
                $newDate = $_POST['date'];
                $newHashtags = $_POST['hashtags'];

                // Update the article in the database
                $updateQuery = "UPDATE articles SET name=?, summary=?, date=?, hashtags=? WHERE id=?";
                $stmt = $conn->prepare($updateQuery);
                $stmt->bind_param("ssssi", $newName, $newSummary, $newDate, $newHashtags, $articleId);
                if ($stmt->execute()) {
                    // Redirect back to the index page or show a success message
                    header("Location: index.php?success=1");
                } else {
                    // Handle the error
                    echo "Error: " . $stmt->error;
                }
            }
        ?>
        <form action="edit_article.php?id=<?php echo $articleId; ?>" method="POST" enctype="multipart/form-data">
            <!-- <fieldset> -->
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
            <!-- </fieldset> -->
        </form>

       
    </body>
</html>
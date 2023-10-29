<?php include "head.php";?>

        <link rel="stylesheet" type="text/css" href="css/style.css"/> 
        <link rel="stylesheet" type="text/css" href="css/index.css"/> 
    </head>
    <body>
        <div class="container">
            <div id="progress-bar-container">
                <div id="progress-bar"></div>
                <!-- <progress id="progress-bar" max="100" value="0"></progress> -->
            </div>

            <?php include "header.php";?>

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
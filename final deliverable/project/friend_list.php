<?php include "head.php"?>

        <link rel="stylesheet" type="text/css" href="css/style.css"/> 
        <link rel="stylesheet" type="text/css" href="css/index.css"/> 
       
    </head>
	
<body>
<?php include "header.php"?>

    <div class="container mt-3">
        <h2>Your Friends</h2>

        <?php
            session_start();
            include "config.php"; 

            if (!isset($_SESSION['id'])) {
                header("HTTP/1.1 403 Forbidden");
                exit();
            }

            //retrieve the list of friends (users being followed) for the logged-in user
            $userId = $_SESSION['id'];
            $query = "SELECT users.id, users.username FROM follows
                    INNER JOIN users ON follows.following_id = users.id
                    WHERE follows.follower_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $userId);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $friends = [];

                while ($row = $result->fetch_assoc()) {
                    $friends[] = $row;
                }

                foreach ($friends as $friend) {
                    echo '<a href="profile.php?user_id=' . $friend['id'] . '" class="list-group-item list-group-item-action">' . $friend['username'] . '</a>';
                }
            } else {
                echo '<li class="list-group-item">No friends found :(</li>';
            }
        ?>

    </div>
</body>
</html>
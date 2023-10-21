<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/sign.css" />

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 	crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="images/logo.svg">
</head>
<body class="body">
    <div class="container before-index">
        <img class="logo" src="images/logo.svg" alt="beanpedia logo" width="50px"><br/>
		<section id="forms">
            <div class="d-flex justify-content-center align-items-center min-vh-100 ">
                <!-- <div class="row col-12">
                    LOGO HERE
                </div> -->
                <div class="row col-12 mx-auto">
                    <!-- LOGIN CARD -->
                    <div class="card log">
                        <div class="card-header">Login</div>
                        <div class="card-body">
                            <form action="validate-login.php" method="POST">
                                <fieldset>
                                <div class="row">
										<div class="col-12 col-lg-12">
											<label for="user">Username:</label>
											<input type="text" id="user" class="form-control" placeholder="johnapple" name="user">
										</div>
										<div class="col-12 col-lg-12">
											<label for="pass">Password:</label>
											<input type="password" id="pass" class="form-control" placeholder="******" name="pass">
										</div>
									</div>
									<div class="row mt-3">
										<div class="col-12">
											<button type="submit" class="btn btn-dark">Login</button>
										</div>
									</div>

                                    <div class="row mt-2 ml-1"> 
                                        <p>Don't have an account yet? <a href="signup.php" class="register_here">Register here.</a></p>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
		</section>
	</div>
    <!-- footer
    <footer class="text-center text-lg-start">
        <div class="text-center p-4">
            © 2023
            <a class="text-reset fw-bold" href="index.php">beanpedia.com</a>
        </div>
    </footer> -->
    <script src="login.js"></script>
</body>
</html>


<?php
    //user details incorrect. retry.
    if (isset($_GET['error']) && $_GET['error'] == "invalid_login") {
        echo "Please enter the correct email or password.";
    }

    if (isset($_GET['error']) && $_GET['error'] == "empty_fields") {
        echo "Please enter an email or password.";
    }
?>
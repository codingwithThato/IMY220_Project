<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
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

                <!-- SIGNUP CARD -->
                    <div class="card log">
                        <div class="card-header">Register</div>
                        <div class="card-body">
                            <form action="validate-signup.php" method="POST">
                                <fieldset>
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <label for="regName">First Name:</label>
                                            <input type="text" id="regName" class="form-control" placeholder="Johnny" name="fname">
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="regSurname">Last Name:</label>
                                            <input type="text" id="regSurname" class="form-control" placeholder="Appleseed" name="lname">
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-12 col-lg-6">
                                            <label for="user">Username:</label>
                                            <input type="text" id="user" class="form-control" placeholder="johnapple" name="user">
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="regContact">Contact:</label>
                                            <input type="text" id="contact" class="form-control" placeholder="0836748990" maxlength="10" name="contact">
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-12 col-lg-12">
                                            <label for="email">Email Address:</label>
                                            <input type="email" id="email" class="form-control" placeholder="johnny.appleseed@gmail.com" name="email">
                                        </div>
                                        <!-- <div class="col-12 col-lg-6">
                                            <label for="regBirthDate">Date of Birth:</label>
                                            <input type="date" id="regBirthDate" class="form-control" name="date">
                                        </div> -->
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-lg-12">
                                            <label for="pass">Create Password:</label>
                                            <input type="password" id="pass" class="form-control" placeholder="******" name="pass">
                                        </div>
                                    </div>


                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-dark">Register</button>
                                        </div>
                                    </div>
                                    <div class="row mt-2 ml-1"> 
                                        <p>Already have an account?  <a href="login.php" class="login_here">Login here.</a></p>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
		</section>
	</div>

    <script src="signup.js"></script>
</body>
</html>

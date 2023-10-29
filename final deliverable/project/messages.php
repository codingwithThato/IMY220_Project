<?php include "head.php";?>

        <link rel="stylesheet" type="text/css" href="css/style.css"/> 
        <link rel="stylesheet" type="text/css" href="css/index.css"/> 
        <link rel="stylesheet" type="text/css" href="css/messages.css"/> 
    </head>
	
<body>
    <div class="container">
        <?php include "header.php"?>
		<h1 class="mt-3 mb-3">Send message</h1>
		<div class="row">

			<div class="col">
				<label for="exampleFormControlTextarea1">Type a message and hit send</label>
				<textarea class="form-control" id="message" name = "message" rows="3"></textarea>
				<button id="right" type="submit" class="btn btn-dark submit offset-11">Send</button>
			</div>
		</div>
		<div class="messages"></div>
	</div>
	<script src="js/messages.js"></script>
</body>
</html>
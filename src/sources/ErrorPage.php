<!DOCTYPE html>
<html>

<head>
	<title>CreateAccountPage</title>
	<link rel="stylesheet" type="text/css" href="../styles/ErrorPage.css">
	<script src="../scripts/ErrorPage.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

	<div class="loginbox">
		
			<a href="HomePage2.php" target=_self>
				<img src="../images/avatar2.png" class="avatar">
			</a>
			<h1 >Oops... something went wrong </h1>
			<br>
			<?php
    			session_start();
				
				if(isset($_SESSION['error'])){
					echo $_SESSION['error'];
					unset($_SESSION['error']);
				}
				else{
					echo "<p><kbd>Your error messages expired!</kbd></p>";
				}
			?>
			<br>
			<br>
			<button class="buton float-right" onclick="goBack()" > Go back!</button>
	</div>
</body>





</html>
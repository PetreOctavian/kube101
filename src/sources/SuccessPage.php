<!DOCTYPE html>
<html>

<head>
	<title>CreateAccountPage</title>
	<link rel="stylesheet" type="text/css" href="../styles/SuccessPage.css">
	<script src="../scripts/SuccessPage.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

	<div class="loginbox">
		
			<a href="HomePage2.php" target=_self>
				<img src="../images/avatar2.png" class="avatar">
			</a>
			<br>
			<h1>Welcome to WingFree!</h1>
			<br>
			
			<?php				
				session_start();
				$loginpage_path = "'LoginPage.html'";

				if(isset($_SESSION['amail'])){
					
					echo '<p><kbd>';
					echo $_SESSION['amail'];
					echo '</kbd></p>';
					
					unset($_SESSION['amail']);	
					echo '<br>
					<br>
					<br>
					<button class="buton float-left" onclick="window.location.href='. $loginpage_path .'" >Login again</button>
					<button class="buton float-right" onclick="goBack()" >Go back!</button>';
					exit();
						
				}
				//if any kind of edit is successful then an auto logout will be executed
				if(isset($_SESSION['update']))
				{
					echo '<p><kbd>' . $_SESSION['update'] . '</kbd></p>';
					unset($_SESSION['update']);
					echo '<p><kbd>After updating any kind of user profile data an auto logout will occur, so please login again.</kbd></p>';
					//log out after update
					include_once '../phps/SQL_Connection.php';
					if(isset($_SESSION['connected_user_ID']))
					{
						$id = $_SESSION['connected_user_ID'];        
						$sql_update_after_update = "UPDATE logindata SET `connection status`='offline' WHERE `ID` = '$id' and `connection status` = 'online'";
						$query_update_after_update = mysqli_query($conn,$sql_update_after_update);
						if(!$query_update_after_update)
						{
							exit("Couldn't update data base after update (log out)");
						}
						mysqli_close($conn);
						//session_unset(); 
						//session_destroy();	
						unset($_SESSION['connected_user_ID']);				
					
					}					
					echo '<br>
					<br>
					<br>
					<button class="buton float-left" onclick="window.location.href='. $loginpage_path .'" >Login </button>';
					//<button class="buton float-right" onclick="goBack()" >Go back!</button>';
					exit();
				}
				

				if(isset($_SESSION['transaction']))
				{
					echo '<p><kbd>' . $_SESSION['transaction'] . '</kbd></p>';
					unset($_SESSION['transaction']);
					echo '<br>
					<br>
					<br>
					<button class="buton float-right" onclick="goBack()" >Go back!</button>';
					exit();
				}
					
				echo "<p><kbd>Your update or account mail validation  messages expired!</kbd></p>";
				echo '<br>
				<br>
				<br>
				<button class="buton float-right" onclick="goBack()" >Go back!</button>';
										
			?>


			
	</div>
</body>

</html>
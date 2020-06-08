
<!DOCTYPE html>
<html>
<head>
	<title>EditProfilePage</title>
	<link rel="stylesheet" type="text/css" href="../styles/EditProfilePage.css">
	<script src="../scripts/EditProfilePage.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

	<div class="loginbox">
		
		<a href="HomePage2.php" target=_self ><img src="../images/avatar2.png"  class="avatar"></a>
		<h1>Edit profile here</h1>
		<center>
			<form action="../phps/EditProfilePage.php" method="POST" onsubmit="validare()"> <!--onsubmit="validare();" action="../phps/EditProfilePage.php" method="POST"-->
				
				<?php
					include_once '../phps/SQL_Connection.php';
					session_start();
					if (isset($_SESSION['connected_user_ID'])) {
						$id = $_SESSION['connected_user_ID'];
						$sql_get_connected_user_data_from_ID = "SELECT * from logindata where `ID` = '$id'";
						$query_get_connected_user_data_from_ID = mysqli_query($conn, $sql_get_connected_user_data_from_ID);
						if (!$sql_get_connected_user_data_from_ID) {
							exit("Couln't extract data from logged user based on his id for editprofilepage");
						}
						$final = mysqli_fetch_assoc($query_get_connected_user_data_from_ID);
						echo '<p class="welkomen">Welcome <kbd>' . $final['username'] . '</kbd> !</p>';
					}
					mysqli_close($conn);
				?>
				<input type="email" placeholder="Enter New Email" name="edit_email" >
				<input type="password" placeholder="Enter New Password" name="edit_pass">
				<input type="password" placeholder="Repeat New Password" name="edit_repass">
				<input type="text" placeholder="Enter New First name" name="edit_fname">
				<input type="text" placeholder="Enter New Last name" name="edit_lname">
				<input type="text" placeholder="Enter New Address" name="edit_add">
				<input type="text" placeholder="Enter New Telephone number" name="edit_tel">

				<input type="submit" name="submit" value="Update profile">
				<input type="reset" class="clearfix" value="Cancel">
				<p>Now try to connect with the new credentials. <a href="LoginPage.html">Sign in.</a></p>
				
			</form>
		</center>
	</div>
</body>
</html>


<?php 
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
?>

<!DOCTYPE html>
<html>	
<head>

</head>
<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
	<a class="navbar-brand" href="../sources/HomePage2.php">
		<img class=" logo_img" src="../images/avatar2.png" alt="logo" >
	</a>
	<a class="navbar-brand" href="../sources/ShoppingCart.php">
		<img class=" logo_img" src="../images/avatar3.jpg" alt="logo" >
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse ml-auto" id="navbarNav">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item mx-sm-2">
				<a class="nav-link" href="../sources/AllFlights.php">All Flights</a>
			</li>
			<li class="nav-item mx-sm-2">
				<a class="nav-link" href="../sources/Destinations.php">Destinations</a>
			</li>
			<li class="nav-item mx-sm-2">
				<a class="nav-link" href="../sources/DetailsPage.php">Details</a>
			</li>

			<?php 
				if(!isset($_SESSION['connected_user_ID'])){ 
					//if guest
					echo '<li class="nav-item mx-sm-2">
					<a class="nav-link" href="LoginPage.html">Sign in</a>
					</li>';
					echo '<li class="nav-item mx-sm-2">
					<a class="nav-link" href="CreateAccountPage.html">Create account</a>
					</li>';
					echo '<c class="nav-link mx-sm-2" align="center">Visit as <kbd> guest </kbd></c>';
				}
				else {		
					//if logged in
					include_once '../phps/SQL_Connection.php';
					$id = $_SESSION['connected_user_ID'];
					$sql_get_connected_user_data_from_ID = "SELECT * from logindata where `ID` = '$id'";
					$query_get_connected_user_data_from_ID = mysqli_query($conn,$sql_get_connected_user_data_from_ID);
					if(!$query_get_connected_user_data_from_ID)
					{
						exit("Couln't extract data from logged user based on his id for navbar");
					}
					$final = mysqli_fetch_assoc($query_get_connected_user_data_from_ID);
					
					echo '<li class="nav-item mx-sm-2">
					<a class="nav-link" href="../phps/Transactions.php">Transactions</a>
					</li>';
					echo '<li class="nav-item mx-sm-2">
					<a class="nav-link" href="../phps/LogoutPage.php">Sign out</a>
					</li>';
					echo '<li class="nav-item mx-sm-2">
					<a class="nav-link" href="EditProfilePage.php">Edit profile</a>
					</li>';
					echo '<c  class="nav-link mx-sm-2" align="center">Logged in as <kbd>' . $final['username'] . '</kbd> (' . $final['user type'] . ')</c>';				
				}			
			?>
		</ul>
	</div>
</nav>
</html>
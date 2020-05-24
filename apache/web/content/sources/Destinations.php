<!DOCTYPE html>
<html>
<head>
	<head>
		<title>Destinations</title>
		<link rel="stylesheet" type="text/css" href="../styles/Destinations.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="../scripts/AllFlights.js"></script>

		<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYyns3ehc1GEsMTJ2r8nVqv51f6pxVnyg&callback=initMap"
		type="text/javascript"></script>
	</head>
</head>
<body>

	<?php  
		include("../sources/Navbar.php");
		include_once '../phps/SQL_Connection.php';
	?>
	<!--<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
		<a class="navbar-brand" href="../sources/HomePage2.html">
			<img class=" logo_img" src="../images/avatar2.png" alt="logo" >
		</a>
		<a class="navbar-brand" href="ShopingCart.html">
			<img class=" logo_img" src="../images/avatar3.jpg" alt="logo" >
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse ml-auto" id="navbarNav">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item mx-sm-2">
					<a class="nav-link" href="#">Booking</a>
				</li>
				<li class="nav-item mx-sm-2">
					<a class="nav-link" href="../sources/AllFlights.html">Route map</a>
				</li>
				<li class="nav-item mx-sm-2">
					<a class="nav-link" href="Destinations.html">Destinations</a>
				</li>
				<li class="nav-item mx-sm-2">
					<a class="nav-link" href="../sources/LoginPage.html">Sign in</a>
				</li>
				<li class="nav-item mx-sm-2">
					<a class="nav-link" href="EditProfilePage.html">Edit profile</a>
				</li>
			</ul>
			<form class="form-inline my-2 my-lg-0 ">
				<input class="form-control mr-sm-2 input-sm" type="search" placeholder="Search" aria-label="Search">
				<button class="btn btn-outline-warning my-2 my-sm-0 btn-sm" type="submit">Search</button>
			</form>
		</div>
	</nav>-->
	<div class="content mx-5 my-5 ">
	<?php 
		$sql_show_all_destinations = "SELECT `arrival location`, `image path` from flights";
		$query_show_all_destinations = mysqli_query($conn,$sql_show_all_destinations);
		if(!$query_show_all_destinations){
                        die('Invalid query: ' . mysql_error());
			exit("Error at selecting all destination");
		}

		while ($row = mysqli_fetch_assoc($query_show_all_destinations)) {
			$arriv_loc = explode(',',$row['arrival location'],2);
			echo 
			'<div class="gallery">

				<div >
					<img src="' . $row['image path'] . '"  width="600" height="400">
				</div>
				<div class="desc"><p>' . $arriv_loc[0] . '</p><hr><p>' . $arriv_loc[1] . '</p></div>
				
				<form action="../phps/Booking.php?search_loc=' . $arriv_loc[1] . '" method="POST">
					<button type="submit" class="btn_search btn  btn-warning btn-sm mb-1" >Search</button>
				</form> 
			</div>';
		}

	?>
	</div>


	
		<!--<div class="gallery">
			<div >
				<img src="../images/i5.jpg"  width="600" height="400">
			</div>
			<div class="desc">cityname,countryname</div>
			<button type="button" class="btn_search btn  btn-warning btn-sm mb-1" onclick="">Search</button>
		</div>
		<div class="gallery">
			<a target="_blank" href="#">
				<img src="../images/i5.jpg" alt="Cinque Terre" width="600" height="400">
			</a>
			<div class="desc">cityname,countryname</div>
			<button type="button" class="btn btn-info btn-sm mr-1 ml-3 mb-1" onclick="window.location.href='../sources/FlightDetails.html'">Info</button>
			<button type="button" class="btn btn-success btn-sm mb-1" onclick="window.location.href='../sources/ShopingCart.html'">Add to cart</button>
		</div>

		<div class="gallery">
			<a target="_blank" href="#">
				<img src="../images/i5.jpg" alt="Cinque Terre" width="600" height="400">
			</a>
			<div class="desc">cityname,countryname</div>
			<button type="button" class="btn btn-info btn-sm mr-1 ml-3 mb-1" onclick="window.location.href='../sources/FlightDetails.html'">Info</button>
			<button type="button" class="btn btn-success btn-sm mb-1" onclick="window.location.href='../sources/ShopingCart.html'">Add to cart</button>
		</div>

		<div class="gallery">
			<a target="_blank" href="#">
				<img src="../images/i5.jpg" alt="Cinque Terre" width="600" height="400">
			</a>
			<div class="desc">cityname,countryname</div>
			<button type="button" class="btn btn-info btn-sm mr-1 ml-3 mb-1" onclick="window.location.href='../sources/FlightDetails.html'">Info</button>
			<button type="button" class="btn btn-success btn-sm mb-1" onclick="window.location.href='../sources/ShopingCart.html'">Add to cart</button>
		</div>

		<div class="gallery">
			<a target="_blank" href="#">
				<img src="../images/i5.jpg" alt="Cinque Terre" width="600" height="400">
			</a>
			<div class="desc">cityname,countryname</div>
			<button type="button" class="btn btn-info btn-sm mr-1 ml-3 mb-1" onclick="window.location.href='../sources/FlightDetails.html'">Info</button>
			<button type="button" class="btn btn-success btn-sm mb-1" onclick="window.location.href='../sources/ShopingCart.html'">Add to cart</button>
		</div>

		<div class="gallery">
			<a target="_blank" href="#">
				<img src="../images/i5.jpg" alt="Cinque Terre" width="600" height="400">
			</a>
			<div class="desc">cityname,countryname</div>
			<button type="button" class="btn btn-info btn-sm mr-1 ml-3 mb-1" onclick="window.location.href='../sources/FlightDetails.html'">Info</button>
			<button type="button" class="btn btn-success btn-sm mb-1" onclick="window.location.href='../sources/ShopingCart.html'">Add to cart</button>
		</div>

		<div class="gallery">
			<a target="_blank" href="#">
				<img src="../images/i5.jpg" alt="Cinque Terre" width="600" height="400">
			</a>
			<div class="desc">cityname,countryname</div>
			<button type="button" class="btn btn-info btn-sm mr-1 ml-3 mb-1" onclick="window.location.href='../sources/FlightDetails.html'">Info</button>
			<button type="button" class="btn btn-success btn-sm mb-1" onclick="window.location.href='../sources/ShopingCart.html'">Add to cart</button>
		</div>

		<div class="gallery">
			<a target="_blank" href="#">
				<img src="../images/i5.jpg" alt="Cinque Terre" width="600" height="400">
			</a>
			<div class="desc">cityname,countryname</div>
			<button type="button" class="btn btn-info btn-sm mr-1 ml-3 mb-1" onclick="window.location.href='../sources/FlightDetails.html'">Info</button>
			<button type="button" class="btn btn-success btn-sm mb-1" onclick="window.location.href='../sources/ShopingCart.html'">Add to cart</button>
		</div>-->



	





</body>
</html>

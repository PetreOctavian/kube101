<!DOCTYPE html>
<html>
<head>
	<title>FlightDetails</title>
	<link rel="stylesheet" type="text/css" href="../styles/FlightDetails.css">
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
<body>

	<?php  include("../sources/Navbar.php");?>
	
	<?php 
		include_once '../phps/SQL_Connection.php';
		$id =  $_GET['bought_clicked_product_ID'];
		

		$sql_show_all_flights_data = "SELECT *, ADDTIME(`departure date`,`flight duration`) AS `arrival date` FROM flights where `ID`='$id'" ; 
    	$query_show_all_flights_data = mysqli_query($conn,$sql_show_all_flights_data);
    	if(!$query_show_all_flights_data){
        	exit("Error at selecting all flights");
    	}
		
    while ($row = mysqli_fetch_assoc($query_show_all_flights_data)) {

			$dep_time = explode(' ',$row['departure date'],2);
			$arriv_time = explode(' ',$row['arrival date'],2);
			$arriv_loc = explode(',',$row['arrival location'],2);
			if($row['cabin luggage'] != 'NO') $cabinkg = " Kg";
			else $cabinkg="";
			if($row['hold luggage'] != 'NO') $holdkg = " Kg";
			else $holdkg="";
			echo 
			'<div class="container details mt-5">
				<div class="row">
					<div class="container title mx-5">
						<h5>Flight details</h5>
					</div>
				</div>
				<div class="row align-items-center">
					<div class="col float-right">	
						<div class="container thumbnail">
							<img class="pulse departure img-responsive" src="' . $row['image path'] . '" >
		
						</div>
					</div>
					<div class="col float-left">
						<br>		
						<table >
							<tr>
								<th>Flying from</th>
								<td><kbd>' . $row['departure location'] . '</kbd></td>
							</tr>
							<tr>
								<th>Flying to</th>
								<td><kbd>' . $row['arrival location'] . '</kbd></td>
							</tr>
							<tr>
								<th>Duration</th>
								<td><kbd>' . $row['flight duration'] . '</kbd></td>
							</tr>
							<tr>
								<th>Price</th>
								<td><kbd>' . $row['price'] . ' &#8364</kbd></td>
							</tr>
							<tr>
								<th>Departure date</th>
								<td><kbd>' . $dep_time[0] . '</kbd></td>
							</tr>
							<tr>
								<th>Departure time</th>
								<td><kbd>' . $dep_time[1] . '</kbd></td>
							</tr>
							<tr>
								<th>Arrival date</th>
								<td><kbd>' . $arriv_time[0] . '</kbd></td>
							</tr>
							<tr>
								<th>Arrival time</th>
								<td><kbd>' . $arriv_time[1] . '</kbd></td>
							</tr>
							<tr>
								<th>Travel class</th>
								<td><kbd>' . $row['travel class'] . '</kbd></td>
							</tr>
							<tr>
								<th>Cabin luggage</th>
								<td><kbd>' . $row['cabin luggage'] . $cabinkg . '</kbd></td>
							</tr>
							<tr>
								<th>Hold luggage</th>
								<td><kbd>' . $row['hold luggage'] . $holdkg . '</kbd></td>
							</tr>
						</table>
					</div>
		
				</div>
				<hr>

				<div class="row">
					<div class="container title mx-5">
						<h5 >Destination wiki</h5>
					</div>
					<p class="text-justify mx-5 my-3">'
					 . $arriv_loc[0] .' is a city in '
					 . $arriv_loc[1] .'. 
						<a   href="https://en.wikipedia.org/wiki/'. $arriv_loc[0] .'" target="_blank">Find out more here !</a>
					</p>
				</div>
			</div>';
			unset($cabinkg);
			unset($holdkg);
	}
	
	?>
	






	</body>
	</html>
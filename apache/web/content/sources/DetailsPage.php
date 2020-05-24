<!DOCTYPE html>
<html lang="en">

<head>
	<title>DetailsPage</title>

	<link rel="stylesheet" type="text/css" href="../styles/DetailsPage.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="../scripts/DetailsPage.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYyns3ehc1GEsMTJ2r8nVqv51f6pxVnyg&callback=initMap"
	type="text/javascript"></script>

	<meta name="viewport" charset="utf-8" content="width=device-width, initial-scale=1">
</head>

<body>
	<?php  include("../sources/Navbar.php");?>

	<div class="jumbotron mx-3 my-3" style="background-color: white">
		
			<div class="container">
				<div class="row">
					<div class="col">
						<h5>Time schedule</h5>
						<ul>
							<li>Monday-Friday:</li>
							<li>09:00-22:00</li>
							<li>Saturday:</li>
							<li>10:00-16:00</li>
							<li>Sunday:</li>
							<li>closed</li>
						</ul>
					</div>
					<div class="col">
						<h5>Info</h5>
						<ul>
						<li><i class="fa fa-home fa-xs my-2"></i>  Location</li>
						<li>Longyearbyen, Svalbard (Norway)</li>
						<li><i class="fa fa-mobile fa-xs my-2"></i>  Telephone</li>
						<li> 0712345689</li>
						<li><i class="fa fa-envelope fa-xs my-2">  Email</i></li>
						<li><a href="https://www.w3schools.com" target="_blank">wingfree@nw.com</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<h5>Find us on google maps</h5>
						<iframe class="harta" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d521725.81902550114!2d14.746119607062578!3d78.03029195340922!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x15fa4670a5924662!2sRezerva+mondial%C4%83+de+semin%C8%9Be+din+Svalbard!5e0!3m2!1sro!2sro!4v1556910058462!5m2!1sro!2sro" width="1050" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		

	</div>
	

	

</body>
<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>HomePage</title>

	<link rel="stylesheet" type="text/css" href="../styles/HomePage2.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<script src="../scripts/HomePage2.js"></script>
	<script src="../scripts/IncludeNavbar.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYyns3ehc1GEsMTJ2r8nVqv51f6pxVnyg&callback=initMap"
	type="text/javascript"></script>


	
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>


	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


	<meta name="viewport" charset="utf-8" content="width=device-width, initial-scale=1">
</head>

<body class="bg-dark">


	<?php 

	include_once '../phps/SQL_Connection.php';
	session_start();
	if(isset($_SESSION['connected_user_ID'])){

		$id = $_SESSION['connected_user_ID'];
		$sql_get_connected_user_data_from_ID = "SELECT * from logindata where `ID` = '$id'";
        $query_get_connected_user_data_from_ID = mysqli_query($conn,$sql_get_connected_user_data_from_ID);
		if(!$query_get_connected_user_data_from_ID)
		{
			exit("Couln't extract data from logged user based on his id for navbar");
		}
		$final = mysqli_fetch_assoc($query_get_connected_user_data_from_ID);

		$GLOBALS['hp_username'] = $final['username'];
		$GLOBALS['hp_password'] = $final['password'];
		$GLOBALS['hp_email'] = $final['email'];
		$GLOBALS['hp_first_name'] = $final['first name'];
		$GLOBALS['hp_last_name'] = $final['last name'];
		$GLOBALS['hp_adress'] = $final['adress'];
		$GLOBALS['hp_telephone'] = $final['telephone'];
		$GLOBALS['hp_user_type'] = $final['user type'];
		$GLOBALS['hp_validation_status'] = $final['validation status'];
		$GLOBALS['hp_connection_status'] = $final['connection status'];
		
	}
	
?>



	<?php  include("../sources/Navbar.php");?>
	


	<div class="jumbotron mx-3 my-3" style="background-color: #73CAE5;">
		<h1 class="text-center">Welcome to <kbd>WINGFREE 2.2</kbd> </h1>		
	</div>



	<div class="jumbotron bg-dark mx-3 my-3" style="background-image: url(../images/anim.gif);background-size: cover"><div class="container cont_1 bg-transparent my-3" >
		<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
			<div class="row">
				<div class="col bg-transparent ">
					<a class=" carousel-control-prev bg-transparent float-md-right " >
						<span class="carousel-control-prev-icon bg-dark border border-secondary" href="#carouselExampleControls" role="button" data-slide="prev" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
				</div>
				<div class="col-10 ">
					<div class="carousel-inner">
						<div  class="carousel-item active ">
							<div  id="c" class="container bg-transparent">
								<img id="a" class="car-img" src="../images/a1.jpg" alt="First slide">
								<img id="b" class="stamp" src="../images/33off.png">

								<div class="text-block">powerd by wingfree</div>
							</div>
						</div>
						<?php 
							for ($i = 2; $i <= 19; $i++) {
								if($i % 2 == 0){
									echo '	<div  class="carousel-item ">
												<div  id="c" class="container bg-transparent">
													<img id="a" class="car-img" src="../images/a' . $i . '.jpg" alt="First slide">
													<img id="b" class="stamp" src="../images/25off.png">
													<div class="text-block">powerd by wingfree</div>
												</div>
											</div>';
								}
								else{
									echo '	<div  class="carousel-item ">
												<div  id="c" class="container bg-transparent">
													<img id="a" class="car-img" src="../images/a' . $i . '.jpg" alt="First slide">
													<img id="b" class="stamp" src="../images/33off.png">
													<div class="text-block">powerd by wingfree</div>
												</div>
											</div>';
								}
								
							}
						?>
						<div class="carousel-item ">
							<div class="container">
								<img class="car-img" src="../images/a2.jpg" alt="First slide">
							</div>
						</div>
						<div class="carousel-item">
							<div class="container">
								<img class="car-img" src="../images/a3.jpg" alt="First slide">
							</div>
						</div>
						<div class="carousel-item ">
							<div class="container">
								<img class="car-img" src="../images/a4.jpg" alt="First slide">
							</div>
						</div>
						<div class="carousel-item">
							<div class="container">
								<img class="car-img" src="../images/a5.jpg" alt="First slide">
							</div>
						</div>
						<div class="carousel-item">
							<div class="container">
								<img class="car-img" src="../images/a6.jpg" alt="First slide">
							</div>
						</div>
						<div class="carousel-item ">
							<div class="container">
								<img class="car-img" src="../images/a7.jpg" alt="First slide">
							</div>
						</div>
						<div class="carousel-item ">
							<div class="container">
								<img class="car-img" src="../images/a8.jpg" alt="First slide">
							</div>
						</div>

					</div>
				</div>
				<div class="col bg-transparent ">
					<a class=" carousel-control-next bg-transparent"  >
						<span class="carousel-control-next-icon border border-secondary bg-dark" href="#carouselExampleControls" role="button" data-slide="next" aria-hidden="false"><i class="fas fa-plane-departure"></i></span>
						<span class="sr-only">Next</span>
					</a></div>
				</div>
			</div>
		</div>
	</div>
	


	

	<div class="jumbotron bok mx-3 my-3 py-5" style="background-color: #73CAE5">
		<h2 class="text-center mb-5 ">Find your dream location !<hr></h2>
		<form action="../phps/Booking.php" method="POST">
			<div id="booking" class="section">
				<div class="section">
					<div class="container-fluid">
						<div class="row">
							<div class="booking-form mx-auto">
								<form action="../phps/Booking.php" method="POST">						
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<span class="form-label">Flying from(country)</span>
												<input class="form-control" type="text" name="f_departure_location" placeholder="City or airport">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<span class="form-label">Flying to(country)</span>
												<input class="form-control" type="text" name="f_arrival_location" placeholder="City or airport">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<span class="form-label">Departing</span>
												<input class="form-control" name="f_departure_date" type="date" >
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<span class="form-label">Returning</span>
												<input class="form-control" name="f_arrival_date" type="date" >
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<span class="form-label">Seats</span>
												<select name="f_available_tickets" class="form-control">
													<option>any number</option>
													<?php
														 
														for ($x = 0; $x <= 15; $x++) {
															echo'<option  >' . $x . '</option>';
														} 
													?>
												</select>
												<span class="select-arrow"></span>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<span  class="form-label">Travel class</span>
												<select name="f_class" class="form-control">
													<option >any class</option>
													<option >economy</option>
													<option >business</option>
													<option >first</option>
												</select>
												<span class="select-arrow"></span>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<span  class="form-label">Order by price</span>
												<select name="f_order_by_price" class="form-control">
													<option >no</option>													
													<option >asc</option>
													<option >desc</option>
												</select>
												<span class="select-arrow"></span>
											</div>
										</div>
									</div>
									<div class="row">						
										<div class="col-md-4 ">
											<div class="form-group">
												<button class="search-btn" type="submit">Search</button>
											</div>
										</div>
										<div class="col-md-4 ml-0">
											<div class="form-group">
												<button class="clear-btn" type="reset" >Clear Filters</button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</form>
		<hr>

	</div>



	<!--<div class="jumbotron bok mx-3 my-3 py-5" style="background-color: #73CAE5">
		<h2 class="text-center mb-5 ">Find your dream location !</h2>
		<div id="booking" class="section">
			<div class="section-center">
				<div class="container">
					<div class="row">
						<div class="booking-form mx-auto">
							<form>						
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<span class="form-label">Flying from</span>
											<input class="form-control" type="text" placeholder="City or airport">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<span class="form-label">Flyning to</span>
											<input class="form-control" type="text" placeholder="City or airport">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<span class="form-label">Departing</span>
											<input class="form-control" type="date" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<span class="form-label">Returning</span>
											<input class="form-control" type="date" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<span class="form-label">Seats</span>
											<select class="form-control">
												<option>1</option>
												<option>2</option>
												<option>3</option>
											</select>
											<span class="select-arrow"></span>
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<span class="form-label">Children (0-17)</span>
											<select class="form-control">
												<option>0</option>
												<option>1</option>
												<option>2</option>
											</select>
											<span class="select-arrow"></span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<span class="form-label">Travel class</span>
											<select class="form-control">
												<option>Economy class</option>
												<option>Business class</option>
												<option>First class</option>
											</select>
											<span class="select-arrow"></span>
										</div>
									</div>
									<div class="col-md-3 ">
										<div class="form-btn">
											<button class="submit-btn" onclick="window.location.href='../sources/Destinations.html'">Search</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			
		</div>

	</div>-->


	<div class="news mx-3 my-3 py-5">
		<div class="container">
			<h2 class="text-center mb-5 ">Take the best of it !<hr></h2>
			
			<div class="row">
				<div class="col-4">
					<div class="thumbnail text-center">
						<a>
							<img class="mx-auto d-block" src="../images/cabin.jpg" alt="cabin">
							<p>Experience our Premium cabin</p>	
						</a>
						<hr>
						<p>
							Take a seat in the Premium cabin of our 787 Dreamliner, have a look around and experience the perks of flying Premium.
						</p>
					</div>
				</div>
				<div class="col-4">
					<div class="thumbnail text-center">
						<a>
							<img  class="mx-auto d-block" src="../images/lowcost.jpg" alt="lowcost" >
							<div>
								<p>Europe's Best Low-Cost Airline</p>
							</div>
						</a>
						<hr>
						<p>
							...for the sixth year in a row in the SkyTrax Awards where 19 million passengers have had their say. See where we can take you and experience the comfort of flying with an award-winning airline.

						</p>
					</div>
				</div>
				<div class="col-4">
					<div class="thumbnail text-center">
						<a>
							<img class="mx-auto d-block" src="../images/wifi.jpg" alt="wifi" >
							<div>
								<p>Free WiFi</p>
							</div>
						</a>
						<hr>
						<p>
							You will never get bored flying with us. Just connect to our free WiFi up in the air, and before you even know it you will be arriving at your destination!
						</p>
					</div>
				</div>
			</div>
			<hr>
		</div>
	</div>

	<?php  include("../sources/Footer.php");?>
	<!--<footer class="page-footer mx-3 my-3 px-3 py-3">
		<div class="container">
			<div class="row">
				<div class="col thumbnail">
					<h4>More about this company</h4>
					<hr>
					<p class="text-justify">
						Wingfree's fleet consists of around 170 aircraft including Boeing 737-800s, Boeing 737 MAX aircraft and Boeing 787 Dreamliners. 
						With an average fleet age of just 3.8 years, WF has one of the youngest and greenest fleets in the world. 
						New aircraft are win-win for the passenger's comfort, wallet, the environment and the company's costs.
					</p>
					<p class="text-right">-Avert Epcot,CEO</p>
				</div>
				<div class="col">
					<h4>Keep Connected</h4>
					<hr>
					<ul >
						<li class="fball">
							<a  href="https://www.facebook.com/" target="_blank"> <i class="fa fa-facebook"></i >Like us on Facebook</a>
						</li>
						<li class="twall">
							<a id="fal-twitter" href="https://twitter.com/" target="_blank" ><i id="fa-twitter" class="fa fa-twitter"></i>Follow us on Twitter</a>
						</li>
						<li class="ytall">
							<a id="fal-youtube" href="https://www.youtube.com/" target="_blank" ><i id="fa-youtube" class="fa fa-youtube"></i>Join us on Youtube</a>
						</li>
						<li class="isall">
							<a  id="fal-instagram" href="https://www.instagram.com/" target="_blank" ><i id="fa-instagram" class="fa fa-instagram"></i>Follow us on Instagram</a>
						</li>
					</ul>
				</div>
				<div class="col">
					<h4>Contact Information</h4>
					<hr>

					<div class="container">
						<iframe  class="gmap float-left" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d729285.7933998867!2d26.094638!3d44.437826!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40b1f93abf3cad4f%3A0xac0632e37c9ca628!2sBucure%C8%99ti!5e0!3m2!1sro!2sro!4v1553766681239" width="125" height="250" frameborder="0" style="border: solid black; border-radius:5px" allowfullscreen></iframe>
						<div class="split righ" id="emoji">
							<i class="fa fa-home fa-xs my-3"></i>
							<i>Wingfree BUC</i>
							<p>
								<i class="fa fa-mobile fa-xs my-2"></i>
								<i>Tel. 0712345689 </i>
							</p>
							<p>
								<i class="fa fa-envelope fa-xs my-2"></i>
								<i>wingfree@nw.com</i>
							</p>
						</div>	
					</div>
				</div>
			</div>
			<hr>	
		</div>
		<div class="footer-copyright text-center  py-3">© 2019 Wingfree nowings associations. All Rights Reserved
			<a href="https://mdbootstrap.com/education/bootstrap/"> nowings.asso.com</a>
		</div>
	</footer>-->

</body>
</html>



<!DOCTYPE html>
<html lang="en">

<head>
	<title>HomePage</title>

	
	<link rel="stylesheet" type="text/css" href="../styles/Footer.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<script src="../scripts/Footer.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYyns3ehc1GEsMTJ2r8nVqv51f6pxVnyg&callback=initMap"
	type="text/javascript"></script>

	<meta name="viewport" charset="utf-8" content="width=device-width, initial-scale=1">
</head>

<body class="bg-dark">

	<footer class="page-footer mx-3 my-3 px-3 py-3">
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
				<!--<div class="col">
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
				</div>-->
				<div class="col">
						<h4>Subscribe to our Newsletter</h2>
						<hr>
						<br>
						<form action="../phps/Newsletter.php" method="POST">
								<div class="container newsletterbox">
									
								  <input type="text" placeholder="Name" name="newsletter_name" required>
								  <input type="text" 
								  <?php 								
										if (isset($_SESSION['connected_user_ID'])) {
											$id = $_SESSION['connected_user_ID'];
											$sql_get_connected_user_data_from_ID = "SELECT * from logindata where `ID` = '$id'";
											$query_get_connected_user_data_from_ID = mysqli_query($conn,$sql_get_connected_user_data_from_ID);
											if(!$sql_get_connected_user_data_from_ID)
											{
												exit("Couln't extract data from logged user based on his id for navbar");
											}
											$final = mysqli_fetch_assoc($query_get_connected_user_data_from_ID);
											
											$email = $final['email'];
											echo ' value="'. $email . '" ';
										}										
								  ?> 
								  placeholder="Email address" name="newsletter_mail" required>
								  <input type="submit" value="Subscribe">						
								</div>	
						</form>
						<div class="container newsletterbox">
						<div class="row">
								<div class="col align-self-center"><button class="buton" onclick="window.location.href='DetailsPage.php'" >Contact Details</button></div>
								<div class="col align-self-center"><button class="buton" onclick="topFunction()" >Go top!</button></div>
						</div>
					</div>

				</div>
			</div>
			<hr>	
		</div>
		<div class="footer-copyright text-center  py-3">© 2019 Wingfree nowings associations. All Rights Reserved
			<a href="https://mdbootstrap.com/education/bootstrap/"> nowings.asso.com</a>
		</div>
	</footer>

</body>
</html>



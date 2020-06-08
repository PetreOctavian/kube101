<!DOCTYPE html>
<html lang="en">
<head>
	<title>AllFlights</title>
	<link rel="stylesheet" type="text/css" href="../styles/AllFlights.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="../scripts/AllFlights.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYyns3ehc1GEsMTJ2r8nVqv51f6pxVnyg&callback=initMap"
	type="text/javascript"></script>
</head>
<body>

<!--<div class="container">
  <div class="row">
    <div class="col-sm">
      One of three columns
    </div>
    <div class="col-sm">
      One of three columns
    </div>
    <div class="col-sm">
      One of three columns
    </div>
  </div>
</div>-->

<!--<div class="header">
	
	<div class="row">

		<div class="col-sm-1 my-auto">
			<a class="" href="HomePage2.html">
				<img class=" logo_img" src="../images/avatar2.png" alt="logo" >
			</a>
		</div>
		
		<div class="col-sm my-auto mx-auto">
			<h2>Fly from</h2>
		</div>
		<div class="col-sm my-auto mx-auto">
			<h2>Fly to</h2>
		</div>
		<div class="col-sm my-auto mx-auto">
			<h2>Price</h2>
		</div>
		<div class="col-sm my-auto mx-auto">
			<h2>Details</h2>
		</div>
		
	</div>
	<div class="progress-container">
		<div class="progress-bar" id="myBar"></div>
	</div> 
</div>-->

<?php  
	include("../sources/Navbar.php");
	include_once '../phps/SQL_Connection.php'
	?>
<!--<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
	<a class="navbar-brand" href="../sources/HomePage2.html">
		<img class=" logo_img" src="../images/avatar2.png" alt="logo" >
	</a>
	<a class="navbar-brand" href="../sources/ShoppingCart.html">
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
		</ul>
		<form class="form-inline my-2 my-lg-0 ">
			<input class="form-control mr-sm-2 input-sm" type="search" placeholder="Search" aria-label="Search">
			<button class="btn btn-outline-warning my-2 my-sm-0 btn-sm" type="submit">Search</button>
		</form>
	</div>
</nav>-->

<div class="categ mx-5 sticky-top">
	<div class="row fbox2 mx-auto ">			
		<div class="col-sm my-auto mx-auto">
			<div class="ff_info ">
				<h3>Fly from</h3>
			</div>	
		</div>
		<div class="col-sm my-auto mx-auto">
			<div class="ft_info">
				<h3>Fly from</h3>
			</div>
		</div>
		<div class="col-sm my-auto mx-auto ">
			<div class="pc_info">
				<h3>Price & Buy</h3>
			</div>
		</div>
		<div class="col-sm my-auto mx-auto ">
			<div class="mv_info">
				<h3>Seats & Details</h3>
			</div>
		</div>
	</div>
</div>
<div class="db my-6 mx-5 mb-2">



<?php 
    


		/*if($_GET['filter_mode'] == "on" )
		{
			header("Location: ../sources/Booking.php");
		}*/
    $sql_show_all_flights = "SELECT `ID`,`departure location`, `arrival location`, `price`, `seats` FROM flights "; // and `validation status` = 'valid' and `connection status` = 'offline'";
    $query_show_all_flights = mysqli_query($conn,$sql_show_all_flights);
    if(!$query_show_all_flights){
        exit("Error at selecting all flights");
    }
		$shopping_cart_path  = "'../sources/ShoppingCart.html'";
		$flight_details_path ="'../sources/FlightDetails.php";
		//session_start();
		
		$flight_details_path ="'../sources/FlightDetails.php";
    
                   

                    

    while ($row = mysqli_fetch_assoc($query_show_all_flights)) {
			$flight_details_path_bonus = "?bought_clicked_product_ID=" . $row['ID'] . "'"; 
			$dep_loc = explode(",",$row['departure location']);
			$arriv_loc = explode(",",$row['arrival location']);
					echo'<div class="fligth mb-1 mx-3">
							<div class="row fbox mx-auto mt-5">			
								<div class="col-sm my-auto mx-auto">
									<div class="ff_info ">
										<hr>
										<i class="fa fa-plane float-right fa-lg"></i>
										<h5><kbd>' . $dep_loc[0] . '</kbd></h5>
										<p>' . $dep_loc[1] . '</p>
										<hr>
									</div>	
								</div>
								<div class="col-sm my-auto mx-auto">
									<div class="ft_info">
										<hr>
										<i class="fa fa-plane float-right fa-lg"></i>
										<h5><kbd>'. $arriv_loc[0] .'</kbd></h5>
										<p>'. $arriv_loc[1] .'</p>
										<hr>
									</div>
									
								</div>
								<div class="col-sm my-auto mx-auto ">
									<div class="pc_info">
										<hr>
										<h5><kbd>' . $row['price'] . ' &#8364</kbd></h5>
										<form action="../phps/AllFlights.php?bought_clicked_product_ID=' . $row['ID'] . '" method="POST" >
											<button type="submit" name="submit" class="btn btn-success btn-sm">Buy</button>
											<input type="number" min=1 name="nr_of_tickets" value="1" placeholder="Nr.">
										</form>
										<hr>
									</div>
									
								</div>
								<div class="col-sm my-auto mx-auto ">
									<div class="mv_info">
										<hr>
										<h5><kbd>' . $row['seats'] . ' seats</kbd></h5>
										<button onclick="window.location.href=' . $flight_details_path . $flight_details_path_bonus .'" type="button" class="btn btn-info btn-sm">Info</button>
										<hr>
									</div>
								</div>
							</div>
						</div>';
		}
		//onclick="window.location.href=' . $flight_details_path .'?bought_clicked_product_ID=

    mysqli_close($conn); 
	
?>

<!--	<div class="fligth mb-1">
		<div class="row fbox mx-auto mt-5">			
			<div class="col-sm my-auto mx-auto">
				<div class="ff_info ">
					<hr>
					<i class="fa fa-plane float-right fa-lg"></i>
					<h5 ><kbd>London1</kbd></h5>
					
					<p >UK1ggggggg</p>
					<hr>

				</div>	
			</div>
			<div class="col-sm my-auto mx-auto">
				<div class="ft_info">
					<hr>
					<i class="fa fa-plane float-right fa-lg"></i>
					<h5 ><kbd>London1</kbd></h5>
					<p >UKgggggggg1</p>
					<hr>
				</div>
				
			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="pc_info">
					<hr>
					<h5><kbd>50 &#8364</kbd></h5>
					<form action="../phps/test.php" method="POST">
						<button type="submit" name="submit" onclick="window.location.href='../sources/ShoppingCart.html'" class="btn btn-success btn-sm">Buy</button>
						<input type="text" name="nr_of_tickets" placeholder="Nr.">
					</form>
					<p>eroare bossul meu</p>
					<hr>
				</div>
			
			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="mv_info">
					<hr>
					<h5><kbd>546 seats</kbd></h5>
						<button onclick="window.location.href='../sources/FlightDetails.php?bought_clicked_product_ID='" type="button" class="btn btn-info btn-sm" data-flight-id="674">Info</button>
					<hr>
				</div>
			</div>
		</div>
	</div>-->
	<!--<div class="fligth mb-1">
		<div class="row fbox mx-auto mt-5">			
			<div class="col-sm my-auto mx-auto">
				<div class="ff_info ">
					<hr>
					<i class="fa fa-plane float-right fa-lg"></i>
					<h5 ><kbd>London1</kbd></h5>
					
					<p >UK1ggggggg</p>
					<hr>

				</div>	
			</div>
			<div class="col-sm my-auto mx-auto">
				<div class="ft_info">
					<hr>
					<i class="fa fa-plane float-right fa-lg"></i>
					<h5 ><kbd>London1</kbd></h5>
					<p >UKgggggggg1</p>
					<hr>
				</div>
				
			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="pc_info">
					<hr>
					<h5><kbd>50 &#8364</kbd></h5>
					<button type="button" onclick="window.location.href='../sources/ShoppingCart.html'" class="btn btn-success btn-sm">Buy</button>
					<hr>
				</div>
				
			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="mv_info">
					<hr>
					<h5><kbd>Details</kbd></h5>
					<button type="button" onclick="window.location.href='../sources/FlightDetails.html'" class="btn btn-info btn-sm">Info</button>
					<hr>
				</div>
			</div>
		</div>
	</div>
	<div class="fligth mb-1">
		<div class="row fbox mx-auto mt-5">			
			<div class="col-sm my-auto mx-auto">
				<div class="ff_info ">
					<hr>
					<i class="fa fa-plane float-right fa-lg"></i>
					<h5 ><kbd>London1</kbd></h5>
					
					<p >UK1ggggggg</p>
					<hr>

				</div>	
			</div>
			<div class="col-sm my-auto mx-auto">
				<div class="ft_info">
					<hr>
					<i class="fa fa-plane float-right fa-lg"></i>
					<h5 ><kbd>London1</kbd></h5>
					<p >UKgggggggg1</p>
					<hr>
				</div>
				
			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="pc_info">
					<hr>
					<h5><kbd>50 &#8364</kbd></h5>
					<button type="button" onclick="window.location.href='../sources/ShoppingCart.html'" class="btn btn-success btn-sm">Buy</button>
					<hr>
				</div>
				
			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="mv_info">
					<hr>
					<h5><kbd>Details</kbd></h5>
					<button type="button" onclick="window.location.href='../sources/FlightDetails.html'" class="btn btn-info btn-sm">Info</button>
					<hr>
				</div>
			</div>
		</div>
	</div>
	<div class="fligth mb-1">
		<div class="row fbox mx-auto mt-5">			
			<div class="col-sm my-auto mx-auto">
				<div class="ff_info ">
					<hr>
					<i class="fa fa-plane float-right fa-lg"></i>
					<h5 ><kbd>London1</kbd></h5>
					
					<p >UK1ggggggg</p>
					<hr>

				</div>	
			</div>
			<div class="col-sm my-auto mx-auto">
				<div class="ft_info">
					<hr>
					<i class="fa fa-plane float-right fa-lg"></i>
					<h5 ><kbd>London1</kbd></h5>
					<p >UKgggggggg1</p>
					<hr>
				</div>
				
			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="pc_info">
					<hr>
					<h5><kbd>50 &#8364</kbd></h5>
					<button type="button" onclick="window.location.href='../sources/ShoppingCart.html'" class="btn btn-success btn-sm">Buy</button>
					<hr>
				</div>
				
			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="mv_info">
					<hr>
					<h5><kbd>Details</kbd></h5>
					<button type="button" onclick="window.location.href='../sources/FlightDetails.html'" class="btn btn-info btn-sm">Info</button>
					<hr>
				</div>
			</div>
		</div>
	</div>
	<div class="fligth mb-1">
		<div class="row fbox mx-auto mt-5">			
			<div class="col-sm my-auto mx-auto">
				<div class="ff_info ">
					<hr>
					<i class="fa fa-plane float-right fa-lg"></i>
					<h5 ><kbd>London1</kbd></h5>
					
					<p >UK1ggggggg</p>
					<hr>

				</div>	
			</div>
			<div class="col-sm my-auto mx-auto">
				<div class="ft_info">
					<hr>
					<i class="fa fa-plane float-right fa-lg"></i>
					<h5 ><kbd>London1</kbd></h5>
					<p >UKgggggggg1</p>
					<hr>
				</div>
				
			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="pc_info">
					<hr>
					<h5><kbd>50 &#8364</kbd></h5>
					<button type="button" onclick="window.location.href='../sources/ShoppingCart.html'" class="btn btn-success btn-sm">Buy</button>
					<hr>
				</div>
				
			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="mv_info">
					<hr>
					<h5><kbd>Details</kbd></h5>
					<button type="button" onclick="window.location.href='../sources/FlightDetails.html'" class="btn btn-info btn-sm">Info</button>
					<hr>
				</div>
			</div>
		</div>
	</div>
	<div class="fligth mb-1">
		<div class="row fbox mx-auto mt-5">			
			<div class="col-sm my-auto mx-auto">
				<div class="ff_info ">
					<hr>
					<i class="fa fa-plane float-right fa-lg"></i>
					<h5 ><kbd>London1</kbd></h5>
					
					<p >UK1ggggggg</p>
					<hr>

				</div>	
			</div>
			<div class="col-sm my-auto mx-auto">
				<div class="ft_info">
					<hr>
					<i class="fa fa-plane float-right fa-lg"></i>
					<h5 ><kbd>London1</kbd></h5>
					<p >UKgggggggg1</p>
					<hr>
				</div>
				
			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="pc_info">
					<hr>
					<h5><kbd>50 &#8364</kbd></h5>
					<button type="button" onclick="window.location.href='../sources/ShoppingCart.html'" class="btn btn-success btn-sm">Buy</button>
					<hr>
				</div>
				
			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="mv_info">
					<hr>
					<h5><kbd>Details</kbd></h5>
					<button type="button" onclick="window.location.href='../sources/FlightDetails.html'" class="btn btn-info btn-sm">Info</button>
					<hr>
				</div>
			</div>
		</div>
	</div>
	<div class="fligth mb-1">
		<div class="row fbox mx-auto mt-5">			
			<div class="col-sm my-auto mx-auto">
				<div class="ff_info ">
					<hr>
					<i class="fa fa-plane float-right fa-lg"></i>
					<h5 ><kbd>London1</kbd></h5>
					
					<p >UK1ggggggg</p>
					<hr>

				</div>	
			</div>
			<div class="col-sm my-auto mx-auto">
				<div class="ft_info">
					<hr>
					<i class="fa fa-plane float-right fa-lg"></i>
					<h5 ><kbd>London1</kbd></h5>
					<p >UKgggggggg1</p>
					<hr>
				</div>
				
			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="pc_info">
					<hr>
					<h5><kbd>50 &#8364</kbd></h5>
					<button type="button" onclick="window.location.href='../sources/ShoppingCart.html'" class="btn btn-success btn-sm">Buy</button>
					<hr>
				</div>
				
			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="mv_info">
					<hr>
					<h5><kbd>Details</kbd></h5>
					<button type="button" onclick="window.location.href='../sources/FlightDetails.html'" class="btn btn-info btn-sm">Info</button>
					<hr>
				</div>
			</div>
		</div>
	</div>
	<div class="fligth mb-1">
		<div class="row fbox mx-auto mt-5">			
			<div class="col-sm my-auto mx-auto">
				<div class="ff_info ">
					<hr>
					<i class="fa fa-plane float-right fa-lg"></i>
					<h5 ><kbd>London1</kbd></h5>
					
					<p >UK1ggggggg</p>
					<hr>

				</div>	
			</div>
			<div class="col-sm my-auto mx-auto">
				<div class="ft_info">
					<hr>
					<i class="fa fa-plane float-right fa-lg"></i>
					<h5 ><kbd>London1</kbd></h5>
					<p >UKgggggggg1</p>
					<hr>
				</div>
				
			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="pc_info">
					<hr>
					<h5><kbd>50 &#8364</kbd></h5>
					<button type="button" onclick="window.location.href='../sources/ShoppingCart.html'" class="btn btn-success btn-sm">Buy</button>
					<hr>
				</div>
				
			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="mv_info">
					<hr>
					<h5><kbd>Details</kbd></h5>
					<button type="button" onclick="window.location.href='../sources/FlightDetails.html'" class="btn btn-info btn-sm">Info</button>
					<hr>
				</div>
			</div>
		</div>
	</div>
	<div class="fligth mb-1">
		<div class="row fbox mx-auto mt-5">			
			<div class="col-sm my-auto mx-auto">
				<div class="ff_info ">
					<hr>
					<i class="fa fa-plane float-right fa-lg"></i>
					<h5 ><kbd>London1</kbd></h5>
					
					<p >UK1ggggggg</p>
					<hr>

				</div>	
			</div>
			<div class="col-sm my-auto mx-auto">
				<div class="ft_info">
					<hr>
					<i class="fa fa-plane float-right fa-lg"></i>
					<h5 ><kbd>London1</kbd></h5>
					<p >UKgggggggg1</p>
					<hr>
				</div>
				
			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="pc_info">
					<hr>
					<h5><kbd>50 &#8364</kbd></h5>
					<button type="button" onclick="window.location.href='../sources/ShoppingCart.html'" class="btn btn-success btn-sm">Buy</button>
					<hr>
				</div>
				
			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="mv_info">
					<hr>
					<h5><kbd>Details</kbd></h5>
					<button type="button" onclick="window.location.href='../sources/FlightDetails.html'" class="btn btn-info btn-sm">Info</button>
					<hr>
				</div>
			</div>
		</div>
	</div>
	<div class="fligth mb-1">
		<div class="row fbox mx-auto mt-5">			
			<div class="col-sm my-auto mx-auto">
				<div class="ff_info ">
					<hr>
					<i class="fa fa-plane float-right fa-lg"></i>
					<h5 ><kbd>London1</kbd></h5>
					
					<p >UK1ggggggg</p>
					<hr>

				</div>	
			</div>
			<div class="col-sm my-auto mx-auto">
				<div class="ft_info">
					<hr>
					<i class="fa fa-plane float-right fa-lg"></i>
					<h5 ><kbd>London1</kbd></h5>
					<p >UKgggggggg1</p>
					<hr>
				</div>
				
			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="pc_info">
					<hr>
					<h5><kbd>50 &#8364</kbd></h5>
					<button type="button" onclick="window.location.href='../sources/ShoppingCart.html'" class="btn btn-success btn-sm">Buy</button>
					<hr>
				</div>
				
			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="mv_info">
					<hr>
					<h5><kbd>Details</kbd></h5>
					<button type="button" onclick="window.location.href='../sources/FlightDetails.html'" class="btn btn-info btn-sm">Info</button>
					<hr>
				</div>
			</div>
		</div>
	</div>
	<div class="fligth mb-1">
		<div class="row fbox mx-auto mt-5">			
			<div class="col-sm my-auto mx-auto">
				<div class="ff_info ">
					<hr>
					<i class="fa fa-plane float-right fa-lg"></i>
					<h5 ><kbd>London1</kbd></h5>
					
					<p >UK1ggggggg</p>
					<hr>

				</div>	
			</div>
			<div class="col-sm my-auto mx-auto">
				<div class="ft_info">
					<hr>
					<i class="fa fa-plane float-right fa-lg"></i>
					<h5 ><kbd>London1</kbd></h5>
					<p >UKgggggggg1</p>
					<hr>
				</div>
				
			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="pc_info">
					<hr>
					<h5><kbd>50 &#8364</kbd></h5>
					<button type="button" onclick="window.location.href='../sources/ShoppingCart.html'" class="btn btn-success btn-sm">Buy</button>
					<hr>
				</div>
				
			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="mv_info">
					<hr>
					<h5><kbd>Details</kbd></h5>
					<button type="button" onclick="window.location.href='../sources/FlightDetails.html'" class="btn btn-info btn-sm">Info</button>
					<hr>
				</div>
			</div>
		</div>
	</div>
	<div class="fligth mb-1">
		<div class="row fbox mx-auto mt-5">			
			<div class="col-sm my-auto mx-auto">
				<div class="ff_info ">
					<hr>
					<i class="fa fa-plane float-right fa-lg"></i>
					<h5 ><kbd>London1</kbd></h5>
					
					<p >UK1ggggggg</p>
					<hr>

				</div>	
			</div>
			<div class="col-sm my-auto mx-auto">
				<div class="ft_info">
					<hr>
					<i class="fa fa-plane float-right fa-lg"></i>
					<h5 ><kbd>London1</kbd></h5>
					<p >UKgggggggg1</p>
					<hr>
				</div>
				
			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="pc_info">
					<hr>
					<h5><kbd>50 &#8364</kbd></h5>
					<button type="button" onclick="window.location.href='../sources/ShopingCart.html'" class="btn btn-success btn-sm">Buy</button>
					<hr>
				</div>
				
			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="mv_info">
					<hr>
					<h5><kbd>Details</kbd></h5>
					<button type="button" onclick="window.location.href='../sources/FlightDetails.html'" class="btn btn-info btn-sm">Info</button>
					<hr>
				</div>
			</div>
		</div>
	</div>
	<div class="fligth mb-1">
		<div class="row fbox mx-auto mt-5">			
			<div class="col-sm my-auto mx-auto">
				<div class="ff_info ">
					<hr>
					<i class="fa fa-plane float-right fa-lg"></i>
					<h5 ><kbd>London1</kbd></h5>
					
					<p >UK1ggggggg</p>
					<hr>

				</div>	
			</div>
			<div class="col-sm my-auto mx-auto">
				<div class="ft_info">
					<hr>
					<i class="fa fa-plane float-right fa-lg"></i>
					<h5 ><kbd>London1</kbd></h5>
					<p >UKgggggggg1</p>
					<hr>
				</div>
				
			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="pc_info">
					<hr>
					<h5><kbd>50 &#8364</kbd></h5>
					<button type="button" onclick="window.location.href='../sources/ShoppingCart.html'" class="btn btn-success btn-sm">Buy</button>
					<hr>
				</div>
				
			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="mv_info">
					<hr>
					<h5><kbd>Details</kbd></h5>
					<button type="button" onclick="window.location.href='../sources/FlightDetails.html'" class="btn btn-info btn-sm">Info</button>
					<hr>
				</div>
			</div>
		</div>
	</div>-->

	


<br>
<br>


</div>


</body>
</html>
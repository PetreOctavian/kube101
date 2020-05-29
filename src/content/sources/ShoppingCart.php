<!DOCTYPE html>
<html lang="en">
<head>
	<title>ShoppingCart</title>
	<link rel="stylesheet" type="text/css" href="../styles/ShoppingCart.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--<script src="../scripts/ShoppingCart.js"></script>-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
	<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
</head>
<body>

<?php  include("../sources/Navbar.php");?>

<div class="db my-6 mx-5 mb-2">
	<?php 

		include_once '../phps/SQL_Connection.php';
		
		//cleaning table by previous or remaining orders with 0 taken seats, pretty useless 
		/*$sql_clean_orders_db = "DELETE from orders where orders.`taken seats` = 0";
		$query_clean_orders_db = mysqli_query($conn,$sql_clean_orders_db);
		if(!$query_clean_orders_db){
			exit("Error at cleaning db from 0 taken seats orders");
		}*/


		if (isset($_SESSION['connected_user_ID'])) {

			$id = $_SESSION['connected_user_ID'];
			$sql_show_all_orders = "SELECT *, o.`ID` as `order ID` FROM flights as f inner join  orders as o on o.`ID flight` = f.`ID` WHERE o.`ID user` = '$id' and o.`taken seats` > 0 and o.`status` = 'unhonored'";
			$query_show_all_orders = mysqli_query($conn,$sql_show_all_orders);
			if(!$query_show_all_orders){
				exit("Error at selecting all orders in shoppin cart(logged)");
			}

			//get f and l name for bag 
			$id = $_SESSION['connected_user_ID'];
			$sql_get_connected_user_data_from_ID = "SELECT * from logindata where `ID` = '$id'";
        	$query_get_connected_user_data_from_ID = mysqli_query($conn,$sql_get_connected_user_data_from_ID);
			if(!$sql_get_connected_user_data_from_ID){
				exit("Couln't extract data from connected_user_ID for bag details");
			}
			$final = mysqli_fetch_assoc($query_get_connected_user_data_from_ID);
			$purchaser_first_name = $final['first name'];
			$purchaser_last_name = $final['last name'];


		}
		else{
			$sql_show_all_orders = "SELECT *, o.`ID` as `order ID`  FROM flights as f inner join  orders as o on o.`ID flight` = f.`ID` WHERE o.`ID user` = 999 and o.`taken seats` > 0 and o.`status` = 'unhonored'";
			$query_show_all_orders = mysqli_query($conn,$sql_show_all_orders);
			if(!$query_show_all_orders){
				exit("Error at selecting all orders in shoppin cart(guest)");
			}
			$purchaser_first_name = "guestino";
			$purchaser_last_name = "guesth";
		}	
			$shopping_cart_path  = "'../sources/ShoppingCart.html'";
			$flight_details_path ="'../sources/FlightDetails.php";
			$flight_details_path ="'../sources/FlightDetails.php";
			$total_price = 0;
						
		while ($row = mysqli_fetch_assoc($query_show_all_orders)) {
				$flight_details_path_bonus = "?bought_clicked_product_ID=" . $row['ID'] . "'"; 
				$dep_loc = explode(",",$row['departure location']);
				$arriv_loc = explode(",",$row['arrival location']);
				//get price per order (seats price * number of seats)
				$total_price += $row['price']*$row['taken seats'];

						echo'<div class="fligth mb-1">
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
											<h5><kbd>(' . $row['price'] . ' &#8364) X ' . $row['taken seats'] . '</kbd></h5>
											<form action="../phps/AllFlights.php?removed_clicked_product_ID='. $row['order ID'] . '" method="POST">
												<button type="submit" name="submit" class="btn btn-success btn-sm">Remove</button>
												<input type="number" min=1 max=' . $row['taken seats'] . ' name="nr_of_tickets" value="'.$row['taken seats'].'" placeholder="Nr.">
											</form>
											<hr>
										</div>
										
									</div>
									<div class="col-sm my-auto mx-auto ">
										<div class="mv_info">
											<hr>
											<h5><kbd>' . $row['taken seats'] . ' taken seats</kbd></h5>
											<button onclick="window.location.href=' . $flight_details_path . $flight_details_path_bonus .'" type="button" class="btn btn-info btn-sm">Info</button>
											<hr>
										</div>
									</div>
								</div>
							</div>';
			}
			
		mysqli_close($conn); 

	?>


</div>
	<br>
	<br>
	
	<div class="mx-5 sticky-top">
		<div class="row fbox mx-auto ">			
			<div class="col-sm my-auto mx-auto">
				<div class="ff_info ">
					<h4> Hello <p><kbd><?php echo $purchaser_first_name.' '.$purchaser_last_name?></kbd></p></h4>
				</div>	
			</div>
			<div class="col-sm my-auto mx-auto">
				<div class="ft_info">
					<h4>Order price<p><kbd><?php echo $total_price?> &#8364</kbd></p></h4>
				</div>


			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="pc_info">
					<form action="../phps/ShoppingCart.php?command=submit_order&total_price=<?php echo $total_price?>" method="POST">
						<button type="submit" class="buy-button btn-success btn-primary btn-md ">Submit order</button>
					</form>
					<script>
						
						/*$(form).submit(function(){
							var formdata = $(this).serialize()+"?total_price=";

							$.ajax(function(){
								url: '../phps/ShoppingCart.php'
								data: formdata,
								success: function(data){

									// do something nice here
									alert("all good");

								}
							});
						});*/
					</script>
				</div>
			</div>
			<div class="col-sm my-auto mx-auto ">
				<div class="mv_info">
					<form action="../phps/ShoppingCart.php?command=cancel_order" method="POST">
						<button type="submit" class="btn-danger btn-primary btn-md">Cancel order</button>
					</form>
				</div>
			</div>
		</div>
	</div>


</body>
</html>
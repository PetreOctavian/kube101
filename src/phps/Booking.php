<!DOCTYPE html>
<html lang="en">
<head>
	<title>Booking</title>
	<link rel="stylesheet" type="text/css" href="../styles/Booking.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYyns3ehc1GEsMTJ2r8nVqv51f6pxVnyg&callback=initMap"
	type="text/javascript"></script>
</head>
<body>

    <?php
        
        include("../sources/Navbar.php");
        include_once 'SQL_Connection.php';
        
        if(isset($_GET['search_loc']))
            {
                $A = $_GET['search_loc'];
                $sql_filter = "SELECT * from flights where `arrival location` like '%$A'";

                unset($_GET['search_loc']);
            }

        else if (!empty($_POST)) {
            $f_departure_location = mysqli_real_escape_string($conn,$_POST['f_departure_location']);
            $f_arrival_location = mysqli_real_escape_string($conn,$_POST['f_arrival_location']);
            $f_departure_date = mysqli_real_escape_string($conn,$_POST['f_departure_date']);
            $f_arrival_date = mysqli_real_escape_string($conn,$_POST['f_arrival_date']);
            $f_available_tickets = mysqli_real_escape_string($conn,$_POST['f_available_tickets']);
            $f_class = mysqli_real_escape_string($conn,$_POST['f_class']);
            $f_order_by_price = mysqli_real_escape_string($conn,$_POST['f_order_by_price']);

            /*echo $f_departure_location;
            echo "||";
            echo $f_arrival_location;
            echo "||";
            echo $f_departure_date;
            echo "||";
            echo $f_arrival_date;
            echo "||";
            echo $f_available_tickets;
            echo "||";
            echo $f_class;
            echo "||";*/

            $sql_filter =  "SELECT * from flights where 1 "; 
            $check_class = " `travel class` = '$f_class' ";
            $check_dep_loc = " `departure location` like '%$f_departure_location' ";
            $check_arr_loc = " `arrival location` like '%$f_arrival_location' ";
            $check_dep_time =" DATE(`departure date`) = '$f_departure_date' ";
            $check_arr_time = " DATE(ADDTIME(`departure date`,`flight duration`)) = '$f_arrival_date' ";
            $check_seats = " `seats` = '$f_available_tickets' ";
            $check_ordering_by_price = " order by `price` ";


            if(!empty($f_departure_location)){
                $sql_filter .= "AND";
                $sql_filter .= $check_dep_loc;
            }
            if(!empty($f_arrival_location)){
                $sql_filter .= "AND";
                $sql_filter .= $check_arr_loc;
            }
            if(!empty($f_departure_date)){
                $sql_filter .= "AND";
                $sql_filter .= $check_dep_time;
            }
            if(!empty($f_arrival_date)){
                $sql_filter .= "AND";
                $sql_filter .= $check_arr_time;
            }
            if($f_class != "any class"){
                $sql_filter .= "AND";
                $sql_filter .= $check_class;
            }
            if($f_available_tickets != "any number"){
                $sql_filter .= "AND";
                $sql_filter .= $check_seats;
            }
            if($f_order_by_price != "no"){
                $check_ordering_by_price .= $f_order_by_price;
                $sql_filter .= $check_ordering_by_price;               
            }
            
        }
        //echo $sql_filter;
          
        $query_filter = mysqli_query($conn,$sql_filter);
        if(!$query_filter){
            exit("Error at filtering products");
        }
        $flight_details_path ="'../sources/FlightDetails.php";
        $rowcount = mysqli_num_rows($query_filter);
        if(!$rowcount)
        {
            $error_message .= "<p><kbd>No flights returner for the specific filters. Please come back later !</kbd></p>";
            $_SESSION['error'] = $error_message;
            header("Location: ../sources/ErrorPage.php");
        }
        while ($row = mysqli_fetch_assoc($query_filter)){
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
        mysqli_close($conn);     
    ?>

</body>
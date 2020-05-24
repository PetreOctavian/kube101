<?php

    include_once 'SQL_Connection.php';

    //if()
    //$requested_nr_of_tickets = $_POST['nr_of_tickets']; //number of ticket we want to buy 
    
    
    //cazul pt removed_clicked_product_ID !!!!!!!!!!!!!!!!!!!!!!!!!

    session_start();
    //for adding  to cart
    if(isset($_GET['bought_clicked_product_ID'])){
        $id =  $_GET['bought_clicked_product_ID'];
        //verify if there are enough seats and if not pop an error message
        $requested_nr_of_tickets = $_POST['nr_of_tickets'];
        //bought_seats are seats bought in previsou orders in the same session before submitting order
        //finding nr of bought seats for a certain flight, this var is necessaar bec when adding to cart the daba is not modified, it's updated just after submit order , so in order to check if i could add a spcecifif number of seats fro a flight at a session  and by submitting it i wont get insufficient seats error, it's an extra method of verifying a flight's setas availability
        $bought_seats = 0;
        $sql_find_seats_availability = "SELECT * FROM orders as o inner join flights as f on o.`ID flight` = f.`ID` WHERE f.`ID` = '$id' and o.`status` = 'unhonored'";
        $query_find_seats_availability = mysqli_query($conn,$sql_find_seats_availability);
        if(!$query_find_seats_availability){
            exit("Error at finding seats availability in orders ");
        }
        while($row = mysqli_fetch_assoc($query_find_seats_availability)){
            $bought_seats = $bought_seats + $row["taken seats"];
        }

        //finding how many total seats got a ride(flight)
        $sql_find_total_seats_per_flight = "SELECT * FROM flights as f WHERE f.`ID`='$id'";
        $query_find_total_seats_per_flight = mysqli_query($conn,$sql_find_total_seats_per_flight);
        if(!$query_find_total_seats_per_flight){
            exit("Error at finding total seats for a flight ");
        }
        $row = mysqli_fetch_assoc($query_find_total_seats_per_flight);
        $total_seats_per_flight = $row["seats"];
        //if ($bought_seats + $requested_nr_of_tickets <= $total_seats_per_flight){
        if ($bought_seats + $requested_nr_of_tickets <= $total_seats_per_flight){ //if the buy can be completed to it(update in orders)
            if (isset($_SESSION['connected_user_ID'])) {
        
                $user = $_SESSION['connected_user_ID'];
                $sql_insert_orders = "INSERT INTO orders (`ID flight`,`ID user`,`taken seats`) VALUE ('$id','$user','$requested_nr_of_tickets')";
                $query_insert_orders = mysqli_query($conn, $sql_insert_orders);
                if (!$query_insert_orders) {
                        exit("Error at inserting in orders(logged)");
                }       
            }
            else{
                $sql_insert_orders = "INSERT INTO orders (`ID flight`,`ID user`,`taken seats`) VALUE ('$id',999,'$requested_nr_of_tickets')";
                $query_insert_orders = mysqli_query($conn, $sql_insert_orders);
                if (!$query_insert_orders) {
                        exit("Error at inserting in orders(guest)");
                }
            }
            unset($_GET['bought_clicked_product_ID']);
            unset($_GET['removed_clicked_product_ID']);
            header("Location: ../sources/AllFlights.php");
        }
        else{//else give an error message //bec of html number validation this is pretty useless
            //session_start();
            //$available_tickets = $total_seats_per_flight;// - $bought_seats;
            $available_tickets = $total_seats_per_flight - $bought_seats;//$requested_nr_of_tickets; //- $bought_seats; //kind of "requested" but not so much ofc :) 
            //if ($available_tickets == 0){
            if ($available_tickets == 0){
                $_SESSION['error'] = '<p><kbd>Not enough seats available. There are no tickets left for the fligth . Please try again later.</kbd></p>';

            }
            else{   
                $_SESSION['error'] = '<p><kbd>Not enough seats available. There are just (' .$available_tickets .') tickets left for the fligth . Please try again later.</kbd></p>';
            }
            unset($_GET['bought_clicked_product_ID']);
            unset($_GET['removed_clicked_product_ID']);
            header("Location: ../sources/ErrorPage.php");

            /*echo "bilete pe care vreau sa le cumpar acum= $requested_nr_of_tickets\xD";
            echo "bilete disponibile= $available_tickets \xD";
            echo "bilete totale pt zborul respectiv= $total_seats_per_flight \xD";
            echo "bilete deja cumparate= $bought_seats";*/
        }
        exit();
    }


    //for deleteting from cart
    if (isset($_GET['removed_clicked_product_ID'])) {

        $id_order_remove = $_GET['removed_clicked_product_ID'];

        $requested_nr_of_tickets = $_POST['nr_of_tickets'];
        //verify if there are enough seats to be removed from orders and if not poping an error message
        $removed_seats = $requested_nr_of_tickets;
        
        //finding nr of taken seats for a certain flight with data from all orders via flight logindata

        $sql_find_taken_seats_availability = "SELECT * FROM orders as o inner join flights as f on o.`ID flight` = f.`ID` WHERE o.`ID` = '$id_order_remove'";
        $query_find_taken_seats_availability = mysqli_query($conn,$sql_find_taken_seats_availability);
        if(!$query_find_taken_seats_availability){
            exit("Error at finding taken seats availability in orders ");
        }
        if($row = mysqli_fetch_assoc($query_find_taken_seats_availability)){
            $taken_seats = $row["taken seats"];
        }

        if($removed_seats <= $taken_seats){
            $after_remove_seats = $taken_seats - $removed_seats;
            //change in orders
            $sql_update_taken_seats_availability = "UPDATE orders set `taken seats`= '$after_remove_seats' WHERE `ID` = '$id_order_remove'";
            $query_update_taken_seats_availability = mysqli_query($conn,$sql_update_taken_seats_availability);
            if(!$query_update_taken_seats_availability){
                exit("Error at updating taken seats availability in orders ");
            }
            unset($_GET['bought_clicked_product_ID']);
            unset($_GET['removed_clicked_product_ID']);
            header("Location: ../sources/ShoppingCart.php");
        }
        else{
            //pop-up error message //bec of html number validation this is pretty useless
            session_start();
            $_SESSION['error'] = '<p><kbd> Just '.$taken_seats.' seats reserved. Cannot undo more . Please try a smaller number .</kbd></p>';
            unset($_GET['bought_clicked_product_ID']);
            unset($_GET['removed_clicked_product_ID']);
            header("Location: ../sources/ErrorPage.php");
        }
        exit();
    }
        
    mysqli_close($conn);

?>
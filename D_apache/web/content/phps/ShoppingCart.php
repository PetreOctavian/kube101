<?php

include_once '../phps/SQL_Connection.php';

session_start();
//if command exists
if (isset($_GET['command'])) {
    
    //if command is for submit order
    if ($_GET['command'] == "submit_order") {
  
        
        //if we want to purchase(pay) the products from the cart --> the flights data base will be modified (the tickets will be "consumed")
        //if the use is not a guest, a guest cannot submit an order
        if (isset($_SESSION['connected_user_ID'])) {
            //get number of seats taken from orders of a client(user) and the flight's total
            $id = $_SESSION['connected_user_ID'];
            $sql_taken_seats_all_orders_from_a_client = "SELECT o.`taken seats` as a FROM flights as f inner join  orders as o on o.`ID flight` = f.`ID` WHERE o.`ID user` = '$id' and o.`status` = 'unhonored'";
            $query_taken_seats_all_orders_from_a_client = mysqli_query($conn, $sql_taken_seats_all_orders_from_a_client);
            if (!$query_taken_seats_all_orders_from_a_client) {
                exit("Error at finding taken seats and flight's total seats)");
            }
            //collecting number of seats from all orders(we could have same flight on diffrent orders and with a diffrent number of taken seats)
            $taken_seats = 0;
            while ($result = mysqli_fetch_assoc($query_taken_seats_all_orders_from_a_client)) {
                $taken_seats += $result['a'];
            }

            $update_taken_seats_all_orders_from_a_client = "UPDATE flights as f inner join  orders as o on o.`ID flight` =  f.`ID` set f.`seats` = f.`seats` - '$taken_seats'  WHERE o.`ID user` = '$id' and o.`status` = 'unhonored'";
            $query_update_taken_seats_all_orders_from_a_client = mysqli_query($conn, $update_taken_seats_all_orders_from_a_client);
            if (!$query_update_taken_seats_all_orders_from_a_client) {
                exit("Error at updating a tranasation in data base");
            }
        
            $total_price = $_GET['total_price'];
            //if there are any 
            if($total_price != 0){
                //check user's money
                $sql_check_clients_coco = "SELECT l.`coco` FROM logindata as l WHERE l.`ID` = '$id' ";
                $query_check_clients_coco = mysqli_query($conn, $sql_check_clients_coco);
                if (!$query_check_clients_coco) {
                    exit("Error at calculating a user's coco)");
                }
                //current money of a user
                if ($res = mysqli_fetch_assoc($query_check_clients_coco)) {
                    $money = $res['coco'];
                }
                //echo $money;
                //echo "|";
                //echo $total_price;
                //if the user hasn't enough money pop-up error message
                if ($money < $total_price) {
                    ///not enough money
                    $error_message .= "<p><kbd>You don't have enough money to pay for the ticktes :( . </kbd></p>";
                    $_SESSION['error'] = $error_message;
                    header("Location: ../sources/ErrorPage.php");
                } 
                else { //if the use has enough money
                
                    // subtract the order total price from his "wallet"
                    $sql_update_coco = "UPDATE logindata as l set l.`coco` = l.`coco` - '$total_price' WHERE l.`ID` = '$id' ";
                    $query_update_coco = mysqli_query($conn, $sql_update_coco);
                    if (!$query_update_coco) {
                        exit("Error at calculating a user's money)");
                    }


                    /*if ($res = mysqli_fetch_assoc($query_check_clients_coco)) {
                        $money = $res['coco'];
                    }*/

                    //getting username  
                    $sql_get_connected_user_data_from_ID = "SELECT * from logindata where `ID` = '$id'";
                    $query_get_connected_user_data_from_ID = mysqli_query($conn,$sql_get_connected_user_data_from_ID);
                    if(!$sql_get_connected_user_data_from_ID){
                        exit("Couln't extract data from connected_user_ID for bag details");
                    }
                    $final = mysqli_fetch_assoc($query_get_connected_user_data_from_ID);
                    $purchaser_username = $final['username'];
                    

                    if (!isset($_SESSION['error'])) {

                        //generate transactions details
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $charactersLength = strlen($characters);
                        $randomString = '';
                        for ($i = 0; $i < 8; $i++) {
                            $randomString .= $characters[rand(0, $charactersLength - 1)];
                        }
                        $code = $randomString;
                        $_SESSION['transaction'] = 'Your payment (' .$total_price. '&#8364) has been processed successfully '. $purchaser_username. '. Your command code is #' . $randomString . '. Thank you for picking us and enjoy your flight with WingFree !';

                        //inert into transaction table
                        //ID code username time money
                        $sql_insert_transaction = "INSERT INTO transactions (`code`, `username`, `time`, `money`) VALUES ('$code', '$purchaser_username', NOW(), '$total_price')";
                        $query_insert_transaction = mysqli_query($conn,$sql_insert_transaction);
                        if(!$query_insert_transaction){
                            exit("Couln't insert transactions");
                        }
                        
                        //honoring the already paid orders in the orders table 
                        $id = $_SESSION['connected_user_ID'];
                        //$sql_update_paid_orders = "UPDATE orders as o set  inner join  orders as o on o.`ID user` = l.`ID` WHERE o.`ID user` = '$id' and o.`taken seats` > 0 ";
                        $sql_update_paid_orders = "UPDATE orders as o inner join logindata as l on o.`ID user` =  l.`ID` set  o.`status` = 'honored'  WHERE  o.`status` = 'unhonored'  and l.`ID` = '$id' and o.`taken seats` > 0 ";
			            $query_update_paid_orders = mysqli_query($conn,$sql_update_paid_orders);
			            if(!$query_update_paid_orders){
				            exit("Error at updating honored orders");
			            }


                        header("Location: ../sources/SuccessPage.php");
                    }
                }
            }
            else{
                $error_message = "<p><kbd>You have to put somehting in the cart in order to submit the order.</kbd></p>";
                $_SESSION['error'] = $error_message;
                header("Location: ../sources/ErrorPage.php");
                
            }
            
        } else {
            //error just a logged user can purchase tickets
            $error_message = "<p><kbd>You have to be logged in order to submit an order. </kbd></p>";
            $_SESSION['error'] = $error_message;
            header("Location: ../sources/ErrorPage.php");
        }
        exit();
    } 
    if ($_GET['command'] == "cancel_order") {

        if (isset($_SESSION['connected_user_ID'])) {
            $id = $_SESSION['connected_user_ID'];
            echo $id;
            $sql_cancel_orders_by_user = "DELETE from orders where orders.`ID user` = '$id' and  orders.`status` = 'unhonored'";
            $query_cancel_orders_by_user = mysqli_query($conn, $sql_cancel_orders_by_user);
            if (!$query_cancel_orders_by_user) {
                exit("Error at canceling order");
            }
        }
        else{
            $id = 999;
            $sql_cancel_orders_by_user = "DELETE from orders where orders.`ID user` = '$id' and  orders.`status` = 'unhonored'";
            $query_cancel_orders_by_user = mysqli_query($conn, $sql_cancel_orders_by_user);
            if (!$query_cancel_orders_by_user) {
                exit("Error at canceling order");
            }
        }
       header("Location: ../sources/ShoppingCart.php");
        exit();
    }
    
    exit("unexpected behavio, no command properly selected");
}
?>
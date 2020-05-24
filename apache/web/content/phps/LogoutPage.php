<?php


    include_once 'SQL_Connection.php';

    // ID  username  password email  first name  last name  adress  telephone  user type  vaidation status  connection status

    session_start();

     ////////////////////
     /*
     $time = $_SERVER['REQUEST_TIME'];

     
     $timeout_duration = 10;
     
     
     if (isset($_SESSION['LAST_ACTIVITY']) && 
        ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
             if(isset($_SESSION['connected_user_ID'])){
                 $id = $_SESSION['connected_user_ID'];
                 $sql_update_logout = "UPDATE logindata SET `connection status`='offline' WHERE `ID` = '$id' and `connection status` = 'online'";
                 $query_update_logout = mysqli_query($conn, $sql_update_logout);
                 if (!$query_update_logout) {
                     exit("Couldn't update data base after log out");
                 }
             }
         session_unset();
         session_destroy();
         session_start();
     }
     
    
     $_SESSION['LAST_ACTIVITY'] = $time;*/
             ///////////////////

    if(isset($_SESSION['connected_user_ID']))
    {
        $id = $_SESSION['connected_user_ID'];        
        $sql_update_logout = "UPDATE logindata SET `connection status`='offline' WHERE `ID` = '$id' and `connection status` = 'online'";
        $query_update_logout = mysqli_query($conn,$sql_update_logout);
        if(!$query_update_logout)
        {
            exit("Couldn't update data base after log out");
        }
        mysqli_close($conn);
        session_unset();
        session_destroy();
        header("Location: ../sources/HomePage2.php");
        
        //exit();
    }
    else{
        exit("Log out when you are not logged in (big problems my friend)");
    }
    mysqli_close($conn); 

?>
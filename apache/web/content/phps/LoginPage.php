<?php
    include_once 'SQL_Connection.php';



    if (isset($_POST['submit'])) {
        $username = mysqli_real_escape_string($conn,$_POST['login_user']);
        $password = mysqli_real_escape_string($conn,$_POST['login_pass']);
       
        session_start();
        
        ////////////////////
        $time = $_SERVER['REQUEST_TIME'];

/**
* for a 30 minute timeout, specified in seconds
*/
$timeout_duration = 10;

/**
* Here we look for the user's LAST_ACTIVITY timestamp. If
* it's set and indicates our $timeout_duration has passed,
* blow away any previous $_SESSION data and start a new one.
*/
if (isset($_SESSION['LAST_ACTIVITY']) && 
   ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    session_start();
}

/**
* Finally, update LAST_ACTIVITY so that our timeout
* is based on it and not the user's login time.
*/
$_SESSION['LAST_ACTIVITY'] = $time;
        ///////////////////

        unset($error_message);
        if(isset($_SESSION['connected_user_ID'])){
            exit("trying to login while already logged in in the same session!");
        }

        // ID  username  password email  first name  last name  adress  telephone  user type  vaidation status  connection status
            
        //check username & password
        
        $sql_ver_login = "SELECT * FROM  logindata where `username` = '$username' and `password` = '$password'"; // and `validation status` = 'valid' and `connection status` = 'offline'";
        $query_ver_login = mysqli_query($conn,$sql_ver_login);
        if(!$query_ver_login)
        {
            exit("Error at finding account in data base");
        }
        //just a match found
        $nr_ver_login = mysqli_num_rows($query_ver_login);
        if($nr_ver_login == 1){
            $result_ver_login = mysqli_fetch_assoc($query_ver_login);
            if($result_ver_login["validation status"] != "valid"){
                $error_message .= "<p><kbd>Invalid account</kbd></p>";  
            }
            if($result_ver_login["connection status"] != "offline"){
                $error_message .= "<p><kbd>Account already connected</kbd></p>";
            }
            if(!isset($error_message)){

                //update connection status = online
                $sql_update_status = "UPDATE logindata SET `connection status`='online' WHERE `username` = '$username' and `password` = '$password' and `validation status` = 'valid' and `connection status` = 'offline'";
                $query_update_status = mysqli_query($conn,$sql_update_status);
                if(!$query_update_status){
                    /*$error_message = "<p><kbd>Couldn't establish connection!</kbd></p>";
                    header("Location: ../sources/ErrorPage.php");*/
                    exit("Couldn't update connection status in data base!");
                } 


                //select data to be send to further pages 
                $sql_send_connected_user_data = "SELECT * from logindata where `username` = '$username' and `password` = '$password' and `validation status` = 'valid' and `connection status` = 'online'";
                $query_send_connected_user_data = mysqli_query($conn,$sql_send_connected_user_data);
                if(!$query_send_connected_user_data){
                    exit("Couldn't collect connected user info from data base!");
                }   

                if($result_send_connected_user_data = mysqli_fetch_assoc($query_send_connected_user_data))
                {
                    $_SESSION['connected_user_ID'] = $result_send_connected_user_data['ID'];
                }
                //$final = mysqli_fetch_assoc($query_send_connected_user_data);
                //$final = mysqli_fetch_assoc($query_send_connected_user_data);
                //print_r($final);
               // echo  $final["ID"];
               
                
                //$_SESSION['connected_user_ID'] = $final['ID'];
                if(isset($_SESSION['connected_user_ID'])) header("Location: ../sources/HomePage2.php");              
                 
            }
            else{
                $_SESSION['error'] = $error_message;
                header("Location: ../sources/ErrorPage.php");
            }
        }
        else{
            $error_message .= "<p><kbd>Invalid username or password</kbd></p>";
            $_SESSION['error'] = $error_message;
            header("Location: ../sources/ErrorPage.php");
        }
        mysqli_close($conn);
    }


         //global $error_message;

        //DE MODIFICAT AICI !!!!!!!!!!!!!!!!!

        /*$sql_ver_login = "SELECT * FROM  logindata where `username` = '$username' and `password` = '$password' and `validation status` = 'valid' and `connection status` = 'offline'";
        $out_ver_login = mysqli_query($conn,$sql_ver_login);
        $t = mysqli_num_rows($out_ver_login);*/
        /*session_start();
        echo $username;
        if($t == 0){
            $error_message = "<p><kbd>Wrong username or password or invalid account or already connected account.</kbd></p>";
            header("Location: ../sources/ErrorPage.php");
        }
        else if($t == 1){
            $sql_update_status = "UPDATE logindata SET `connection status`='online' WHERE `username` = '$username' and `password` = '$password' and `validation status` = 'valid' and `connection status` = 'offline'";
            $out_update_status = mysqli_query($conn,$sql_update_status);
            if(!$out_update_status){
                $error_message = "<p><kbd>Couldn't establish connection!</kbd></p>";
                header("Location: ../sources/ErrorPage.php");
            } 
            
            //
            $sql_set_globals= "SELECT `username` as _usn, `first name` as _f_n, `last name` as _l_n, `user type` as _u_t, `connection status` as _u_s FROM  logindata where `username` = '$username' and `password` = '$password'";
            $result = mysqli_query($conn,$sql_set_globals);
            
            if($result){
               // session_start();
                $final = mysqli_fetch_assoc($result);
                $_SESSION['connected_user_query'] = $final;
                header("Location: ../sources/HomePage2.php");
            }
            else{
                $error_message = "<p><kbd>Undefined error, check data base and globals !</kbd></p>";
                header("Location: ../sources/ErrorPage.php");
            }
        }
        else{
            $error_message = "<p><kbd>Data base login issues.</kbd></p>";
            header("Location: ../sources/ErrorPage.php");
        }
        //session_start();
        $_SESSION['error'] = $error_message;
        mysqli_close($conn);
    //}*/
    
?>
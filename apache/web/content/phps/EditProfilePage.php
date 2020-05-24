<?php

    include_once 'SQL_Connection.php';

    // ID  username  password email  first name  last name  adress  telephone  user type  validation status  connection status

    session_start();
    ////////////////////
    $time = $_SERVER['REQUEST_TIME'];

 
    $timeout_duration = 10;
 
    if (isset($_SESSION['LAST_ACTIVITY']) && 
       ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
            if(isset($_SESSION['connected_user_ID'])){ //redundanta conditia
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
        $_SESSION['error'] .=  "<p><kbd>Your session has expired</kbd></p>";
        header("Location: ../sources/ErrorPage.php");
    }
    
    
    /**
    * Finally, update LAST_ACTIVITY so that our timeout
    * is based on it and not the user's login time.
    */
        $_SESSION['LAST_ACTIVITY'] = $time;
        ///////////////////

        if (isset($_SESSION['connected_user_ID'])) {
            $id = $_SESSION['connected_user_ID'];
    
            //if (!empty($_POST)){

        
            $password = mysqli_real_escape_string($conn, $_POST['edit_pass']);
            $email = mysqli_real_escape_string($conn, $_POST['edit_email']);
            $fname = mysqli_real_escape_string($conn, $_POST['edit_fname']);
            $lname = mysqli_real_escape_string($conn, $_POST['edit_lname']);
            $add = mysqli_real_escape_string($conn, $_POST['edit_add']);
            $tel = mysqli_real_escape_string($conn, $_POST['edit_tel']);

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            //$_SESSION['update'];
            //update pass
            if (!empty($password)) {
                $sql_update_data = "UPDATE logindata SET `password`='$password' WHERE `ID` = '$id'";
                $query_update_data = mysqli_query($conn, $sql_update_data);
                if (!$query_update_data) {
                    exit("Couldn't update Password for editprofilepage");
                } else {
                    echo "pass ok";
                    $_SESSION['update'] .= "Password successfully updated! ";
                }
            }

            //if the email is already taken or invalid all the possible updates remain unexecuted
            //update email
            if (!empty($email)) {
                //verify if it's already taken
                $sql_ver_email = "SELECT * FROM  logindata where email = '$email'";
                $query_ver_email = mysqli_query($conn, $sql_ver_email);
                $nr = mysqli_num_rows($query_ver_email);
                if ($nr > 0) {
                    $_SESSION['error'] .=  "<p><kbd>Sorry... Emaily already taken. You cannot update it!</kbd></p>";
                    header("Location: ../sources/ErrorPage.php");
                } else {
                    //if no update
                    $sql_update_data = "UPDATE logindata SET `email`='$email' WHERE `ID` = '$id'";
                    $query_update_data = mysqli_query($conn, $sql_update_data);
                    if (!$query_update_data) {
                        exit("Couldn't update Email for editprofilepage");
                    } else {
                        echo "email ok";
                        $_SESSION['update'] .= "Email successfully updated! ";
                    }
                }
            }

            //update first name
            if (!empty($fname) && !isset($_SESSION['error'])) {
                $sql_update_data = "UPDATE logindata SET `first name`='$fname' WHERE `ID` = '$id'";
                $query_update_data = mysqli_query($conn, $sql_update_data);
                if (!$query_update_data) {
                    exit("Couldn't update First name  for editprofilepage");
                } else {
                    echo "fname ok";
                    $_SESSION['update'] .= "First name successfully updated! ";
                }
            }

            //update last name
            if (!empty($lname) && !isset($_SESSION['error'])) {
                $sql_update_data = "UPDATE logindata SET `last name`='$lname' WHERE `ID` = '$id'";
                $query_update_data = mysqli_query($conn, $sql_update_data);
                if (!$query_update_data) {
                    exit("Couldn't update Last name for editprofilepage");
                } else {
                    echo "lname ok";
                    $_SESSION['update'] .= "Last name successfully updated! ";
                }
            }

            //update adress
            if (!empty($add) && !isset($_SESSION['error'])) {
                $sql_update_data = "UPDATE logindata SET `adress`='$add' WHERE `ID` = '$id'";
                $query_update_data = mysqli_query($conn, $sql_update_data);
                if (!$query_update_data) {
                    exit("Couldn't update Address for editprofilepage");
                } else {
                    echo "adddress ok";
                    $_SESSION['update'] .= "Address successfully updated! ";
                }
            }

            //update telephone
            if (!empty($tel) && !isset($_SESSION['error'])) {
                $sql_update_data = "UPDATE logindata SET `telephone`='$tel' WHERE `ID` = '$id'";
                $query_update_data = mysqli_query($conn, $sql_update_data);
                if (!$query_update_data) {
                    exit("Couldn't update Telephone number for editprofilepage");
                } else {
                    echo "tell nr ok";
                    $_SESSION['update'] .= "Telephone number successfully updated! ";
                }
            }

            if (isset($_SESSION['update']) && !isset($_SESSION['error'])) {
                header("Location: ../sources/SuccessPage.php");
            }
        
            if (!isset($_SESSION['update']) && !isset($_SESSION['error'])) {
                $_SESSION['update'] = "No updates made";
                header("Location: ../sources/SuccessPage.php");
            }

            //}
   // else{
      //  echo "dsekjl";
    //}
        }
        mysqli_close($conn);
    
   
?>
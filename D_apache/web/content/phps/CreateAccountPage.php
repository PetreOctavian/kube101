<?php
    
    include_once 'SQL_Connection.php';

        
    if (!empty($_POST)) {

        //if(isset($_POST["submit"]))
    //{
        
        $username = mysqli_real_escape_string($conn,$_POST['user']);
        $password = mysqli_real_escape_string($conn,$_POST['pass']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $fname = mysqli_real_escape_string($conn,$_POST['fname']);
        $lname = mysqli_real_escape_string($conn,$_POST['lname']);
        $add = mysqli_real_escape_string($conn,$_POST['add']);
        $tel = mysqli_real_escape_string($conn,$_POST['tel']);
        $hashed_password = password_hash($password,PASSWORD_DEFAULT);
        
        /*VERIFY PASSWORD
            $input = $password;
            echo password_verify($input,$hashed_password); daca e 1 e ok

        */
    //}
        $sql_ver_username = "SELECT * FROM  logindata where username = '$username'";
        $sql_ver_email = "SELECT * FROM  logindata where email = '$email'";
        $out_ver_username = mysqli_query($conn,$sql_ver_username);
        $out_ver_email = mysqli_query($conn,$sql_ver_email);

        

        $t1 = mysqli_num_rows($out_ver_username);
        $t2 = mysqli_num_rows($out_ver_email);
        
        if($t1 > 0)
        {
            $error_message .=  "<p><kbd>Sorry... Username already taken. Try something else!</kbd></p>";
            header("Location: ../sources/ErrorPage.php");
        }
        if($t2 > 0)
        {
            $error_message .= "<p><kbd>Sorry... Email already taken. Try something else!</kbd></p>";
            header("Location: ../sources/ErrorPage.php");
        }
        session_start();

         ////////////////////
            /*$time = $_SERVER['REQUEST_TIME'];

            
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




        unset($_SESSION['error']);
        $_SESSION['error'] = $error_message;
        
        if(!isset($error_message))
        //if($error_message === NULL)
        {
            $sql_insert_account_info = "INSERT INTO logindata(`username`,`password`,`email`,`adress`,`telephone`,`first name`,`last name`) VALUE ('$username','$password','$email','$add','$tel','$fname','$lname')";
            $query_insert_account_info = mysqli_query($conn,$sql_insert_account_info);
            if(!$query_insert_account_info){
				exit("Error at inseting account data in data base(creating account)");
            }

            //if all good compose mail autehtification message 
            $info1 =  "Your account has been successfully created. An email has been sent to ";
            $info2 =  " with detailed instructions on how to activate it.";
            $email_verific = $info1 . '<a href="https://www.gmail.com/">' . $email . '</a>' . $info2;
            //$email_verific_f = "<p><kbd>$email_verific</kbd></p>";
            $_SESSION['amail'] =  $email_verific;


            header("Location: ../sources/SuccessPage.php");
            mysqli_close($conn);
            /*if( mysqli_query($conn,$sql)){
                //all good
                header("Location: ../sources/SuccessPage.php");
            }
            else{
                echo "insert error" . $sql . "<br>" . mysqli_error($conn);
            }*/
            
        }
    }
    

 

?>
    



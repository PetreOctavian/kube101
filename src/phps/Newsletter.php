<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../mail/src/Exception.php';
require '../mail/src/PHPMailer.php';
require '../mail/src/SMTP.php';
require '../mail/src/POP3.php';
require '../mail/src/OAuth.php';



// Load Composer's autoloader

//require './vendor/autoload.php';
//require 'vendor/autoload.php';
include_once 'SQL_Connection.php';



    if (!empty($_POST)) {
        print_r($_POST);

        $nl_email = mysqli_real_escape_string($conn, $_POST['newsletter_mail']);
        $nl_name = mysqli_real_escape_string($conn, $_POST['newsletter_name']);
        $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 1;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp1.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'wingfree.server.mail.anul3@gmail.com'; // SMTP username
        $mail->Password   = 'mergetreaba';                          // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('wingfree.server.mail.anul3@gmail.com', 'WingFree plane tickets');
        $mail->addAddress($nl_email, $nl_name);     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        // Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 8; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $nl_password = $randomString;                   
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Newsletter';
        $mail->Body    = 'Hello'. $nl_name .'!  You have a subscription for <b>WingFree Newsletter</b> and your password is '. $nl_password;
        
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    }
    else{
        echo "d;weshj";
    }
       
// Instantiation and passing `true` enables exceptions

?>
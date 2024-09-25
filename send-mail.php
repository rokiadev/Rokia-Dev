<?php
session_start();


// <?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


if (isset($_POST['submitContact'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    # code...
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->Username   = 'Ro 0 Web App@gmail.com';                     //SMTP username
    $mail->Password   = 'chtz ghzd skrr mryg';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //ENCRYPTION_STARTTLS 465 Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('Ro 0 Web App@gmail.com', 'Funda of app');
    $mail->addAddress('Ro 0 Web App@gmail.com', 'Funda of app');     //Add a recipient


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'New enquery - funda of app contact form';
    $mail->Body    = '
        <h3> Hello, You got a new enquery <<<3 </h3>
        <h4>Fullname: '.$name.'</h4>
        <h4>Email: '.$email.'</h4>
        <h4>Phone: '.$phone.'</h4>
        <h4>Message: '.$message.'</h4>
    ';

    if ($mail->send()) {
        # code...
        $_SESSION['status'] = 'thank you contact me I will reach you asap - Rokia.B <3';
        header("location: {$_SERVER["HTTP_REFERER"]}");
        exit(0);
    }
    else {
        # code...
        $_SESSION['status'] = 'Message could not be sent. Mailer Error: {$mail->ErrorInfo}';
        header("location: {$_SERVER["HTTP_REFERER"]}");
        exit(0);
    }

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
else {
    # code...
    header('location: index.php#contact');
    exit(0);
}

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendors/assets/vendor/autoload.php';
$mail = new PHPMailer(true);

include 'database.php';
$data = json_decode(file_get_contents('php://input'), true);
$announce = $data['announce'];

try {
    // $mail->SMTPDebug = 1;                    //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'nmsct.attendance.monitoring@gmail.com';                     // SMTP username
    $mail->Password   = 'krid xglq luum xmkt';                              // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;
    $mail->SMTPSecure = 'ssl';

    //Recipients
    $mail->setFrom('nmsct.attendance.monitoring@gmail.com', 'NMSCST Admin');

    // Fetch email addresses from the database
    $result = mysqli_query($con, "SELECT email FROM users");
    while ($row = mysqli_fetch_assoc($result)) {
        $mail->addAddress($row['email']);         // Add a recipient
    }

    $mail->addReplyTo('no-reply@code.org', 'Information');
    // Email subject
    $mail->Subject = 'Attention Students !!';

    // Set email format to HTML
    $mail->isHTML(true);

    // Email body content
    $mailContent = $announce;
    $mail->Body = $mailContent;
    $mail->send();
} catch (Exception $e) {
}

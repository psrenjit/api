<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Ensure you have the correct path to the autoload.php file
function sendEmail($email, $sub, $mobNo, $crimeNo, $station, $cfc)
{
    $mail = new PHPMailer(true);
    $response = [
        'status' => false,
        'message' => ''
    ];
    try {
        // Server settings
        $mail->SMTPDebug = 0;                                       // Enable verbose debug output (0 = off)
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'psrenjit@gmail.com';                   // Your Gmail address
        $mail->Password   = 'akbn zfrq bxcd vqak';                  // Your Gmail password or App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable SSL encryption
        $mail->Port       = 465;                                    // TCP port to connect to

        // Recipients
        $mail->setFrom('psrenjit@gmail.com', 'Renjith');
        $mail->addAddress($email, 'Certified copy Process of KOCHI CITY POLICE');  // Add a recipient

        // Content
        $mail->isHTML(true);                                        // Set email format to HTML
        $mail->Subject = 'Certified copy Process of KOCHI CITY POLICE';
        $mail->Body    = $sub . ' of ' . $mobNo . ' for the Crime no ' . $crimeNo . ' of station ' . $station . ' is ready at this office';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
        $response['status'] = true;
        $response['message'] = 'Email sent successfully.';
    } catch (Exception $e) {
        $response['message'] = "Email could not be sent. Error: {$mail->ErrorInfo}";
        error_log("Email error: {$mail->ErrorInfo}");
    }
    return $response;
}

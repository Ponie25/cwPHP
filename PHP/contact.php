<?php

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';

// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Check if form is submitted
    $subject = trim($_POST['subject'] ?? '');
    $body = trim($_POST['body'] ?? '');
    $altbody = trim($_POST['altbody'] ?? '');

    // Validate inputs
    if (empty($subject) || empty($body) || empty($altbody)) {
        echo "<script>alert('Please fill in all the fields before submitting');</script>";
    } else {
        try {
            // Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                 // Disable verbose debug output
            $mail->isSMTP();                                     // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                            // Enable SMTP authentication
            $mail->Username   = 'ponie.mailforwork@gmail.com';   // SMTP username
            $mail->Password   = 'lyez wypm fwqv opjw';           // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable implicit TLS encryption
            $mail->Port       = 587;                             // TCP port to connect to

            // Recipients
            $mail->setFrom('ponie.mailforwork@gmail.com', 'Admin'); // Admin email
            $mail->addAddress('mrsyuri312@gmail.com');      // Recipient

            // Content
            $mail->isHTML(true);                               // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = $altbody;

            $mail->send();

            // Success message
            echo "<script>alert('Message has been sent');</script>";
        } catch (Exception $e) {
            // Error message
            $errorMessage = $mail->ErrorInfo;
            echo "<script>alert('Message could not be sent. Mailer Error: $errorMessage');</script>";
        }
    }
}

ob_start();
include '../Template/contact.html.php';
$content = ob_get_clean();

include '../Template/layout.html.php';

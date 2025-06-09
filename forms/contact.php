<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Email recipient
$receiving_email_address = 'zintle@smsolutionspe.co.za';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Initialize PHPMailer
    $mail = new PHPMailer(true);
    try {
        // SMTP Settings (Optional)
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com'; // Replace with your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@example.com'; // Your SMTP username
        $mail->Password = 'your-email-password'; // Your SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email settings
        $mail->setFrom($email, $name);
        $mail->addAddress($receiving_email_address);
        $mail->Subject = $subject;
        $mail->Body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        if ($mail->send()) {
            echo "<h2 style='color:green;'>Message sent successfully!</h2>";
        } else {
            echo "<h2 style='color:red;'>Message could not be sent.</h2>";
        }
    } catch (Exception $e) {
        echo "<h2 style='color:red;'>Mailer Error: {$mail->ErrorInfo}</h2>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
</head>
<body>
    <h2>Contact Form Submission</h2>
</body>
</html>

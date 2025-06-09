<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // If installed via Composer
// If manually installed, use:
// require 'PHPMailer/src/PHPMailer.php';
// require 'PHPMailer/src/SMTP.php';
// require 'PHPMailer/src/Exception.php';

// Set recipient email address
$receiving_email_address = 'sesethucolleen495@gmail.com';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host       = 'smtp.yourcompany.com'; // Change this to your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'your-email@yourcompany.com'; // Your SMTP email
        $mail->Password   = 'your-email-password'; // Your SMTP email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587; // Use 465 for SSL

        // Email Headers
        $mail->setFrom($email, $name);
        $mail->addAddress($receiving_email_address, 'Company Contact');
        $mail->addReplyTo($email, $name);

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "<strong>Name:</strong> $name<br>
                          <strong>Email:</strong> $email<br>
                          <strong>Message:</strong><br>$message";

        // Send Email
        if ($mail->send()) {
            echo "Message has been sent successfully!";
        } else {
            echo "Error: " . $mail->ErrorInfo;
        }

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request!";
}
?>

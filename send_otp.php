<?php
include 'connect.php';
session_start();

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['sendOtp'])) {
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email = $_POST['email'];

    // Verify user details
    $verifyQuery = $conn->prepare("SELECT * FROM users WHERE firstName = ? AND lastName = ? AND email = ?");
    $verifyQuery->bind_param("sss", $firstName, $lastName, $email);
    $verifyQuery->execute();
    $result = $verifyQuery->get_result();

    if ($result->num_rows > 0) {
        $otp = rand(100000, 999999);

        $otpQuery = $conn->prepare("INSERT INTO otp_table (email, otp, created_at) VALUES (?, ?, NOW())");
        $otpQuery->bind_param("si", $email, $otp);
        $otpQuery->execute();

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'kimiczarsaltingv2@gmail.com';
            $mail->Password = 'icmr vngj fois cmic';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('kimiczarsaltingv2@gmail.com', 'Photography Studio Verification');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Your OTP Code';
            $mail->Body = "Your OTP code is: <b>$otp</b>";

            $mail->send();
            echo 'OTP has been sent to your email.';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        $_SESSION['email'] = $email;

        header("Location: verify_otp.html");
    } else {
        echo "No matching user found with the provided details.";
    }
}
?>

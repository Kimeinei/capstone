<?php
include 'connect.php';
session_start();

if (isset($_POST['verifyOtp'])) {
    $otp = $_POST['otp'];
    $email = $_SESSION['email'];

    if (empty($email)) {
        echo "<script>alert('Session expired. Please restart the process.'); window.location.href='recover.html';</script>";
        exit();
    }

    // Check OTP validity
    $otpQuery = $conn->prepare("SELECT * FROM otp_table WHERE email = ? AND otp = ? AND created_at > NOW() - INTERVAL 10 MINUTE");
    $otpQuery->bind_param("si", $email, $otp);
    $otpQuery->execute();
    $result = $otpQuery->get_result();

    if ($result->num_rows > 0) {
        header("Location: change_password.html");
    } else {
        echo "<script>alert('Wrong OTP. Please restart the process.'); window.location.href='recover.html';</script>";
    }
}
?>

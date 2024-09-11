<?php
include 'connect.php';
session_start();

if (isset($_POST['changePassword'])) {
    $newPassword = $_POST['newPassword'];
    $hashedPassword = md5($newPassword);
    $email = $_SESSION['email'];

    if (empty($email)) {
        echo "<script>alert('Session expired. Please restart the process.'); window.location.href='recover.html';</script>";
        exit();
    }

    // Update the user's password
    $updateQuery = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
    $updateQuery->bind_param("ss", $hashedPassword, $email);

    if ($updateQuery->execute()) {
        // Delete OTP from database
        $deleteOtpQuery = $conn->prepare("DELETE FROM otp_table WHERE email = ?");
        $deleteOtpQuery->bind_param("s", $email);
        $deleteOtpQuery->execute();

        echo "<script>alert('Password successfully updated!'); window.location.href='index.php';</script>";
    } else {
        echo "Error updating password: " . $conn->error;
    }
}
?>

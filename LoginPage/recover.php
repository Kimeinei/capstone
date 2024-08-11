<?php
include 'connect.php';

if (isset($_POST['recoverPassword'])) {
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email = $_POST['email'];
    $newPassword = $_POST['newPassword'];
    $hashedPassword = md5($newPassword);

    // Verify the user's details
    $verifyQuery = $conn->prepare("SELECT * FROM users WHERE firstName = ? AND lastName = ? AND email = ?");
    $verifyQuery->bind_param("sss", $firstName, $lastName, $email);
    $verifyQuery->execute();
    $result = $verifyQuery->get_result();

    if ($result->num_rows > 0) {
        // Update the user's password
        $updateQuery = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $updateQuery->bind_param("ss", $hashedPassword, $email);
        
        if ($updateQuery->execute()) {
            echo "Password successfully updated!";
            header("Location: index.php");
        } else {
            echo "Error updating password: " . $conn->error;
        }
    } else {
        echo "No matching user found with the provided details.";
    }
}
?>

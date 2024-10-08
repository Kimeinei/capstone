<?php
session_start();
include 'connect.php';

if (isset($_POST['signIn'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    
    // Use prepared statements to prevent SQL injection
    $sql = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $sql->bind_param("ss", $email, $password);
    $sql->execute();
    $result = $sql->get_result();

    $active = "online";

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];

        if ($row['user_type'] == 'employee') {
            $user_id = $row['id'];
            $_SESSION['user_id'] = $user_id;
            $stmt = $conn->prepare("UPDATE users SET status = ? WHERE id = ?");
            $stmt->bind_param("si", $active, $user_id); // "si" indicates string and integer
            $stmt->execute();
            $stmt->close();
            header("Location: dash_emp/dash_emp.php");
            exit();
        } 
        // Handle other user types
        else if ($row['user_type'] == 'admin') {
            $user_id = $row['id'];
            $_SESSION['user_id'] = $user_id;
            $stmt = $conn->prepare("UPDATE users SET status = ? WHERE id = ?");
            $stmt->bind_param("si", $active, $user_id); // "si" indicates string and integer
            $stmt->execute();
            $stmt->close();
            header("Location: dash_admin/dash_ad.php");
            exit();
        }

    } else {
        echo "Not Found, Incorrect Email or Password";
        exit(); // Stop further code execution
    }
} else {
    // Handle case where form is not submitted correctly
    echo "Form not submitted.";
    exit();
}
?>

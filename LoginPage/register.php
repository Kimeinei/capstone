<?php
session_start();
ob_start();

@include 'connect.php';

if(isset($_POST['submit'])){

    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);
    $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
    $pass = mysqli_real_escape_string($conn, md5($filter_pass));
 
    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');
 
    $status = "online";
    if(mysqli_num_rows($select_users) > 0){
       
       $row = mysqli_fetch_assoc($select_users);
 
       if($row['user_type'] == 'admin'){
          $user_id = $row['id'];
          $_SESSION['admin_name'] = $row['name'];
          $_SESSION['admin_email'] = $row['email'];
          $_SESSION['user_id'] = $user_id;
          mysqli_query($conn, "UPDATE users SET status = '$status' WHERE id = '$user_id'");
          $message[] = 'Logging In Successfully, Welcome '.$_SESSION['admin_name'].'!';
          header('refresh:3; seller_page.php');
          ob_end_flush();
       }
 
    //    elseif($row['user_type'] == 'user'){
    //       $user_id = $row['id'];
    //       $_SESSION['user_name'] = $row['name'];
    //       $_SESSION['user_email'] = $row['email'];
    //       $_SESSION['user_id'] = $user_id;
    //       mysqli_query($conn, "UPDATE users SET status = '$status' WHERE id = '$user_id'");
    //       $message[] = 'Logging In Successfully, Welcome '.$_SESSION['user_name'].'!';
    //       header('refresh:3; home.php');
    //       ob_end_flush();
 
    //    }
        else{
          $message[] = 'Invalid username please register!';
       }
 
    }else{
       $message[] = 'Incorrect Email or Password!';
    }
 
 }
 
 ?>
<?php
session_start();
ob_start();
@include 'connect.php';

$user_id = $_SESSION['user_id'];

$select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');

    $inactive = "offline";
   if(mysqli_num_rows($select_users) > 0){
      
      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){

            mysqli_query($conn, "UPDATE users SET status = '$inactive' WHERE id = '$user_id'");
            session_unset();
            session_destroy();

            header('location: ..MainPage/main_page/html.php');
            ob_end_flush();

      }
      elseif($row['user_type'] == 'employee'){

            mysqli_query($conn, "UPDATE users SET status = '$status' WHERE id = '$user_id'");
            session_unset();
            session_destroy();

            header('location: ..MainPage/main_page/html.php');
            ob_end_flush();

      }else{
            echo "Logging Out Failed!";
            exit(); // Stop further code execution
      }

   }else{
            echo "Logging Out Failed!";
            exit(); // Stop further code execution
   }

// session_destroy();
// // header("location: index.html");
// header("location: ..MainPage/main_page/html.php");
?>
<?php

include 'connect.php';

if(isset($_POST['signIn'])){
   $email=$_POST['email'];
   $password=$_POST['password'];
   $password=md5($password) ;
   
   $sql="SELECT * FROM users WHERE email='$email' and password='$password'";
   $result=$conn->query($sql);
   if($result->num_rows>0){
      session_start();
      $row=$result->fetch_assoc();
      $_SESSION['email']=$row['email'];

      if($row['user_type'] == 'employee'){
         $user_id = $row['id'];
         header("Location: dash_admin/dash_ad.php");
         exit();
         // header('refresh:3; MainPage/main_page.html');
         // ob_end_flush();
      }
      // elseif($row['user_type'] == 'admin'){
         
      // }
   //  header("Location: MainPage/main_page.html");
   //  exit();
   }
   else{
    echo "Not Found, Incorrect Email or Password";
   }

}
?>
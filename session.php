<?php
   include('database.php');
   session_start();
   
   $user_check = $_SESSION['user'];
   $account_check = $_SESSION['type'];
   
   $ses_sql = mysqli_query($db,"select username,account from accounts where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   $login_type = $row['account']
   
   if(!isset($_SESSION['user'])){
      header("location:index.php");
   }
?>
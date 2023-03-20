<?php

//start the session
session_start();

$error_message = '';

$servername = 'localhost';
$username = 'root';
$password = '';

//connecting to database.
try{
  $conn = new PDO("mysql:host = $servername;dbname=inventory", $username, $password);
  // set the PDO error mode to exception.
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
} catch(\Exception $e){
  $error_message = $e->getMessage();
}

if ($_POST){
  var_dump($_POST);
  $username = $_POST['username'];
  $password = $_POST['password'];
  

  $query = 'SELECT *FROM users WHERE users.email="' . $username . '" AND users.password="' . $password . '"';
  $stmt = $conn->prepare($query);
  $stmt->execute();


  if($stmt->rowCount()>0){
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $user = $stmt->fetchAll()[0];
    $_SESSION['user'] = $user;

    header('Location: dashboard.php');
    
  } else
    $error_message = 'Use Correct Credentials.';
 
}
?>


<!DOCTYPE html>
<html>
  <!-- Author: Dion Moraes 
     Roll no: 20CE20 -->
<head>
  <title> Inventory Management System </title>

  <link rel="stylesheet" type ="text/css" href="login.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Lora:ital@1&display=swap');
    </style>
  </head>
  <body id="loginBody">
    <?php 
    if(!empty($error_message)){ ?>
  <div id="errorMessage"> 
    <p> 
    <strong> Error: </strong> <?=$error_message ?> </p>
  </div>
  <?php } ?>
     <div class ="container">
       <div class= "loginHeader">
         <h1> Welcome </h1>
       </div>
         <div class = "loginBody">
            <form action="login.php" method="POST">
                <div class ="loginInputsContainer">
        <label for = "">Username</label>

        <input placeholder="username" name="username" type ="text" />
        </div>
     <div class = "loginInputsContainer">
       <label for ="">Password</label>
       <input placeholder="password" name="password" type="password" />
       </div>
       <div class="loginButtonContainer">
         <button>Login </button>
       </div>
       </form>
       </div>
    </body>
    </html>

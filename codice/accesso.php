<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<title>Login</title>
<meta name="keywords" content="Login">
<meta name="author" content="Belloni Laura, Contegno Matteo">
<link rel="stylesheet" type="text/css" href="../css/form.css">
<link rel="stylesheet" type="text/css" href="../css/root.css">
<link rel="stylesheet" type="text/css" href="../css/accesso.css">
</head>
<body>
<?php 
   include "sessionStart.php";
   require "isNotAlreadyLog.php";
?>
   <div class="top">
      <a href="home.php"><img class="logo" src="../assets/icon/navbar/logo.png" alt="logo LaMa"></a>
   </div>
   <div class = "boxForm">
      <div class="header">
         <img  class="profilo" src="../assets/icon/navbar/Profilo.png" alt="avatar con cappello e occhiali">
         <p class="boxTitle"> Accesso </p>
      </div>
      <form method="post" action="login.php" id="loginForm" >
         <input type="text" name="email" placeholder="Email" required><br>
         <input type="password" name="pass" placeholder="Password" required><br>
         <input type="submit" name="submit" value="Accedi" class="button" rel="noopener noreferrer"> 
      </form>
   </div>
   <div class="link"> 
      <p> Non hai un account? <a href="signUp.php" id="aRegister">Registrati</a></p>
   </div>
   <?php
               if(isset($_SESSION["error"])){
                  echo $_SESSION["error"];
                  unset($_SESSION["error"]);
               }
               else if(isset($_SESSION["succes"])){
                  echo $_SESSION["succes"];
                  unset($_SESSION["succes"]);
                  header("location: home.php");
               }
   ?>
</body>
</html>
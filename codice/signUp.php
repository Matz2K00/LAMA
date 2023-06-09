<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<title>Registration</title>
<meta name="keywords" content="Registration">
<meta name="author" content="Belloni Laura, Contegno Matteo">
<link rel="stylesheet" type="text/css" href="../css/form.css">
<link rel="stylesheet" type="text/css" href="../css/root.css">
<link rel="stylesheet" type="text/css" href="../css/registrazione.css">
</head>
<body>
<?php 
   include "sessionStart.php";
   require "isNotAlreadyLog.php";
?>
<div class="top">
   <a href="home.php"><img class="logo" src="../assets/icon/navbar/logo.png" alt="logo LaMa"></a>
</div>

<div class="boxForm">
   <div class="header">
      <img  class="profilo" src="../assets/icon/navbar/Profilo.png" alt="avatar con cappello e occhiali">
      <p class="boxTitle"> Registrazione </p>
   </div>
   <form method="post" action="registration.php" onsubmit="validateFormR(event)" id="signupForm">
      <input type="text" id="firstname" name="firstname" placeholder="Nome*" ><br>
      <input type="text" id="lastname" name="lastname" placeholder="Cognome*"><br>
      <input type="email" id="email" name="email" placeholder="Email*" required><br>
      <input type="password" id="pass" name="pass" placeholder="Password*" required><br>
      <input type="password" id="confirm" name="confirm" placeholder="Conferma password*" required><br>
      <p class="obbligatorio">*Campo obbligatorio</p>
      <input type="submit" name="submit" value="Registrati" class="button" rel="noopener noreferrer">
   </form>
</div>
<div class="link">
   <b>Hai già un account?</b><a href="accesso.php">Accedi</a>
</div>
<div class="showError" id="showError">
<?php
            if(isset($_SESSION["error"])){
               echo $_SESSION["error"];
               unset($_SESSION["error"]);
            }
            else if(isset($_SESSION["succes"])){
               unset($_SESSION["succes"]);
               header("location: home.php");
            }
?>
</div>
<script src="../typescript/validateregistration.ts"></script> 
</body>
</html>
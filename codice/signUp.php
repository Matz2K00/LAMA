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
   require "isAlreadyLog.php";
?>
<div class="top">
   <a href="home.php"><img class="logo" src="../assets/icon/navbar/logo.png" alt="logo LaMa" style="margin: 10px 0 -20px 57px;"></a>
</div>

<div class="boxForm" style="margin-top: 0px;">
   <div class="header">
      <img  class="profilo" src="../assets/icon/navbar/Profilo.png" alt="avatar con cappello e occhiali">
      <p class="boxTitle"> Registrazione </p>
   </div>
   <form method="post" action="registration.php" id="signupForm">
      <input type="text" id="firstname" name="firstname" onchange="firstnameOK(event)" placeholder="Nome*" ><br>
      <input type="text" id="lastname" name="lastname"  onchange="lastnameOK(event)" placeholder="Cognome*"><br>
      <input type="email" id="email" name="email"  onchange="emailOK(event)" placeholder="Email*" required><br>
      <input type="password" id="pass" name="pass"  onchange="passwordOK(event)" placeholder="Password*" required><br>
      <input type="password" id="confirm" name="confirm"  onchange="confirmOK(event)" placeholder="Conferma password*" required><br>
      <p class="obbligatorio">*Campo obbligatorio</p>
      <input type="submit" name="submit" value="Registrati" class="button" rel="noopener noreferrer">
   </form>
<div class="showError" id="showError">
<?php
            if(isset($_SESSION["error"])){
               echo $_SESSION["error"];
               unset($_SESSION["error"]);
            }
?>
</div>
</div>
<div class="link">
   <p><b>Hai già un account?  </b><a href="accesso.php"><U>Accedi</U></a></p>
</div>
<script src="../typescript/validateRegistration.js"></script> 
</body>
</html>
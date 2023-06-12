<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../css/root.css">
  <link rel="stylesheet" type="text/css" href="../css/form.css">
  <title>LAMA</title>
  <meta name="keywords " content="LAMA">
  <meta name="author " content="Belloni Laura, Contegno Matteo">
</head>
<body>
  <?php
  include "sessionStart.php";
  if(!isset($_SESSION['id_utente'])){
		header("Location: home.php");
    exit();
  }
  ?>
<div class="top">
    <a href="home.php"><img class="logo" src="../assets/icon/navbar/logo.png" alt="logo LaMa"></a>
</div>
<div class="boxForm">
    <div class="header">
      <img  class="profilo" src="../assets/icon/navbar/<?php echo isset($_SESSION['imgAvatar']) ? $_SESSION['imgAvatar'] : 1; ?>.png" alt="avatar del profilo">
      <p class="boxTitle">Esci</p>
    </div>
    <p class="out">Sei sicuro di voler uscire dal profilo?</p>
    <form method="post" action="confermaEsci.php" id="modPassForm">
    <input type="submit" name="submit" value="Conferma" class="button" rel="noopener noreferrer">
    </form>
</div>

  
</body>
</html>
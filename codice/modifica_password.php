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
?>
<div class="top">
    <a href="home.php"><img class="logo" src="../assets/icon/navbar/logo.png" alt="logo LaMa"></a>
</div>
<div class="boxForm">
    <div class="header">
    <img  class="profilo" src="../assets/icon/navbar/Profilo.png" alt="avatar con cappello e occhiali">
        <p class="boxTitle">Modifica password</p>
    </div>
    <form method="post" action="update_password" id="modPassForm">
    <input type="password" id="oldpass" name="oldpass" placeholder="Vecchia password" required><br>
    <input type="password" id="newpass" name="newpass" placeholder="Nuova password" required><br>
    <input type="password" id="confirm" name="confirm" placeholder="Conferma password" required><br>
    <input type="submit" name="submit" value="Modifica" class="button" rel="noopener noreferrer">
    </form>
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
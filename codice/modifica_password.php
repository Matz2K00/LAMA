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

    require 'sessionStart.php';
    if(!isset($_SESSION['id_utente'])){
        header("Location: accesso.php");
        exit();
    }
?>
    <div class="top">
        <a href="home.php"><img class="logo" src="../assets/icon/navbar/logo.png" alt="logo LaMa"></a>
    </div>
    <div class="boxForm">
        <div class="header">
        <img  class="profilo" src="../assets/icon/navbar/<?php echo $_SESSION["imgAvatar"]?>.png" alt="avatar per profilo">
            <p class="boxTitle">Modifica password</p>
        </div>
        <form method="post" action="update_password.php" id="modPassForm">
            <input type="password" id="oldpass" name="oldpass" placeholder="Vecchia password" onchange= required><br>
            <input type="password" id="newpass" name="newpass" placeholder="Nuova password" required><br>
            <input type="password" id="confirm" name="confirm" placeholder="Conferma password" required><br>
            <input type="submit" name="submit" value="Modifica" class="button" rel="noopener noreferrer">
        </form>
        <br>
        <div class="showError" id="showError">
        <?php
            if(isset($_SESSION["error"])){
                echo "<p>".$_SESSION["error"]."</p>";
                unset($_SESSION["error"]);
            }
            else if(isset($_SESSION["succes"])){
                echo "<p>".$_SESSION["succes"]."</p>";
                unset($_SESSION["succes"]);
                header("location: home.php");
            }
        ?>
        </div>
    </div>
    <script src="../typescript/validatePass.js"></script>
</body>
</html>
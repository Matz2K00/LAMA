<?php
include "db.php";
require "sessionStart.php";

if(isset($_POST['oldpass']) &&isset($_POST['newpass']) && isset($_POST['confirm'])){
    $old = trim($_POST["oldpass"]);
    $new = trim($_POST["newpass"]);
    $confirm = trim($_POST["confirm"]);

    $connessione = new mysqli($hostData, $userData, $paswData, $database);
    if ($connessione->connect_error) {
        die("Connessione al database fallita: " . $connessione->connect_error);
        header("Location: modifica_password.php");
        exit();
    }
    else{
        $sql = $connessione->prepare("SELECT * FROM Utenti WHERE email = ?");
        $sql->bind_param("s", $_SESSION['id_utente']);
        $sql->execute();
        $result = $sql->get_result();
        if ($result) {
            $row = $result->fetch_assoc();
        }
    }

    if(!password_verify($old, $row["password_hash"])){
        $_SESSION["error"] = "<p>Password errata</p>";
        header("Location: modifica_password.php");
        exit();
    }

    if($new != $confirm){
        $_SESSION["error"] = "Le password non coincidono<br>";
        header("Location: modifica_password.php");
        exit();
    }

    if($old == $new){
        $_SESSION["error"] = "La nuova password non può essere uguale alla vecchia<br>";
        header("Location: modifica_password.php");
        exit();
    }

    $new = password_hash($new, PASSWORD_DEFAULT);
    $currentEmail = $_SESSION['id_utente'];

    $stmt = $connessione->prepare("UPDATE Utenti SET password_hash = ? WHERE email= '$currentEmail'");
    $stmt->bind_param("s", $new);
    try {
        $returnValue = $stmt->execute();
        if($returnValue == 1){
            $_SESSION["succes"] = "Password modificata con successo!";
            $stmt->close();
            $sql->close();
            $result->free();
            $connessione->close();
            header("Location: show_profile.php");
        }
        else {
            $_SESSION["error"] = "Errore modifica password.";
            header("Location: modifica_password.php");
        }
    } catch(Exception $e){
        $_SESSION["error"] = "Errore modifica password!";
        header("Location: modifica_password.php");
    }
}

?>
<?php
$hostData = "localhost";
$userData = "root";
$paswData = "";
$database = "LAMA";

$connessione = new mysqli($hostData, $userData, $paswData, $database);
if ($connessione->connect_error) {
    die("Connessione al database fallita ");
    header("Location: signUp.php");
    exit();
}
?>
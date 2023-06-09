<?php
$id_corso = 22;
$id_utente = $_SESSION['id_utente'];

$valutazioneNuova = intval($_POST['valutazioneNuova'])+1;
require 'db.php';
$conn = new mysqli($hostData, $userData, $paswData, $database);
$sql = "UPDATE Acquisti 
        SET valutazione = ?
        WHERE valutazione IS NULL 
        AND id_corso = ? 
        AND id_utente = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $valutazioneNuova, $id_corso, $id_utente);
unset($valutazioneNuova);
$stmt->execute();
$stmt->close();
$conn->close();
?>
</div>
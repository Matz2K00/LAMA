<?php
require 'sessionStart.php';
if(!isset($_SESSION['id_utente'])){
    header("Location: accesso.php");
    exit();
}
if(!isset($_SESSION['id_corso'])){
    header("Location: cerca.php");
    exit();
}
$id_corso = intval($_SESSION['id_corso']);
$id_utente = $_SESSION['id_utente'];

include 'db.php';

$stmt = $connessione->prepare("UPDATE Acquisti 
    SET valutazione = NULL 
    WHERE valutazione IS NOT NULL 
    AND id_corso = ? 
    AND id_utente = ?");
$stmt->bind_param("is", $id_corso, $id_utente);
$stmt->execute();
$stmt->close();

$stmt = $connessione->prepare("UPDATE Corsi 
    SET valutazioneMedia = CAST( (
    SELECT AVG(valutazione) AS media_valutazione
    FROM Acquisti
    WHERE id_corso = ? AND valutazione IS NOT NULL
    )AS INT )WHERE id = ? ");
$stmt->bind_param("ii", $id_corso, $id_corso);
$stmt->execute();
$stmt->close();
$connessione->close();
?>
<h1>Valutazione annullata!</h1>
</div>
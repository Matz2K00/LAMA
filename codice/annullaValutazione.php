<?php
require 'sessionStart.php';
$id_corso = intval($_SESSION['id_corso']);
$id_utente = $_SESSION['id_utente'];

require 'db.php';
$conn = new mysqli($hostData, $userData, $paswData, $database);
$sql = "UPDATE Acquisti 
        SET valutazione = NULL
        WHERE valutazione IS NOT NULL 
        AND id_corso = ? 
        AND id_utente = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $id_corso, $id_utente);
$stmt->execute();
$stmt->close();

// aggiorno valutazioneMedia
$sql = "UPDATE Corsi
    SET valutazioneMedia = CAST( (
    SELECT AVG(valutazione) AS media_valutazione
    FROM Acquisti
    WHERE id_corso = ? AND valutazione IS NOT NULL
    )AS INT )WHERE id = ? ";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id_corso, $id_corso);
$stmt->execute();
$stmt->close();
$conn->close();
?>
<h1>Valutazione annullata!</h1>
</div>
<?php
require 'sessionStart.php';
$id_corso = intval($_SESSION['id_corso']);
$id_utente = $_SESSION['id_utente'];

$valutazioneNuova = intval($_POST['valutazioneNuova'])+1;
if($valutazioneNuova < 1 || $valutazioneNuova > 5){
    echo "<p>Errore in valutazione</p>";
    exit();
}
require 'db.php';
$conn = new mysqli($hostData, $userData, $paswData, $database);
$sql = "UPDATE Acquisti 
        SET valutazione = ? 
        WHERE valutazione IS NULL 
        AND id_corso = ? 
        AND id_utente = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $valutazioneNuova, $id_corso, $id_utente);
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
unset($valutazioneNuova);
$conn->close();
?>
<h1>Corso valutato!</h1>
</div>
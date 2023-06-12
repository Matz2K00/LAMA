<?php
// require 'db.php';
// $conn = new mysqli($hostData, $userData, $paswData, $database);

$sql = "UPDATE Corsi
    SET valutazioneMedia = CAST( (
    SELECT AVG(valutazione) AS media_valutazione
    FROM Acquisti
    WHERE id_corso = ? AND valutazione IS NOT NULL
    )AS INT )WHERE id = ? ";
$stmt = $conn->prepare($sql);

// query per calcolare numero dei corsi
$sqlCount = "SELECT COUNT(*) AS numero_righe FROM Corsi";
$stmtCount = $conn->prepare($sqlCount);
$stmtCount->execute();

$result = $stmtCount->get_result();
$row = $result->fetch_assoc();
$nCorsi = intval($row['numero_righe']);

// aggiorno ogni corso
for($i=1; $i<=$nCorsi; $i++){
    $stmt->bind_param("ii", $i, $i);
    $stmt->execute();
}
$stmt->close();
// $conn->close();
?>
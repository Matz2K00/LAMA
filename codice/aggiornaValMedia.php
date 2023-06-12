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

require 'db.php';
$conn = new mysqli($hostData, $userData, $paswData, $database);


// query per calcolare numero dei corsi
$sqlCount = "SELECT COUNT(*) AS numero_righe FROM Corsi";
$stmtCount = $conn->prepare($sqlCount);
$stmtCount->execute();
$result = $stmtCount->get_result();
$row = $result->fetch_assoc();
$nCorsi = intval($row['numero_righe']);

// valutazione media
$sqlVal = "UPDATE Corsi
    SET valutazioneMedia = CAST( (
    SELECT AVG(valutazione) AS media_valutazione
    FROM Acquisti
    WHERE id_corso = ? AND valutazione IS NOT NULL
    )AS INT )WHERE id = ? ";
$stmtVal = $conn->prepare($sqlVal);

// numero di valutazioni per corso
$sqlNU = "UPDATE Corsi
    SET nUtentiValut = (
    SELECT COUNT(DISTINCT id_utente)
    FROM Acquisti
    WHERE id_corso = ? AND valutazione IS NOT NULL
  )
  WHERE id = ?";
$stmtNU = $conn->prepare($sqlNU);

// aggiorno ogni corso
for($i=1; $i<=$nCorsi; $i++){
    
    $stmtVal->bind_param("ii", $i, $i);
    $stmtVal->execute();

    $stmtNU->bind_param("ii", $i, $i);
    $stmtNU->execute();
}
$stmtCount->close();
$stmtVal->close();
// $conn->close();
?>
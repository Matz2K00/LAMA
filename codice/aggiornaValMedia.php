<?php
require 'sessionStart.php';
include 'db.php';

// query per calcolare numero dei corsi
$stmtCount = $connessione->prepare("SELECT COUNT(*) AS numero_righe FROM Corsi");
$stmtCount->execute();
$result = $stmtCount->get_result();
$row = $result->fetch_assoc();
$nCorsi = intval($row['numero_righe']);

// valutazione media
$stmtVal = $connessione->prepare("UPDATE Corsi
    SET valutazioneMedia = CAST(
    (SELECT AVG(valutazione) AS media_valutazione
    FROM Acquisti
    WHERE id_corso = ? AND valutazione IS NOT NULL
    )AS INT )WHERE id = ? ");

// numero di valutazioni per corso
$stmtNU = $connessione->prepare("UPDATE Corsi
    SET nUtentiValut = (
    SELECT COUNT(DISTINCT id_utente)
    FROM Acquisti
    WHERE id_corso = ? AND valutazione IS NOT NULL
    )
    WHERE id = ?");

// aggiorno ogni corso
for($num=1; $num<=$nCorsi; $num++){
    
    $stmtVal->bind_param("ii", $num, $num);
    $stmtVal->execute();

    $stmtNU->bind_param("ii", $num, $num);
    $stmtNU->execute();
}
$stmtCount->close();
$stmtVal->close();
$stmtNU->close();
?>
<?php
// require 'sessionStart.php';
include 'db.php';

// query per calcolare numero dei corsi
$stmtCount = $connessione->prepare("SELECT COUNT(*) AS numero_righe FROM Corsi");
$stmtCount->execute();
$result = $stmtCount->get_result();
$row = $result->fetch_assoc();
$nCorsi = intval($row['numero_righe']);


// aggiorno ogni corso
for($num=1; $num<=$nCorsi; $num++){
// valutazione media
    $sqlVal = "UPDATE Corsi
            SET valutazioneMedia =
            (SELECT AVG(valutazione) AS media_valutazione
            FROM Acquisti
            WHERE id_corso = $num AND valutazione IS NOT NULL
            )WHERE id = $num ";
    $connessione->query($sqlVal);

    // numero di valutazioni per corso
    $sqlNU = "UPDATE Corsi
    SET nUtentiValut = (
    SELECT COUNT(DISTINCT id_utente)
    FROM Acquisti
    WHERE id_corso = $num AND valutazione IS NOT NULL
    )
    WHERE id = $num";
    $connessione->query($sqlNU);
   
}
$stmtCount->close();
?>
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

    $valutazioneNuova = intval($_POST['valutazioneNuova'])+1;
    if($valutazioneNuova < 1 || $valutazioneNuova > 5){
        echo "<p>Errore in valutazione</p>";
        exit();
    }
    include 'db.php';

    $stmt = $connessione->prepare("UPDATE Acquisti SET valutazione = ? WHERE valutazione IS NULL AND id_corso = ? AND id_utente = ?");
    $stmt->bind_param("iis", $valutazioneNuova, $id_corso, $id_utente);
    $stmt->execute();
    $stmt->close();

    // aggiorno valutazioneMedia
    $stmt = $connessione->prepare("UPDATE Corsi
        SET valutazioneMedia = (
        SELECT AVG(valutazione) AS media_valutazione
        FROM Acquisti
        WHERE id_corso = ? AND valutazione IS NOT NULL
        )WHERE id = ? ");
    $stmt->bind_param("ii", $id_corso, $id_corso);
    $stmt->execute();
    $stmt->close();
    unset($valutazioneNuova);
    $connessione->close();
?>
    <h1>Corso valutato!</h1>

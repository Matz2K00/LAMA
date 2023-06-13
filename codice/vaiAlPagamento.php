<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php
    require 'sessionStart.php';
    if(!isset($_SESSION['id_utente'])){
        header("Location: accesso.php");
        exit();
    }

    $id_utente = $_SESSION['id_utente'];
    include 'db.php';
    $stmt = $connessione->prepare("INSERT IGNORE INTO Acquisti (id_utente, id_corso) VALUES (?, ?)");

    include 'cookie.php';
    $corsi = $_COOKIE['corsi'];
    $array = unserialize($corsi);
    $values = array_values($array);

    for ($i=0; $i<count($array); $i++) {
        $id_corso = $values[$i];

        $stmt->bind_param("si", $id_utente, $id_corso);
        $stmt->execute();
    }
    $stmt->close();

    $stmt->close();
    $connessione->close();

    $nomeCookie = 'corsi';
    $scadenza = time() - 3600;
    setcookie($nomeCookie, null, $scadenza, "/");
?>

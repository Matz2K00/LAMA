<?php
$hostData = "localhost";
$userData = "root";
$paswData = "";
$database = "LAMA";
?>

<!-- Ho aggiunto l'utente utente_web_LAMA nel DB  con 

CREATE USER 'utente_web_LAMA'@'localhost' IDENTIFIED BY 'u7X9J3$%pA@q';

e gli ho dato i seguenti permessi:

GRANT SELECT ON LAMA.Corsi TO 'utente_web_LAMA'@'localhost';
GRANT SELECT, INSERT, UPDATE ON LAMA.Utenti TO 'utente_web_LAMA'@'localhost';
GRANT SELECT, INSERT, UPDATE, DELETE ON LAMA.Acquisti TO 'utente_web_LAMA'@'localhost';

quindi aggiorno la connessione  in  -->

<?php
// $hostData = "localhost";
// $userData = "utente_web_LAMA";
// $paswData = "u7X9J3$%pA@q";
// $database = "LAMA";
?>

<!-- tieni il codice che preferisci -->
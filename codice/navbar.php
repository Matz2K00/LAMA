
<?php 
    if (isset($_SESSION['id_utente']) && isset($_COOKIE['logid'])) {
        include 'navbar-NOprofilo.php';
    } 
    else {
        include 'navbar-profilo.php';
    }

?>


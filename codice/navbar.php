
<?php 
    if (isset($_SESSION['id_utente'])) {
        include 'navbar-profilo.php';
    } 
    else {
        include 'navbar-NOprofilo.php';
    }

?>


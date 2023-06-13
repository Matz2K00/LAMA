<?php
    include 'cookie.php';
    $corsi = array(); 
    $valoreCookie = serialize($corsi);
    $scadenza = time() + (30 * 24 * 60 * 60);
    setcookie($nomeCookie, $valoreCookie, $scadenza, "/");
?>
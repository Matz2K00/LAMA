<?php
    $nomeCookie = 'corsi';
    if (isset($_COOKIE[$nomeCookie])) {
        $valoreCookie = $_COOKIE[$nomeCookie];
        if (!empty($valoreCookie) && is_string($valoreCookie)) {
            $corsi = unserialize($valoreCookie);
            if (!is_array($corsi)){
                echo "Errore: il corso aggiunto al carrello non esiste! ";
                header("Location: carrello.php");
                exit();
            }
        } else {
            echo "Errore: il corso aggiunto al carrello non esiste! ";
            header("Location: carrello.php");
            exit();
        }
    } else {
        $corsi = array(); 
        $valoreCookie = serialize($corsi);
        $scadenza = time() + (30 * 24 * 60 * 60);
        setcookie($nomeCookie, $valoreCookie, $scadenza, "/");
    }
?>
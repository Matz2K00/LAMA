<?php
session_start();
foreach ($_SESSION as $name => $value) {
    echo "Nome: " . $name . ", Valore: " . $value . "<br>";
}
?>

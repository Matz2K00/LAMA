<?php
require 'sessionStart.php';

if(!isset($_SESSION['id_corso'])){
	header("Location: cerca.php");
    exit();
}

if (!isset($_POST['id_corso'])) {
	echo "Valore non ricevuto";
	exit();
}

$id_corso = intval($_POST['id_corso']);
$corsi = $_COOKIE['corsi'];
$corsi = unserialize($corsi);

if (reset($corsi) === '0') {
	array_shift($corsi);
}

if (!in_array($id_corso, $corsi)) {
	array_push($corsi, $id_corso);
}

$serialized_corsi = serialize($corsi);
$valoreCookie = serialize($corsi);
$nomeCookie = 'corsi';
$scadenza = time() + (30 * 24 * 60 * 60);
setcookie($nomeCookie, $valoreCookie, $scadenza, "/");
?>
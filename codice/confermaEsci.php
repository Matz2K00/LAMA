<?php
include "sessionStart.php";
if(!isset($_SESSION['id_utente'])){
	header("Location: home.php");
	exit();
} else {
	if (isset($_SERVER['HTTP_COOKIE'])) {
		$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
		foreach ($cookies as $cookie) {
			$parts = explode('=', $cookie);
			$name = trim($parts[0]);
			setcookie($name, '', time() - 3600);
			setcookie($name, '', time() - 3600, '/');
		}
	}
	session_unset();
	session_destroy();
	header("Location: home.php");
}
?>
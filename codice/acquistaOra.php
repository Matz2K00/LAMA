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

	$id_utente = $_SESSION['id_utente'];
	$id_corso = $_SESSION['id_corso'];

	include 'db.php';
	$stmt = $connessione->prepare("INSERT IGNORE INTO Acquisti (id_utente, id_corso) VALUES (?, ?)");
	$stmt->bind_param("si", $id_utente, $id_corso);
	$stmt->execute();
	$stmt->close();
	$connessione->close();
?>
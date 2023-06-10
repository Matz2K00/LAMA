<?php
include "db.php";
require "sessionStart.php";
require "isNotAlreadyLog.php";

	if(isset($_POST['firstname'])&&isset($_POST['lastname'])&&isset($_POST['email'])&&isset($_POST['pass'])&&isset($_POST['confirm'])){
		$nome = htmlspecialchars(trim($_POST["firstname"]));
		$cognome = htmlspecialchars(trim($_POST["lastname"]));
		$email = trim($_POST["email"]);
		$password = trim($_POST["pass"]);
		$confirm = trim($_POST["confirm"]);

		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$_SESSION["error"] = "Email non valida php";
			header("Location: signUp.php");
			exit();
		}
		//controllare che ci sia già un utente con la stessa email
		$connessione = new mysqli($hostData, $userData, $paswData, $database);
		if ($connessione->connect_error) {
			die("Connessione al database fallita: " . $connessione->connect_error);
			header("Location: signUp.php");
			exit();
		}
		else{
			$sql = $connessione->prepare("SELECT * FROM Utenti WHERE email = ?");
			$sql->bind_param("s", $email);
			$sql->execute();
			$result = $sql->get_result();
			if ($result) {
				$row = $result->fetch_assoc();
				if($row){
					$_SESSION["error"] = "Email già in uso<br>";
					header("Location: signUp.php");
					exit();
				}
			}
		}

		if(strlen($password)<10){
			$_SESSION["error"] = "inserire una password di almeno 10 caratteri<br>";
			header("Location: signUp.php");
			exit();
		}

		if($password != $confirm){
			$_SESSION["error"] =  "Le password non combaciano<br>";
			header("Location: signUp.php");
			exit();
		}

		$hash = password_hash($password, PASSWORD_DEFAULT); //PASSWORD_BCRYPT


		$stmt = $connessione->prepare("INSERT INTO Utenti (nome, cognome, email, password_hash) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("ssss", $nome, $cognome, $email, $hash);
		try {
			$returnValue = $stmt->execute();
			if($returnValue == 1){
				$_SESSION["succes"] = "Registrazione effettuata con successo!";
				$_SESSION['id_utente']=$email;
				$_SESSION["nome"]=$nome;
				$_SESSION["cognome"]=$cognome;
				header("Location: home.php");
			}
			else {
				$_SESSION["error"] = "L'email o la password sono sbagliati.";
				header("Location: signUp.php");
			}
		} catch(Exception $e){
			$_SESSION["error"] = "Errore inserimento utente!";
			header("Location: signUp.php");
			}

		$stmt->close();
		$sql->close();
		$returnValue->free();
		$connessione->close();
	}
	else{
		header("Location: signUp.php"); 
	}
?>
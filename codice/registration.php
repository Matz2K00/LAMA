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

		$utenti_pattern = "/^[\\w\\s'àèéìòù]*$/u";

		if(preg_match($utenti_pattern, $nome)){
			$_SESSION["error"] = "<p>Errore in nome</p>";
			header("Location: signUp.php");
			exit();
		}
		if(preg_match($utenti_pattern, $cognome)){
			$_SESSION["error"] = "<p>Errore in cognome</p>";
			header("Location: signUp.php");
			exit();
		}
		
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$_SESSION["error"] = "Email non valida php";
			header("Location: signUp.php");
			exit();
		}
		//controllare che ci sia già un utente con la stessa email
		$connessione = new mysqli($hostData, $userData, $paswData, $database);
		if ($connessione->connect_error) {
			die("Connessione al database fallita ");
			header("Location: signUp.php");
			exit();
		}
		
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

		$hash = password_hash($password, PASSWORD_DEFAULT); 

		$stmt = $connessione->prepare("INSERT INTO Utenti (nome, cognome, email, password_hash) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("ssss", $nome, $cognome, $email, $hash);
		try {
			$returnValue = $stmt->execute();
			if($returnValue == 1){
				$stmt->close();
				$sql->close();
				$connessione->close();
				header("Location: accesso.php");
				exit();
			}
			else {
				$_SESSION["error"] = "L'email o la password sono sbagliati.";
				header("Location: signUp.php");
				exit();
			}
		} catch(Exception $e){
			$_SESSION["error"] = "Errore inserimento utente!";
			header("Location: signUp.php");
			exit();
		}
	}
	else{
		header("Location: signUp.php"); 
		exit();
	}
?>
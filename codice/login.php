<?php
include "db.php";
require "sessionStart.php";
require "isAlreadyLog.php";

    if(isset($_POST['email'])&&isset($_POST['pass'])){
		$email = trim($_POST["email"]);
		$password = trim($_POST["pass"]);

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$_SESSION["error"] = "Email non valida<br>";
			header("Location: accesso.php");
			exit();
		}

        $connessione = new mysqli($hostData, $userData, $paswData, $database);
		if ($connessione->connect_error) {
			die("Connessione al database fallita ");
			header("Location: accesso.php");
			exit();
		}
        else{
        $sql = $connessione->prepare("SELECT * FROM Utenti WHERE email = ?");
        $sql->bind_param("s", $email);
        $sql->execute();
        $result = $sql->get_result();
        if ($result){
            $row = $result->fetch_assoc();
            if($row<1){
                $_SESSION["error"] = "Email non registrata<br>";
                header("Location: accesso.php");
                exit();
                }
            }
        }

        if(!password_verify($password, $row["password_hash"])){
            $_SESSION["error"] = "<p>Password errata</p>";
            header("Location: accesso.php");
            exit();
        }

        $_SESSION['id_utente'] = $email;
        $_SESSION["nome"] = $row["nome"]; 
        $_SESSION["imgAvatar"] = $row["imgAvatar"];
        $sql->close();
        $connessione->close();
        
        header("Location: home.php");
        exit();
    }else{
        header("Location: accesso.php"); 
    }
?>

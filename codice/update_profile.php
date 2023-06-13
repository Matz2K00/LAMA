<?php 
    include "sessionStart.php";
    include "db.php";

    if(!isset($_SESSION['id_utente'])){
        header("Location: accesso.php");
        exit();
    }

    if(isset($_POST['firstname'])&&isset($_POST['lastname'])&&isset($_POST['email'])){
        $nome = htmlspecialchars(trim($_POST["firstname"]));
        $cognome = htmlspecialchars(trim($_POST["lastname"]));
        $email = trim($_POST["email"]);

        $utenti_pattern = "^[A-Za-zÀ-ÿ][A-Za-zÀ-ÿ']*$";

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
            $_SESSION["error"] = "Email non valida<br>";
            header("Location: show_profile.php");
            exit();
        }
        
        if ($connessione->connect_error) {
            die("Connessione al database fallita: " . $connessione->connect_error);
            header("Location: show_profile.php");
            exit();
        }

        if(isset($_POST['dataDiNascita']) || isset($_POST['citta']) || isset($_POST['professione']) || isset($_POST['colorePreferito'])){
            $data = ($_POST["dataDiNascita"]);
            $dataDiNascita = date('Y-m-d', strtotime($data));
            $citta = htmlspecialchars(trim($_POST["citta"]));
            $professione = htmlspecialchars(trim($_POST["professione"]));
            $colorePreferito = htmlspecialchars(trim($_POST["colorePreferito"]));
            
            if(preg_match($utenti_pattern, $citta)){
                $_SESSION["error"] = "<p>Errore in citta</p>";
                header("Location: signUp.php");
                exit();
            }
            if(preg_match($utenti_pattern, $professione)){
                $_SESSION["error"] = "<p>Errore in professione</p>";
                header("Location: signUp.php");
                exit();
            }
            if(preg_match($utenti_pattern, $colorePreferito)){
                $_SESSION["error"] = "<p>Errore in colorePreferito</p>";
                header("Location: signUp.php");
                exit();
            }
        }

        $currentEmail = $_SESSION['id_utente'];

        $stmt = $connessione->prepare("UPDATE Utenti 
        SET nome = ?, 
        cognome = ?, 
        email = ?, 
        dataDiNascita= ?, 
        citta= ?, 
        professione= ?, 
        colorePreferito= ?  
        WHERE email= '$currentEmail'");

        $stmt->bind_param("sssssss", $nome, $cognome, $email, $dataDiNascita, $citta, $professione, $colorePreferito);
            try {
                $returnValue = $stmt->execute();
                if($returnValue == 1){
                    $_SESSION['id_utente']=$email;
                    $_SESSION["nome"]=$nome;
                    $stmt->close();
                    $connessione->close();
                    header("Location: home.php");
                }
                else {
                    $_SESSION["error"] = "L'email o la password sono sbagliati.";
                    header("Location: show_profile.php");
                }
            } catch(Exception $e){
                $_SESSION["error"] = "Errore inserimento utente!";
                header("Location: show_profile.php");
                }
        }
	else{
		header("Location: show_profile.php"); 
	}
?>

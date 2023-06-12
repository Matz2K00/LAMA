<?php
	if(isset($_SESSION['id_utente'])){
		header("Location: home.php");
		exit();
	}
?>
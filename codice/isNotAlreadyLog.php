<?php
	if(isset($_SESSION['id_utente']) || isset($_COOKIE['logid'])){
		header("Location: home.php");
	}
?>
<?php
	require 'sessionStart.php';
	if (isset($_POST['id_corso'])) {
		$id = $_POST['id_corso'];
		$_SESSION['id_corso'] = $id;
	} else {
		echo "Valore POST non ricevuto";
	}
?>

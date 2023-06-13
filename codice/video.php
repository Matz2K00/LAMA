<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../css/root.css">
<link rel="stylesheet" type="text/css" href="../css/navbar.css">
<link rel="stylesheet" type="text/css" href="../css/footer.css">
<link rel="stylesheet" type="text/css" href="../css/corso.css">
<link rel="stylesheet" type="text/css" href=".../css/video.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<title>LAMA</title>
<meta name="keywords " content="LAMA">
<meta name="author " content="Belloni Laura, Contegno Matteo">
</head>
<body>
	<div class="video-page">
		<?php 
			require 'sessionStart.php';
			include 'navbar.php';
			if(!isset($_SESSION['id_corso'])){
				echo "<p> Non ci sono video selezionati</p>";
				exit();
			}
		
			if(!isset($_SESSION['id_utente'])){
				$id_corso = $_SESSION['id_corso'];
				include 'video-NOcomprato.php';
			} else {
				$id_corso = $_SESSION['id_corso'];
				$id_utente = $_SESSION['id_utente'];
				include 'db.php';
				$stmt = $connessione->prepare("SELECT * FROM Acquisti WHERE id_utente = ? AND id_corso = ?");
				$stmt->bind_param("si", $id_utente, $id_corso);
				$stmt->execute();
				$result = $stmt->get_result();

				if ($result->num_rows <= 0){
					include 'video-NOcomprato.php';
				}
				else {
					include 'video-comprato.php';
				}
				$stmt->close();
				$connessione->close();
			}
		?>
	<div>
	<?php include 'footer.php';?>
</body>
</html>
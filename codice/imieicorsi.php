<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../css/root.css">
<link rel="stylesheet" type="text/css" href="../css/navbar.css">
<link rel="stylesheet" type="text/css" href="../css/footer.css">
<link rel="stylesheet" type="text/css" href="../css/corso.css">
<link rel="stylesheet" type="text/css" href="../css/carrello.css">
<title>LAMA</title>
<meta name="keywords " content="LAMA">
<meta name="author " content="Belloni Laura, Contegno Matteo">
</head>
<body>

    <?php 
    require 'sessionStart.php';
    if(!isset($_SESSION['id_utente'])){
		header("Location: accesso.php");
		exit();
    }
    unset($_SESSION['id_corso']);
    $email = $_SESSION['id_utente'];

    include 'navbar.php';
	?>
	<div class="carrello-page">
		<div class="title">
			<img class="cart" src="../assets/icon/navbar/<?php echo isset($_SESSION['imgAvatar']) ? $_SESSION['imgAvatar'] : 1; ?>.png" alt="icona grafica stilizzata di una persona con i capelli castano il cappello nero e gli occhiali">
			<h1 class="imieicorsi">I miei corsi</h1>
		</div>
		<div class="carrello-wrapper">
			<?php

			include 'db.php';
			$stmt = $connessione->prepare("SELECT * FROM Corsi WHERE id IN (SELECT id_corso FROM Acquisti WHERE id_utente = ?)");
			$stmt->bind_param("s",$email);
			$stmt->execute();
			$result = $stmt->get_result();

			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					$id = $row["id"];
					$titolo = $row["titolo"];
					$autore = $row["autore"];
					$descrizione = $row["descrizione"];
					$prezzo = $row["prezzo"];
					$altImg = $row["altImg"];
					$urlImg = "../assets/img/corsi/".$id.".jpg";
					$parole = explode(' ', $descrizione);
					$primeDieciParole = array_slice($parole, 0, 10);
					$descrizioneBreve = implode(' ', $primeDieciParole);
					?>
					<div class="card">
						<button class="vaiAlCorso" data-id-corso="<?php echo $id; ?>">
							<img class="img-corso" src='<?php echo $urlImg; ?>' alt='<?php echo $altImg; ?>' height="300">
							<div class="info card-height">
								<div class="texts">
									<h2><?php echo $titolo; ?></h2>
									<p><?php echo $autore; ?></p>
									<p><?php echo $descrizioneBreve." ..."; ?></p>
								</div>
							</div>
						</button>
					</div>
					<?php 
				}
			} else{
				echo "<p>Non hai comprato nessun corso </p>";
			}
			$stmt->close();
			$connessione->close();
			?>
		</div>
		<a class="altriCorsi" href="cerca.php"><p>Vedi altri corsi</p></a>
	</div>
	<?php include 'footer.php';?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="../typescript/vaiAlCorso.js"></script>
</body>
</html>
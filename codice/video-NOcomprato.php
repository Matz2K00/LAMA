<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php
	// require 'sessionStart.php';
	if(!isset($_SESSION['id_corso'])){
		echo "<p> Non ci sono video selezionati</p>";
		exit();
	}

	$id_corso = intval($_SESSION['id_corso']);
	include 'db.php';
	$stmt = $connessione->prepare("SELECT * FROM Corsi WHERE id = ? ");
	$stmt->bind_param("i", $id_corso);

	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$id = $row["id"];
			$titolo = $row["titolo"];
			$autore = $row["autore"];
			$descrizione = $row["descrizione"];
			$prezzo = $row["prezzo"];
			$valutazioneMedia = $row["valutazioneMedia"];
			$altImg = $row["altImg"];
			$urlImg = "../assets/img/corsi/".$id.".jpg";
		}
	} else {
		echo "Non esiste il corso selezionato";
	}
	?>  

	<video poster='<?php echo $urlImg; ?>' width="50%" height="50%">
		Your browser does not support the video tag.
	</video>
	<div class="video-info">
		<div class="video-info__left">
			<h2><?php echo $titolo; ?></h2>
			<p><?php echo $autore; ?></p>
			<p><?php echo $descrizione; ?></p>
		</div>
		<div class="video-info__right">
			<div class="valutazione">
				<p>E' stato valutato</p>
				<div class="stars">
					<?php
						include 'stelline.php';
					?>
				</div>
			</div> 

			<div class="prezzo">
				<p><?php echo $prezzo." €"; ?></p>
				<p>Disponibilità immediata</p>
				<p>Il corso sarà disponibile<br>in <b>I miei corsi</b><br>Non ha una scadenza</p>
				<p>Potrai guardarlo più volte<br>nell'ordine che preferisci</p>

				<?php 
				include 'cookie.php';
				if (in_array($id, $corsi)) {
					echo '<button class="carrelloBtn">Aggiunto</button>';
				} else {
					echo '<button class="carrelloBtn" id="aggiungiAlCarrello" onclick="showCheck()">Aggiungi al carrello</button>';
				}
				?>
				<script>
					$(document).ready(function() {
						$("#aggiungiAlCarrello").click(function() {
							var id_corso = parseInt(<?php echo intval($id_corso);?>);
							$.ajax({
								url: "aggiungiAlCarrello.php", 
								type: "POST",
								data: { id_corso: id_corso }, 
								success: function(response) {
									setTimeout(function() {
									location.reload();
									}, 60000); // Ritardo di 1 minuto
								}
							});
						});
					});
					function showCheck() {
						var button = document.getElementById("aggiungiAlCarrello");
						button.innerHTML = '<i class="fas fa-check"></i>';
					}
				</script>

				<?php
					$_SESSION['id_corso'] = $id_corso;
					if(!isset($_SESSION['id_utente'])){
						echo '<button class="primaAccedi acquistaBtn">Acquista ora</button> ';
				?>
					<script>
						document.addEventListener('DOMContentLoaded', function() {
							var button = document.querySelector('.primaAccedi');
							var nome = 'acquistaOra';
							var acquisti = true;
							var scadenza = new Date();
							scadenza.setTime(scadenza.getTime() + 30 * 1000);
							var scadenzaString = scadenza.toUTCString();
							button.addEventListener('click', function() {
							document.cookie = nome + "=" + acquisti + "; expires=" + scadenzaString + "; path=/";
							window.location.href = 'accesso.php';
							});
						});
					</script>

				<?php
				} else {
					echo '<button class="acquistaOra acquistaBtn">Acquista ora</button> ';
					?>
					<script>
						$(document).ready(function() {
							$(".acquistaOra").click(function() {
								$.ajax({
								url: "acquistaOra.php", 
								type: "POST",
								success: function(response) {
									location.reload();
								}
							});
						});
					});
					</script>
					<?php
				}
				?>
				</div>
				</div>
	</div>
	<div class="other" >
		<a href="cerca.php">Altri corsi</a>
	</div>
<script src="../typescript/vaiAlCorso.js"></script>


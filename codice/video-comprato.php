<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php
	// require 'sessionStart.php';
	if(!isset($_SESSION['id_corso'])){
		echo "<p> Non ci sono video selezionati</p>";
		exit();
	}
	
	if(!isset($_SESSION['id_utente'])){
		echo "<p> accedi prima al tuo account </p>";
		exit();
	}

	$stmt = $connessione->prepare("SELECT * FROM Acquisti 
		JOIN Corsi ON Acquisti.id_corso = Corsi.id 
		WHERE Acquisti.id_utente = ?
		AND Acquisti.id_corso = ? ");
	$stmt->bind_param("si", $id_utente, $id_corso);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$id = $row["id"];
			$titolo = $row["titolo"];
			$autore = $row["autore"];
			$descrizione = $row["descrizione"];
			$valutazione = $row["valutazione"];
			$altImg = $row["altImg"];
			$urlImg = "../assets/img/corsi/".$id.".jpg";
		}
	} else {
	echo "Erroe: non esistono corsi con questo id : $id_corso";
	}
	?>

	<video poster='<?php echo $urlImg; ?>' width="50%" height="50%" controls>
		<source src="../assets/video.mp4" type="video/mp4">
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
				<p><?php echo ($valutazione !== NULL) ? "<p>La tua valutazione</p>" : "<p>Valuta il corso</p>"; ?></p>
				<div class="stars">
					<?php
						if ($valutazione !== NULL && $valutazione >= 0 && $valutazione < 6) {
							$gialla = $valutazione;
							$grigia = 5-$valutazione;
							for ($i = 0; $i < $gialla; $i++) { echo '<img src="../assets/icon/star/gialla.svg" alt="stella gialla" height="30">'; }
							for ($i = 0; $i < $grigia; $i++) { echo '<img src="../assets/icon/star/grigia.svg" alt="stella grigia" height="30">'; }
						}
						if ($valutazione === NULL) {
							for ($i = 0; $i < 5; $i++) { echo '<img src="../assets/icon/star/grigia.svg" alt="stella grigia" height="30" class="star" data-value="'.$i.'">'; }
						}
					?>
				</div>
			</div> 
			<?php if ($valutazione !== NULL){ echo '<p class="annullaValutazione">Annulla valutazione</p>';}?>
		</div>
	</div>

	<script>
	const stars = document.querySelectorAll('.star');
	stars.forEach(star => {
		star.addEventListener('mouseover', () => {
		const value = parseInt(star.dataset.value);
		for (let i = 0; i <= value; i++) {
			stars[i].src = '../assets/icon/star/gialla.svg';
		}
		});
		star.addEventListener('mouseout', () => {
		const value = parseInt(star.dataset.value);
		for (let i = 0; i <= value; i++) {
			if (i >= 0) {
			stars[i].src = '../assets/icon/star/grigia.svg';
			}
		}
		});
	});
	</script>

	<script>
	$(document).ready(function() {
		$('.star').click(function() {
		var valutazioneNuova = $(this).data("value");      
		$.ajax({
			url: "valutazione.php",
			type: "POST",
			data: { valutazioneNuova: valutazioneNuova },
			success: function(response) {
				location.reload();
			}
		});
		});
	});
	</script>

	<script>
	$(document).ready(function() {
		$('.annullaValutazione').click(function() {
		$.ajax({
			url: "annullaValutazione.php",
			type: "POST",
			success: function(response) {
			console.log(response);
			location.reload();
			}
		});
		});
	});
	</script>

	<div class="other" >
		<a href="cerca.php">Altri corsi</a>
	</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php
	// require "sessionStart.php";
	$stmt->execute();
	$result = $stmt->get_result();

	$stmtCount->execute();
	$resultCount = $stmtCount->get_result();

	$rowCount = $resultCount->fetch_assoc();
	$totalCorsi = $rowCount['total'];

	$totalPagine = ceil($totalCorsi / $corsiPerPagina);
	$paginaCorrente = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
	$inizio = ($paginaCorrente - 1) * $corsiPerPagina;

	$sqlWithLimit = $sql . " LIMIT ?, ?";
	
	if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
		$stmtWithLimit = $connessione->prepare($sqlWithLimit);
		if($val === true){
			$stmtWithLimit->bind_param("iii", $numeroVal, $inizio, $corsiPerPagina);
		} else {
			$stmtWithLimit->bind_param("ssssii", $keyword, $keyword, $keyword, $keyword, $inizio, $corsiPerPagina);
		}
	} else {
		$stmtWithLimit = $connessione->prepare($sqlWithLimit);
		$stmtWithLimit->bind_param("ii", $inizio, $corsiPerPagina);
	}
	
	$stmtWithLimit->execute();
	$resultWithLimit = $stmtWithLimit->get_result();

	if ($resultWithLimit->num_rows > 0) {
		while ($row = $resultWithLimit->fetch_assoc()) {
			$id = $row["id"];
			$titolo = $row["titolo"];
			$autore = $row["autore"];
			$descrizione = $row["descrizione"];
			$prezzo = $row["prezzo"];
			$valutazioneMedia = $row["valutazioneMedia"];
			$nUtentiValut = $row["nUtentiValut"];
			$altImg = $row["altImg"];
			$urlImg = "../assets/img/corsi/".$id.".jpg";
			$parole = explode(' ', $descrizione);
			$primeDieciParole = array_slice($parole, 0, 10);
			$descrizioneBreve = implode(' ', $primeDieciParole);
			?>
			<button class="vaiAlCorso" data-id-corso="<?php echo $id; ?>">
				<img class="img-corso" src='<?php echo $urlImg; ?>' alt='<?php echo $altImg; ?>'>
				<div class="info">
					<div class="texts"> 
						<h2><?php echo $titolo; ?></h2>
						<p><?php echo $autore; ?></p>
						<p><?php echo $descrizioneBreve." ..."; ?></p>
					</div>
					<div class="rating"> 
						<div class="stars"> 
							<?php
							include "stelline.php";
							?>
						</div>
						<p><?php echo "Valutata da " . ($nUtentiValut ?? 0) . " utenti";?></p>
					</div>
				</div>
			</button>
			<script src="../typescript/vaiAlCorso.js"></script>
		<?php 
		}
	} else {
		echo $end;
	}
?>

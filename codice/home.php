<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../css/root.css">
<link rel="stylesheet" type="text/css" href="../css/navbar.css">
<!-- <link rel="stylesheet" type="text/css" href="../css/corso.css"> -->
<link rel="stylesheet" type="text/css" href="../css/home.css">
<link rel="stylesheet" type="text/css" href="../css/footer.css">
<title>LAMA</title>
<meta name="keywords " content="LAMA">
<meta name="author " content="Belloni Laura, Contegno Matteo">
</head>
<body>
	<?php 
		require 'sessionStart.php';
		if(isset($_COOKIE['primaAccedi'])){
			header("Location: carrello.php");
			exit();
		}
		if(isset($_COOKIE['acquistaOra'])){
			header("Location: video.php");
			exit();
		}
	?>

	<div class="nav">
		<?php include 'navbar.php';?>
	</div>
	<div class="home">	
		<div class="section-1">
			<div class="section-1__left">
				<p><?php echo isset($_SESSION["nomeutente"]) ? "Benvenutx ".$_SESSION["nomeutente"] : "Impara con <br>LAMA"; ?></p>
				<p>I tuoi corsi ovunque!</p>
				<!-- <img src="../assets/img/wave.png">  -->
			</div>
			<div class="section-1__right">
				<p>Trova quello<br>fatto apposta per <span>TE</span></p>
			</div>
		</div>
		
		<div class="section-2">
			<p>I nostri corsi</p>
			<div class="section-2__corsi">
				<?php
					$corsiPerPagina = 6;
					include 'db.php';
					$sql = "SELECT * FROM Corsi";
					$stmt = $connessione->prepare($sql);
					$sqlCount = "SELECT COUNT(*) AS total FROM Corsi";
					$stmtCount = $connessione->prepare($sqlCount);
					$start = "";
					$end = "";
					include "corsiPerPagina.php";
					$stmt->close();
					$connessione->close();
				?>
			</div>
			<a href="cerca.php">Vai a tutti i corsi</a>
		</div>
		
		<div class="section-3">  
			<p>LAMA ti fa scoprire il<br>mondo</p>
			<img src="../assets/img/geometry.svg">
		</div>

		<div class="section-4">
			<div class="section-4__left">
				<p>
					Il tuo spazio
					<br>per imparare
				</p>
				<p>
					Che sia la tua scrivania, il caffè
					<br>sotto casa o il treno
					<br><br>trova il tuo spazio per IMPARARE!
				</p>
			</div>
			<div class="section-4__right">
				<img src="../assets/img/girl-computer-1.svg" alt="Disegno di una persona alla scrivania al computer che mangia mentre una persona in pigiama si dirige alla propria scrivania"> 
				</div>  
			</div>

		<div class="section-5">
			<div class="section-5__left">
				<img src="../assets/img/girl-computer-2.svg" alt="Disegno di una persona alla scrivania al computer di schiena con una camicia bianca e circondata da piante"> 
			</div>  
			<div class="section-5__right">
				<p>
					Ritrova le tue
					<br>passioni
				</p>
				<p>
					Prenditi il tempo per te e 
					<br>per i tuoi interessi,
					<br><br>ora è FACILE.
				</p>
			</div>
		</div>

		<div class="section-6">  
			<p>
				Per tutte
				<br>le età
			</p>
			<p>
				<br><br>Non esiste età GIUSTA
				<br>Per imparare!
			</p>
			<div>
				<img src="../assets/img/girl.jpg" alt=""> 
				<img class="floating" src="../assets/img/family.png" alt="Disegno di 5 persone di età diverse che si abbracciano, impoteticamente una famiglia con nonni e bambini"> 
			</div>
		</div>
		
		<div class="section-7">
			<div class="section-7__left">
				<p>
					Impara
					<br>e divertiti
				</p>
				<p>
					Condividi le lezioni con le
					<br>persone che ami
					<br><br>Una nuova opportunità per
					<br>imparare e divertirsi INSIEME.
				</p>
			</div>
			<div class="section-7__right">
				<img src="../assets/img/people-table.svg" alt="Disegno di una persona alla scrivania al computer di schiena con una camicia bianca e circondata da piante"> 
			</div>  
		</div>
	</div>
	<?php include 'footer.php';?>
</body>
</html>
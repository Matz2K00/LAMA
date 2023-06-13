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
<?php include 'navbar.php';?>
<?php
	if(isset($err)){
		echo "<p> ".$err." </p>";
		unset($err);
	}

require 'sessionStart.php';
if(isset($_SESSION['id_utente'])){
	$email_utente_cookie = $_SESSION['id_utente'];
}

include 'db.php';

if ($connessione->connessioneect_error) {
	die("connessioneessione al database fallita.");
	header("Location: carrello.php");
	exit();
}


$stmtNome = $connessione->prepare("SELECT nome FROM Utenti WHERE email = ? ");
$stmtNome->bind_param("s", $email_utente_cookie);
$stmtNome->execute();
$resultNome = $stmtNome->get_result();

if ($resultNome->num_rows > 0) {
	while ($r = $resultNome->fetch_assoc()) {
		$nome = $r['nome']; 
		if($r['nome'] !== NULL){
			$nomeutente = $r['nome'];
		}
		//else{
    //   	if ($email_utente_cookie !== NULL){
    //     	$parts = explode("@", $email_utente_cookie);
    //    	$nomeutente = $parts[0];
    //		}
    //	}
	}
}
?>

<div class="carrello-page">
	<div class="title">
		<img class="cart" src="../assets/icon/navbar/Carrello-senzasfondo.png" alt="icona bianca del carrello stilizzato">
		<h1>  Il tuo carrello <?php echo $_SESSION['nome'];?><h1>
	</div>
	<div class="carrello-wrapper">
		<?php 
			include 'cookie.php';
			$corsi = $_COOKIE['corsi'];
			$array = unserialize($corsi);
			
			if (empty($array) || in_array(null, $array, true)) {
				echo "<p> Ancora nessun corso nel carrello </p>";
				echo "<a href='cerca.php'><p>Vedi altri corsi</p></a>";
				exit();
			}
			$stmt = $connessione->prepare("SELECT * FROM Corsi WHERE id = ? ");
			$array = unserialize($corsi);
			$values = array_values($array);
			
			for ($i = 0; $i < count($array); $i++) {
				$id_corso_cookie = $values[$i];
				
				if (!is_int($id_corso_cookie)) {
					echo "<p>Errore: il corso aggiunto al carrello non esiste! </p>";
					header("Location: carrello.php");
					exit();
				}
				
				$stmt->bind_param("i", $id_corso_cookie);
				$stmt->execute();
				$result = $stmt->get_result();
				
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						$titolo = $row["titolo"];
						$autore = $row["autore"];
						$prezzo = $row["prezzo"];
						$valutazioneMedia = NULL;
						$valutazioneMedia = $row["valutazioneMedia"];
						$altImg = $row["altImg"];
						$urlImg = "../assets/img/corsi/".$id_corso_cookie.".jpg";
						?>
						<div class="card">
							<button class="vaiAlCorso" data-id-corso="<?php echo $id_corso_cookie; ?>">
							<img class="img-corso" src='<?php echo $urlImg; ?>' alt='<?php echo $altImg; ?>' height="300">
							<div class="info card-height">
								<div class="texts"> 
									<h2><?php echo $titolo; ?></h2>
									<p><?php echo $autore; ?></p>
								</div>
								<div class="rating"> 
									<div class="stars"> 
										<?php 
										$gialla=0;
										$grigia=0;
										
										if ($valutazioneMedia !== NULL && $valutazioneMedia >= 0 && $valutazioneMedia < 6) {
											$gialla = $valutazioneMedia;
											$grigia = 5-$valutazioneMedia;
											// togliere height="30"
											for ($j = 0; $j < $gialla; $j++) { echo '<img src="../assets/icon/star/gialla.svg" alt="stella gialla" height="30">'; }
											for ($j = 0; $j < $grigia; $j++) { echo '<img src="../assets/icon/star/grigia.svg" alt="stella grigia" height="30">'; }
										}

										if ($valutazioneMedia === NULL) {
											for ($j = 0; $j < 5; $j++) { echo '<img src="../assets/icon/star/grigia.svg" alt="stella grigia" height="30">'; }
										}
										?>
									</div>
									<div class="last">
										<p class="price">Prezzo: <?php echo $prezzo; ?> €</p>
									</div>
								</div>
							</button>
							<div class="cestino">
								<img  class="rimuoviDalCarrello" data-id-corso="<?php echo $id_corso_cookie; ?>"src="../assets/icon/cestino.svg" alt="icona di un cestino stilizzato" height="30">
							</div>
						</div>

						<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
						<script src="../typescript/click.js"></script>
						
						<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
						<script src="../typescript/click.js"></script>
						<script>
							$(document).ready(function() {
								$(".rimuoviDalCarrello").click(function(e) {
									var id_corso = $(this).data("id-corso");
								$.ajax({
									url: "rimuoviDalCarrello.php", 
									type: "POST",
									data: { id_corso: id_corso }, 
									success: function(response) {
										console.log(response);
										location.reload();
									}
								});
							});
						});
						</script>
						<?php
						$totalePrezzo += $prezzo;
					}
				} else {
					echo "<p> Il corso aggiunto al carrello non esiste più! </p>";
				}
			}
			
			$stmt->close();
			$connessione->close();
		?>		
	</div>
		
	<div class="tot">
		<p>Totale prezzo:</p><p><?php echo $totalePrezzo; ?> €</p>
	</div>
	
	<?php
		if(!isset($_SESSION['id_utente'])){
			$nome = 'primaAccedi';
			$acquisti = true;
			setcookie($nome, $acquisti, time() + 60, '/'); 
			echo '<button class="primaAccedi">Vai al pagamento</button> ';
	?>
    
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			var button = document.querySelector('.primaAccedi');
			button.addEventListener('click', function() {
				window.location.href = 'accesso.php';
			});
		});
    </script>
	<?php
	} else {
		echo '<button class="vaiAlPagamento">Vai al pagamento</button> ';
    ?>
    
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../typescript/click.js"></script>
    <script>
		$(document).ready(function() {
			$(".vaiAlPagamento").click(function() {
				$.ajax({
					url: "vaiAlPagamento.php", 
					type: "POST",
					success: function(response) {
						$("#rispostaVaiAlPagamento").html(response);
					}
				});
			});
		});
    </script>

    <div id="rispostaVaiAlPagamento"></div>
    <?php
	}
	?>
	
	<div class="bottomBtns">
		<a href="cerca.php"><p>Vedi altri corsi</p></a>
		<button class="svuotaIlCarrello">Svuota il carrello</button> 
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<script src="../typescript/click.js"></script>
		<script>
		$(document).ready(function() {
			$(".svuotaIlCarrello").click(function() {
				$.ajax({
					url: "svuotaIlCarrello.php", 
					type: "POST",
					success: function(response) {
						console.log(response);
						location.reload();
					}
				});
			});
		});
		</script>
	</div>
</div>

<?php include 'footer.php';?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../typescript/click.js"></script>
</body>
</html>
<?php
require 'sessionStart.php';
if(!isset($_SESSION['id_utente'])){
	header("Location: accesso.php");
    exit();
}

echo "<p> gli acquisti sono andati a buon fine: </p>";
include 'db.php';
include 'cookie.php';

$stmt = $connessione->prepare("SELECT * FROM Corsi WHERE id = ?");
$corsi = $_COOKIE['corsi'];
$array = unserialize($corsi);
$values = array_values($array);

for ($i = 0; $i < count($array); $i++) {
	$id_corso = $values[$i];
	$stmt->bind_param("i", $id_corso);
	$stmt->execute();
	$result = $stmt->get_result();
	
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$titolo = $row["titolo"];
			$altImg = $row["altImg"];
			$urlImg = "../assets/img/corsi/".$id_corso.".jpg";?>
			
			<button class="vaiAlCorso" data-id-corso="<?php echo $id_corso; ?>">
				<img src='<?php echo $urlImg; ?>' alt='<?php echo $altImg; ?>' height="300">
				<h2><?php echo $titolo; ?></h2>
			</button>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
			<script src="../typescript/click.js"></script>
			<?php
			}
		}
}
$stmt->close();
$connessione->close();

$corsi = $_COOKIE['corsi'];
$valoreCookie = serialize($corsi);
$scadenza = time() + (3*60); // 3 minuti
setcookie($nomeCookie, $valoreCookie, $scadenza, "/");

?>
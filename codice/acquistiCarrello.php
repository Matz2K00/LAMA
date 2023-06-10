<?php
echo "<p> gli acquisti sono andati a buon fine: </p>";
require 'db.php';
$conn = new mysqli($hostData, $userData, $paswData, $database);
$sql = "SELECT * FROM Corsi WHERE id = ?";
$stmt = $conn->prepare($sql);

include 'cookie.php';
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
      $urlImg = "../assets/img/corsi/".$id_corso.".jpg";
      ?>
      <button class="vaiAlCorso" data-id-corso="<?php echo $id_corso; ?>">
        <img src='<?php echo $urlImg; ?>' alt='<?php echo $altImg; ?>' height="300">
        <h2><?php echo $titolo; ?></h2>
      </button>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="../typescript/click.js"></script>
      <?php
    }
  }
  $stmt->close();
}
$conn->close();

// cambio data di scadenza
$corsi = $_COOKIE['corsi'];
$valoreCookie = serialize($corsi);
$scadenza = time() + (3*60); // 3 minuti
setcookie($nomeCookie, $valoreCookie, $scadenza, "/");

// elimina
// $nome = 'acquistiCarrello';
// $acquisti = false;
// setcookie($nome, $acquisti, time() - 3600, '/'); // un minuto
?>
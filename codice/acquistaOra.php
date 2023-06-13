<?php
require 'sessionStart.php';
if(!isset($_SESSION['id_utente'])){
    header("Location: accesso.php");
    exit();
}
if(!isset($_SESSION['id_corso'])){
    header("Location: cerca.php");
    exit();
}
$id_utente = $_SESSION['id_utente'];
$id_corso = $_SESSION['id_corso'];
require 'db.php';
$conn = new mysqli($hostData, $userData, $paswData, $database);
$sql = "INSERT IGNORE INTO Acquisti (id_utente, id_corso) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

// aggiungi corsi comprati nel database -- commentato per test
$stmt->bind_param("si", $id_utente, $id_corso);
$stmt->execute();
$stmt->close();

echo "<h2>L' acquisto è andato a buon fine, hai comprato: </h2>";
require 'db.php';
$conn = new mysqli($hostData, $userData, $paswData, $database);
$sql = "SELECT * FROM Corsi WHERE id = ?";
$stmt = $conn->prepare($sql);
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
    <img class="img-corso" src='<?php echo $urlImg; ?>' alt='<?php echo $altImg; ?>' height="300">
    <div class="info">
      <div class="texts"> 
        <h2><?php echo $titolo; ?></h2>
      </div>
    </div>
    </button>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../typescript/click.js"></script>
    <?php
}
}
$stmt->close();
$conn->close();
?>
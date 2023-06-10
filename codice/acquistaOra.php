<?php
require 'sessionStart.php';
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

echo "<h1>L' acquisto è andato a buon fine, hai comprato: </h1>";
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
    <img src='<?php echo $urlImg; ?>' alt='<?php echo $altImg; ?>' height="300">
    <h2><?php echo $titolo; ?></h2>
    </button>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../typescript/click.js"></script>
    <?php
}
}
$stmt->close();
$conn->close();
?>
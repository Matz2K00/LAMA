<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">

  <!-- <link rel="stylesheet" type="text/css" href="../css/root.css"> -->
  <!-- <link rel="stylesheet" type="text/css" href="../css/navbar.css"> -->
  <!-- <link rel="stylesheet" type="text/css" href="../css/footer.css"> -->
  <!-- deve essere un solo css sia per comprato che NOcomprato -->
  <!-- <link rel="stylesheet" type="text/css" href=".../css/video.css"> -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

  <title>LAMA</title>
  <meta name="keywords " content="LAMA">
  <meta name="author " content="Belloni Laura, Contegno Matteo">
</head>
<body>
<?php //include 'navbar.php';?>

<?php 
require 'sessionStart.php';
if(!isset($_SESSION['id_corso'])){
  echo "<p> Non ci sono video selezionati</p>";
  exit();
}
$id_corso = $_SESSION['id_corso'];
$id_utente = $_SESSION['id_utente'];
// echo "rteug ":$id_corso;
require 'db.php';
$conn = new mysqli($hostData, $userData, $paswData, $database);
$sql = "SELECT * FROM Acquisti 
        WHERE id_utente = ?
        AND id_corso = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $id_utente, $id_corso);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows <= 0){
  echo "<p>Non hai comprato questo corso </p>";
  include 'video-NOcomprato.php';
}
else {
  echo "<p>Hai comprato questo corso </p>";
  include 'video-comprato.php';
}
$stmt->close();
$conn->close();
?>

<?php //include 'footer.php';?>
</body>
</html>
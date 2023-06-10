<?php
if(!isset($_SESSION['id_utente'])){
    echo "sessione non impostata";
    exit();
}
$id_utente = $_SESSION['id_utente'];

require "db.php";
$conn = new mysqli($hostData, $userData, $paswData, $database);
$sql = "SELECT * FROM Utenti WHERE email = ? ";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s",$id_utente);
$stmt->execute();
$result = $stmt->get_result();
if ($result) {
    $row = $result->fetch_assoc();
}
$imgAvatar = $row['imgAvatar'];
$stmt->close();
$conn->close();
?>

<nav>
    <a href="home.php"><img class="logo" src="../assets/icon/navbar/logo.png" alt="logo: disegno di un lama affiancato dal titolo LAMa"></a>
    <a href="cerca.php"><button class="nav-button">Tutti i corsi</button></a>
    <a href="cerca.php"><button class="nav-icon"><img  class="cerca" src="../assets/icon/navbar/Cerca-senzasfondo.png" alt="icona bianca di una lente di ingrandimento stilizzato"></button></a>
    <a href="carrello.php"><button class="nav-icon"><img  class="carrello" src="../assets/icon/navbar/Carrello-senzasfondo.png" alt="icona bianca del carrello stilizzato"></button></a>
    <a href="imieicorsi.php"><button class="nav-button">I miei corsi</button></a>
    <a href="esci.php"><button class="nav-button">Esci</button></a>
    
    <a href="show_profile.php"><img  class="profilo" src="../assets/icon/navbar/<?php echo $imgAvatar?>.png" alt="icona grafica stilizzata di una persona con i capelli castano il cappello nero e gli occhiali" height="300"></a>
</nav>
<?php
    require 'sessionStart.php';
    if(!isset($_SESSION['id_utente'])){
        header("Location: accesso.php");
        exit();
    }

    $id_utente = $_SESSION['id_utente'];
    include 'db.php';
    $stmt = $connessione->prepare("INSERT IGNORE INTO Acquisti (id_utente, id_corso) VALUES (?, ?)");

    include 'cookie.php';
    $corsi = $_COOKIE['corsi'];
    $array = unserialize($corsi);
    $values = array_values($array);

    for ($i=0; $i<count($array); $i++) {
        $id_corso = $values[$i];

        $stmt->bind_param("si", $id_utente, $id_corso);
        $stmt->execute();
    }
    $stmt->close();

    echo "<h1>Gli acquisti sono andati a buon fine, hai comprato: </h1>";

    $stmt = $connessione->prepare("SELECT * FROM Corsi WHERE id = ?");

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
    }
    $stmt->close();
    $connessione->close();

    $nomeCookie = 'corsi';
    $scadenza = time() - 3600;
    setcookie($nomeCookie, null, $scadenza, "/");

?>
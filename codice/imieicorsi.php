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
<div class="carrello-page">
	<div class="title">
		<h1>I miei corsi</h1>
	</div>
	<div class="carrello-wrapper">
    <?php 
    require 'sessionStart.php';
    if(!isset($_SESSION['id_utente'])){
        header("Location: accesso.php");
        exit();
    }
    unset($_SESSION['id_corso']);
    $email = $_SESSION['id_utente'];

    include 'db.php';
    $stmt = $connessione->prepare("SELECT * FROM Corsi WHERE id IN (SELECT id_corso FROM Acquisti WHERE id_utente = ?)");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $titolo = $row["titolo"];
        $autore = $row["autore"];
        $descrizione = $row["descrizione"];
        $prezzo = $row["prezzo"];
        // $link = $row["link"];
        $altImg = $row["altImg"];
        $urlImg = "../assets/img/corsi/".$id.".jpg";
        // abbrevio la descrizione
        $parole = explode(' ', $descrizione);
        $primeDieciParole = array_slice($parole, 0, 10);
        $descrizioneBreve = implode(' ', $primeDieciParole);?>
        <div class="card">
          <button class="vaiAlCorso" data-id-corso="<?php echo $id; ?>">
            <img src='<?php echo $urlImg; ?>' alt='<?php echo $altImg; ?>' height="300">
            <div class="info card-height">
              <div class="texts">
                <h2><?php echo $titolo; ?></h2>
                <p><?php echo $autore; ?></p>
                <p><?php echo $descrizioneBreve." ..."; ?></p>
              </div>
            </div>
          </button>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="../typescript/click.js"></script>
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
          $(document).ready(function() {
            $(".vaiAlCorso").click(function() {
              var id_corso = $(this).data("id-corso");
              $.ajax({
                url: "vaiAlCorso.php", 
                type: "POST",
                data: { id_corso: id_corso }, 
                success: function(response) {
                  console.log(response);
                  window.location.href = "video.php";
                }
              });
            });
          });
        </script> -->
        <?php 
          $stmt->close();
        }
      } else{
        echo "Non hai comprato nessun corso $email";
      }
      $connessione->close();
      ?>
  </div>
  <div>
    <a href="cerca.php"><button>Vedi altri corsi</button></a>
  </div>
</div>
<?php include 'footer.php';?>
</body>
</html>
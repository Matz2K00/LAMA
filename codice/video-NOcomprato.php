<?php
$sql = "SELECT * FROM Corsi
        WHERE id = ? ";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_corso);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $id = $row["id"];
    $titolo = $row["titolo"];
    $autore = $row["autore"];
    $descrizione = $row["descrizione"];
    $prezzo = $row["prezzo"];
    $valutazioneMedia = $row["valutazioneMedia"];
    // $link = $row["link"];
    // immagine
    $altImg = $row["altImg"];
    $urlImg = "../assets/img/corsi/".$id.".jpg";
  
  }
} else {
  echo "Non esiste il corso selezionato";
}
// $stmt->close();
// $conn->close();
?>  
    <div>
      <img src='<?php echo $urlImg; ?>' alt='<?php echo $altImg; ?>' height="300">
      <h2><?php echo $titolo; ?></h2>
      <p><?php echo $autore; ?></p>
      <p><?php echo $descrizione; ?></p>
    </div>
    
<div class="valutazione">
<p>E' stato valutato</p>
<p> 
    <?php //stelline
    if ($valutazioneMedia !== NULL && $valutazioneMedia >= 0 && $valutazioneMedia < 6) {
      $gialla = $valutazioneMedia;
      $grigia = 5-$valutazioneMedia;
      // togliere height="30"
      for ($i = 0; $i < $gialla; $i++) { echo '<img src="../assets/icon/star/gialla.svg" alt="stella gialla" height="30">'; }
      for ($i = 0; $i < $grigia; $i++) { echo '<img src="../assets/icon/star/grigia.svg" alt="stella grigia" height="30">'; }
    }
    if ($valutazioneMedia === NULL) {
      for ($i = 0; $i < 5; $i++) { echo '<img src="../assets/icon/star/grigia.svg" alt="stella grigia" height="30">'; }
    }
    ?>
</p>
</div>

<div class="prezzo">
<p><?php echo $prezzo." €"; ?></p>
<p>Disponibilità immediata</p>
<p>Il corso sarà disponibile<br>in <b>I miei corsi</b><br>Non ha una scadenza</p>
<p>Potrai guardarlo più volte<br>nell'ordine che preferisci</p>

<button id="aggiungiAlCarrello" onclick="showCheck()">Aggiungi al carrello</button>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $("#aggiungiAlCarrello").click(function() {
      var id_corso = parseInt(<?php echo intval($id_corso);?>);
        $.ajax({
            url: "aggiungiAlCarrello.php", 
            type: "POST",
            data: { id_corso: id_corso }, 
            success: function(response) {
              setTimeout(function() {
                location.reload();
              }, 500); // Ritardo di 500 millisecondi (mezzo secondo)
            }
        });
    });
});
function showCheck() {
  var button = document.getElementById("aggiungiAlCarrello");
  button.innerHTML = '<i class="fas fa-check"></i>';
}
</script>

<button>Acquista ora</button>
</div>
  
  <a href="cerca.php">Altri corsi</a>
</div>


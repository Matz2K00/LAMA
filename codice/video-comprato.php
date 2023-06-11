<!-- TOGLI width="320" height="240" -->
<!-- <video width="320" height="240" controls> 
    <source src="../video.mp4" type="video/mp4">
    <p>Il tuo browser non supporta il tag video</p>
    <track src="sottotitoli.vtt" kind="subtitles" srclang="it" label="Italino" default>
</video> -->
<?php
if(!isset($_SESSION['id_utente'])){
  echo "<p> accedi prima al tuo account </p>";
  exit();
}

$sql = "SELECT * FROM Acquisti 
        JOIN Corsi ON Acquisti.id_corso = Corsi.id 
        WHERE Acquisti.id_utente = ?
        AND Acquisti.id_corso = ? ";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $id_utente, $id_corso);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $id = $row["id"];
    $titolo = $row["titolo"];
    $autore = $row["autore"];
    $descrizione = $row["descrizione"];
    $valutazione = $row["valutazione"];
    // $link = $row["link"];
    // immagine
    $altImg = $row["altImg"];
    $urlImg = "../assets/img/corsi/".$id.".jpg";
  }
} else {
  echo "Erroe: non esistono corsi con questo id : $id_corso";
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

<div><!--class="stars">-->
<?php //stelline
if ($valutazione !== NULL && $valutazione >= 0 && $valutazione < 6) {
  $gialla = $valutazione;
  $grigia = 5-$valutazione;
  // togliere height="30"
  echo "<p>La tua valutazione</p>";
  for ($i = 0; $i < $gialla; $i++) { echo '<img src="../assets/icon/star/gialla.svg" alt="stella gialla" height="30">'; }
  for ($i = 0; $i < $grigia; $i++) { echo '<img src="../assets/icon/star/grigia.svg" alt="stella grigia" height="30">'; }
}
if ($valutazione === NULL) {
  echo "<p>Valuta il corso</p>";
  for ($i = 0; $i < 5; $i++) { echo '<img src="../assets/icon/star/grigia.svg" alt="stella grigia" height="30" class="star" data-value="'.$i.'">'; }
}
?>

<script>
const stars = document.querySelectorAll('.star');
stars.forEach(star => {
  star.addEventListener('mouseover', () => {
    const value = parseInt(star.dataset.value);
    for (let i = 0; i <= value; i++) {
      stars[i].src = '../assets/icon/star/gialla.svg';
    }
  });
  star.addEventListener('mouseout', () => {
    const value = parseInt(star.dataset.value);
    for (let i = 0; i <= value; i++) {
      if (i >= 0) {
        stars[i].src = '../assets/icon/star/grigia.svg';
      }
    }
  });
});
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
  $('.star').click(function() {
    var valutazioneNuova = $(this).data("value");      
    $.ajax({
      url: "valutazione.php",
      type: "POST",
      data: { valutazioneNuova: valutazioneNuova },
      success: function(response) {
        // $("#rispostaValutazione").html(response);
        // setTimeout(function() {
          location.reload();
        // }, 30000);
      }
    });
  });
});
</script>
<!-- <div id="rispostaValutazione"></div> -->

<button class="annullaValutazione">Annulla valutazione</button>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
  $('.annullaValutazione').click(function() {
    $.ajax({
      url: "annullaValutazione.php",
      type: "POST",
      success: function(response) {
        // $("#rispostaAnnullaValutazione").html(response);
        console.log(response);
        location.reload();
      }
    });
  });
});
</script>
<!-- <div id="rispostaAnnullaValutazione"></div> -->
</div>


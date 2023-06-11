<?php
$stmt->execute();
$result = $stmt->get_result();

$stmtCount->execute();
$resultCount = $stmtCount->get_result();

$rowCount = $resultCount->fetch_assoc();
$totalCorsi = $rowCount['total'];

$totalPagine = ceil($totalCorsi / $corsiPerPagina);
$paginaCorrente = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$inizio = ($paginaCorrente - 1) * $corsiPerPagina;

$sqlWithLimit = $sql . " LIMIT ?, ?";
if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
  $stmtWithLimit = $conn->prepare($sqlWithLimit);
  $stmtWithLimit->bind_param("ssssii", $keyword, $keyword, $keyword, $keyword, $inizio, $corsiPerPagina);
}
else {
  $stmtWithLimit = $conn->prepare($sqlWithLimit);
  $stmtWithLimit->bind_param("ii", $inizio, $corsiPerPagina);
}
$stmtWithLimit->execute();
$resultWithLimit = $stmtWithLimit->get_result();

if ($resultWithLimit->num_rows > 0) {
  while ($row = $resultWithLimit->fetch_assoc()) {
    $id = $row["id"];
    $titolo = $row["titolo"];
    $autore = $row["autore"];
    $descrizione = $row["descrizione"];
    $prezzo = $row["prezzo"];
    $valutazioneMedia = $row["valutazioneMedia"];
    $nUtentiValut = $row["nUtentiValut"];
    // immagine
    $altImg = $row["altImg"];
    $urlImg = "../assets/img/corsi/".$id.".jpg";
    // abbrevio la descrizione
    $parole = explode(' ', $descrizione);
    $primeDieciParole = array_slice($parole, 0, 10);
    $descrizioneBreve = implode(' ', $primeDieciParole);
    ?>
    <button class="vaiAlCorso" data-id-corso="<?php echo $id; ?>">
      <img class="img-corso" src='<?php echo $urlImg; ?>' alt='<?php echo $altImg; ?>'>
      <div class="info">
        <div class="texts"> 
          <h2><?php echo $titolo; ?></h2>
          <p><?php echo $autore; ?></p>
          <p><?php echo $descrizioneBreve." ..."; ?></p>
        </div>
        <div class="rating"> 
          <div class="stars"> 
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
          </div>
        <p><?php echo "Valutata da " . $nUtentiValut . " utenti";?></p>
        </div>
      </div>
    </button>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../typescript/click.js"></script>
    

    <?php 
    }
  } else {
    echo $end;
  }
?>

<!DOCTYPE html>
<html lang="it">
<head>
   <meta charset="UTF-8">
   <link rel="stylesheet" type="text/css" href="../css/root.css">
   <link rel="stylesheet" type="text/css" href="../css/navbar.css">
   <link rel="stylesheet" type="text/css" href="../css/footer.css">
   <link rel="stylesheet" type="text/css" href="../css/home.css">
   <title>LAMA</title>
   <meta name="keywords " content="LAMA">
   <meta name="author " content="Belloni Laura, Contegno Matteo">
</head>
<body>

<?php require 'sessionStart.php';?>
   <div class="nav">
      <?php include 'navbar.php';?>
   </div>

<div class="pag1"> sfondo immagine ondina
   <p><?php echo isset($_SESSION["nomeutente"]) ? "Benvenutx ".$_SESSION["nomeutente"] : "Impara con<br>LAMA"; ?></p>
   <p>I tuoi corsi ovunque!</p>
   <p>Trova quello<br>fatto apposta per te</p>
</div>

<div class="pag2">
<p>I <b>nostri</b> corsi</p>
   <?php
   require 'db.php';
   $corsiPerPagina = 3;
   $sql="SELECT * FROM Corsi ";
   $sqlCount="SELECT COUNT(*) AS total FROM Corsi ";
   $start = "";
   $end = "";
   require "corsiPerPagina.php";
   $conn->close();
   ?>
   <a href="cerca.php"><button>Vai a tutti i corsi</button></a>
</div>

<div class="pag3">  sfondo immagine grafico
   <p>LAMA ti fa scoprire il<br>mondo</p>
</div>

<div class="pag4">
   <p>Il tuo spazio<br>per imparare</p>
   <p>Che sia la tua scrivania, il caffè<br>sotto casa o il treno</p>
   <p>trova il tuo spazio per IMPARARE!</p>
   <img src="src/assets/img/" alt="Disegno di una persona alla scrivania al computer che mangia mentre una persona in pigiama si dirige alla propria scrivania"> 
</div>

<div class="pag5">
   <p>Ritrova le tue<br>passioni</p>
   <p>Prenditi il tempo per te e per i tuoi<br>interessi,</p>
   <p>ora è FACILE.</p>
   <img src="src/assets/img/" alt="Disegno di una persona alla scrivania al computer di schiena con una camicia bianca e circondata da piante"> 
</div> 

<div class="pag6">  sfondo immagine bambina
   <p>Per tutte<br>le età</p>
   <p>Non esiste età GIUSTA<br>Per imparare!</p>
   <img src="src/assets/img/" alt="Disegno di 5 persone di età diverse che si abbracciano, impoteticamente una famiglia con nonni e bambini"> 
</div>

<div class="pag7">
   <p>impara<br>edivertiti</p>
   <p>Condividi le lezioni con le<br>persone che ami</p>
   <p>Una nuova opportunità per<br>imparare e divertirsi INSIEME.</p>
   <img src="src/assets/img/" alt="Disegno di una persona alla scrivania al computer di schiena con una camicia bianca e circondata da piante"> 
</div> 

<?php //include 'footer.php';?>
</body>
</html>
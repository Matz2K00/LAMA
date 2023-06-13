<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../css/root.css">
<link rel="stylesheet" type="text/css" href="../css/navbar.css">
<link rel="stylesheet" type="text/css" href="../css/cerca.css">
<link rel="stylesheet" type="text/css" href="../css/footer.css">
<link rel="stylesheet" type="text/css" href="../css/corso.css">
<title>LAMA</title>
<meta name="keywords " content="LAMA">
<meta name="author " content="Belloni Laura, Contegno Matteo">
</head>
<body>
<?php include 'navbar.php';?>
<?php require 'sessionStart.php';?>

<div class="search">
    <div class="searchbar">
        <form id="searchForm" action="cerca.php" method="GET">
            <button type="submit">
                <img class="cerca" src="../assets/icon/navbar/Cerca-senzasfondo.png" alt="icona bianca di una lente di ingrandimento stilizzato" height="30">
            </button>
            <input type="text" name="keyword" placeholder="Cerca" <?php if(!empty($_GET['keyword'])) {echo 'value="' . $_GET['keyword'] . '" style="color: #3b6f96;"';} ?> >
        </form>
    </div>
    <script>
    function handleKeyPress(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("searchForm").submit();
            }
        }
    var keyword = "keyword";
    var inputField = document.querySelector("input[name='" + keyword + "']");
    inputField.addEventListener('keypress', handleKeyPress);
    </script>
    <div class="corsi-wrapper">
        <?php
        include 'db.php';
        
        if ($connessione->connect_error) {
            die("connessioneessione al database fallita");
            header("Location: signUp.php");
            exit();
        }
        
        $val = false;
        $corsiPerPagina = 9;
        
        if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
            $keywordEscape = htmlspecialchars($_GET['keyword']);
            if (preg_match('/^valutazione:[1-5]$/', $keywordEscape)) {
                $parti = explode(':', $keywordEscape);
                if (count($parti) === 2) {
                    $info = $parti[1]; 
                    if (is_numeric($info) && intval($info) >= 1 && intval($info) <= 5) {
                        $numeroVal = intval($info);
                        include "aggiornaValMedia.php";
                        $sql = "SELECT * FROM Corsi WHERE valutazioneMedia = ? ";
                        $stmt = $connessione->prepare($sql);
                        $stmt->bind_param("i", $numeroVal);
                        $sqlCount = "SELECT COUNT(*) AS total FROM Corsi WHERE valutazioneMedia = ? ";
                        $stmtCount = $connessione->prepare($sqlCount);
                        $stmtCount->bind_param("i", $numeroVal);
                        $start = "<p class='result'>Risultati per valutazione media di <b>" . $numeroVal . "</b></p>";
                        $end = "<p class='result'>Non ci sono corsi con valutazione media di <b>" . $numeroVal . "</b></p>";
                        $val = true;
                    } 
                }
            } else {
                $keyword = "%$keywordEscape%";
                $sql = "SELECT * FROM Corsi WHERE titolo LIKE ? OR autore LIKE ? OR descrizione LIKE ? OR altImg LIKE ? ";
                $stmt = $connessione->prepare($sql);
                $stmt->bind_param("ssss", $keyword, $keyword, $keyword, $keyword);
                $sqlCount = "SELECT COUNT(*) AS total FROM Corsi WHERE titolo LIKE ? OR autore LIKE ? OR descrizione LIKE ? OR altImg LIKE ? ";
                $stmtCount = $connessione->prepare($sqlCount);
                $stmtCount->bind_param("ssss", $keyword, $keyword, $keyword, $keyword);

                $start = "<p class='result'>Risultati per: <b>" . $keywordEscape . "</b></p>";
                $end = "<p class='result'>Non ci sono corsi disponibili per: <b>" . $keywordEscape . "</b></p>";
            }
        } else {
            $sql = "SELECT * FROM Corsi";
            $stmt = $connessione->prepare($sql);
            $sqlCount = "SELECT COUNT(*) AS total FROM Corsi";
            $stmtCount = $connessione->prepare($sqlCount);
            
            $start = "<p class='result'>Tutti i <b>nostri</b> corsi</p>";
            $end = "<p class='result'>Corsi esauriti</p>";
        }
        
        include "corsiPerPagina.php";
        unset($keyword);

        $stmt->close();
        $stmtCount->close();
        $stmtWithLimit->close();
        $connessione->close();
        ?>
    </div>
    <div class="pages">
        <?php include "indicePagina.php";?>
    </div>
</div>

<?php include 'footer.php';?>
</body>
</html>
<?php
	if($totalPagine <= 1 || $paginaCorrente <= 1){
		$paginaPrecedente = 1;
	} else {
		$paginaPrecedente = $paginaCorrente-1;
	}
	
	if($paginaCorrente >= $totalPagine){
		$paginaSucessiva = $totalPagine;
	} else {
		$paginaSucessiva = $paginaCorrente+1;
	}
	// spostarsi indietro
	echo "<a href='cerca.php?keyword=$keywordEscape&pagina=$paginaPrecedente'><<</a>";
	// pagina attuale
	echo '<button>Pagina ' . $paginaCorrente . ' di ' . $totalPagine.'</button>';
	// spostarsi avanti
	echo "<a href='cerca.php?keyword=$keywordEscape&pagina=$paginaSucessiva'>>></a>";
?>
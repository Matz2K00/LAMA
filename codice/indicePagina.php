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

	if(!empty($keywordEscape)){
		// spostarsi indietro
		echo "<a href='cerca.php?keyword=$keywordEscape&pagina=$paginaPrecedente'><<</a>";
		// pagina attuale
		echo '<button>Pagina ' . $paginaCorrente . ' di ' . $totalPagine.'</button>';
		// spostarsi avanti
		echo "<a href='cerca.php?keyword=$keywordEscape&pagina=$paginaSucessiva'>>></a>";
	} else {
		// spostarsi indietro
		echo "<a href='cerca.php?pagina=$paginaPrecedente'><<</a>";
		// pagina attuale
		echo '<button>Pagina ' . $paginaCorrente . ' di ' . $totalPagine.'</button>';
		// spostarsi avanti
		echo "<a href='cerca.php?pagina=$paginaSucessiva'>>></a>";
	}
?>
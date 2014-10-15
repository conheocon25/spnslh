<?php	
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ResultDetailPrint.html");
	echo $Viewer->pdfA4();	
?>

<?php	
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/SellingPrintTemplate.html");
	echo $Viewer->pdfA4();
	//html pdfA4
?>

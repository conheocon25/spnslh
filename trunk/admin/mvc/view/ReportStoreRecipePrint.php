<?php	
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ReportStoreRecipePrint.html");	
	$Out = $Viewer->pdfBD();
	unset($Viewer);
	echo $Out;
?>

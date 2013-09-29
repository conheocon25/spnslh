<?php	
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ReportStore.html");
	echo $Viewer->pdfBD();
?>

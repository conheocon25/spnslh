<?php	
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ReportImportDetail.html");
	echo $Viewer->pdfBD();
?>

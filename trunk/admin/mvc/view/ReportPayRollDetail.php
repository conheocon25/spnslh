<?php	
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ReportPayRollDetail.html");
	echo $Viewer->pdfBD();
?>

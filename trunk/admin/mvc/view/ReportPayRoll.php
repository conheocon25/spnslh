<?php	
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ReportPayRoll.html");
	echo $Viewer->pdfBD();
?>

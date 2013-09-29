<?php	
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ReportPaidPayRoll.html");
	echo $Viewer->pdfBD();
?>

<?php	
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ReportPaidDetail.html");
	echo $Viewer->pdfBD();
?>

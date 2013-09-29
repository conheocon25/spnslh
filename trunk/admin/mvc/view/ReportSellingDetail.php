<?php	
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ReportSellingDetail.html");
	echo $Viewer->pdfBD();
?>

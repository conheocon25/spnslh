<?php	
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/AReportDailySellingPrint.html");
	echo $Viewer->pdfA4("L");
?>

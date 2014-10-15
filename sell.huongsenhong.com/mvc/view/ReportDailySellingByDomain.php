<?php	
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ReportDailySellingByDomain.html");
	echo $Viewer->html();
?>
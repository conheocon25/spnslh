<?php	
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/AReportDailyPaid.html");
	echo $Viewer->html();
?>
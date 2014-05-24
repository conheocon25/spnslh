<?php	
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/AReportDailyCollect.html");
	echo $Viewer->html();
?>
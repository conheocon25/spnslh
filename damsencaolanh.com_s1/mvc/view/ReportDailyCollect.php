<?php	
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ReportDailyCollect.html");
	echo $Viewer->html();
?>
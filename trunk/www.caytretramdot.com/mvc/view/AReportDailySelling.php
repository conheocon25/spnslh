<?php	
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/AReportDailySelling.html");
	echo $Viewer->html();
?>

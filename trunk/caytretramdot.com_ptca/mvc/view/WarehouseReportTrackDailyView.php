<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/WarehouseReportTrackDailyView.html");
	echo $Viewer->html();
?>

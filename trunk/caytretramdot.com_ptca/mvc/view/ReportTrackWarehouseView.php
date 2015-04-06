<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/ReportTrackWarehouseView.html");
	echo $Viewer->html();
?>
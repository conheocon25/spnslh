<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/ReportTrackWarehouse.html");
	echo $Viewer->html();
?>
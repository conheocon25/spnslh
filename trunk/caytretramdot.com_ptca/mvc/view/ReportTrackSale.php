<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/ReportTrackSale.html");
	echo $Viewer->html();
?>
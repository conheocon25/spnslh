<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/ReportTrack.html");
	echo $Viewer->html();
?>
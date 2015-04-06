<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/ReportTrackSaleBranch.html");
	echo $Viewer->html();
?>
<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/BranchReportTrackDaily.html");
	echo $Viewer->html();
?>

<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/BranchReportTrackDailyQuota.html");
	echo $Viewer->html();
?>

<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/BranchReportTrackDailyCustomerView.html");
	echo $Viewer->html();
?>

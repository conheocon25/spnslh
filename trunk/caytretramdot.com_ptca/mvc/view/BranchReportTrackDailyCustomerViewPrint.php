<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/BranchReportTrackDailyCustomerViewPrint.html");
	echo $Viewer->html();
?>

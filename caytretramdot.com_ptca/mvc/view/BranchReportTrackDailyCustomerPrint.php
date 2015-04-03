<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/BranchReportTrackDailyCustomerPrint.html");
	echo $Viewer->html();
?>

<?php	
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ReportDailySellingCash.html");
	echo $Viewer->html();
?>

<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ReportDailyCustomer.html");
	echo $Viewer->html();
?>

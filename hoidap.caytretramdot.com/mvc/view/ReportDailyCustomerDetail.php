<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ReportDailyCustomerDetail.html");
	echo $Viewer->html();
?>

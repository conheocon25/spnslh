<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ReportDailySupplierDetail.html");
	echo $Viewer->html();
?>
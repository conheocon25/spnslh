<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ReportDailySupplier.html");
	echo $Viewer->html();
?>

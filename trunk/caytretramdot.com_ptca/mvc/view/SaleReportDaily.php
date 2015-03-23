<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/SaleReportDaily.html");
	echo $Viewer->html();
?>

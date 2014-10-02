<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/AReportDetail.html");
	echo $Viewer->html();
?>

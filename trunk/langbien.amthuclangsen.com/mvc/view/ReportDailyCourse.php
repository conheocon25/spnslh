<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ReportDailyCourse.html");
	echo $Viewer->html();
?>
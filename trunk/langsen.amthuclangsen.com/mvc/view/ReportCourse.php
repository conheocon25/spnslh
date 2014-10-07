<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ReportCourse.html");
	echo $Viewer->html();
?>
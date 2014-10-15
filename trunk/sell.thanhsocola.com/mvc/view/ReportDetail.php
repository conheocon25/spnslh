<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ReportDetail.html");
	echo $Viewer->html();
?>

<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ReportDetailStore.html");
	echo $Viewer->html();
?>
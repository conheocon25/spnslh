<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ReportInfo.html");
	echo $Viewer->html();
?>

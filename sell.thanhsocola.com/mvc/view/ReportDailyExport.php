<?php	
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ReportDailyExport.html");
	echo $Viewer->html();
?>

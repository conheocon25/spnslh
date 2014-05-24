<?php	
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/AReportDailyImport.html");
	echo $Viewer->html();
?>

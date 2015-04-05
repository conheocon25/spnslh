<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/Report.html");
	echo $Viewer->html();
?>

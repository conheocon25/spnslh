<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/ProjectDetail.html");	
	echo $Viewer->html();
?>

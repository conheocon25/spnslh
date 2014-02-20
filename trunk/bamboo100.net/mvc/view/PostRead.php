<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/PostRead.html");	
	echo $Viewer->html();
?>

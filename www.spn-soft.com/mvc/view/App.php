<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/App.html");	
	echo $Viewer->html();
?>

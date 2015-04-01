<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/Warehouse.html");
	echo $Viewer->html();
?>
<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/Admin.html");	
	echo $Viewer->html();
?>

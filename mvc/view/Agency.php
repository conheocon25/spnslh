<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/Agency.html");
	echo $Viewer->html();
?>

<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/Recommend.html");
	echo $Viewer->html();
?>

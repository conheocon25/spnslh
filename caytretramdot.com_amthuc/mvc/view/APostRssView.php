<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/APostRssView.html");
	echo $Viewer->html();
?>

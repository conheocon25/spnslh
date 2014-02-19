<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/ReadNews.html");	
	echo $Viewer->html();
?>

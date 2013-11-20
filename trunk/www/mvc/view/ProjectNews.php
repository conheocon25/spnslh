<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/ProjectNews.html");	
	echo $Viewer->html();
?>

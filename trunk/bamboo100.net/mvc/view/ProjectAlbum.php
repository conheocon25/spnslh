<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/ProjectAlbum.html");	
	echo $Viewer->html();
?>

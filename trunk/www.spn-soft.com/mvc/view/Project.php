<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/Project.html");
	echo $Viewer->html();
?>

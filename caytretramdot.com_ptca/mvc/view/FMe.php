<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/FMe.html");
	echo $Viewer->html();
?>

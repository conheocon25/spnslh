<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/Gate.html");
	echo $Viewer->html();
?>

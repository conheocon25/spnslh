<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/FTag.html");
	echo $Viewer->html();
?>

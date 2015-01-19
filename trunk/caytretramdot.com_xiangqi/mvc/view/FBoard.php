<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/FBoard.html");
	echo $Viewer->html();
?>

<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/FBoardViewer.html");
	echo $Viewer->html();
?>

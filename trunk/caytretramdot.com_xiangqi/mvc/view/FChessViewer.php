<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/FChessViewer.html");
	echo $Viewer->html();
?>

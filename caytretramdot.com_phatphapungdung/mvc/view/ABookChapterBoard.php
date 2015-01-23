<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ABookChapterBoard.html");
	echo $Viewer->html();
?>

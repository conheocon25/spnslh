<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ABookChapter.html");
	echo $Viewer->html();
?>

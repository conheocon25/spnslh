<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/FChapter.html");
	echo $Viewer->html();
?>

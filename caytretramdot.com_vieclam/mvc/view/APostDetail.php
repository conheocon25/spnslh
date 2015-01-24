<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/APostDetail.html");
	echo $Viewer->html();
?>

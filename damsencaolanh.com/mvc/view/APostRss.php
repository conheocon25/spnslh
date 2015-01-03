<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/APostRss.html");
	echo $Viewer->html();
?>

<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/APostLinked.html");
	echo $Viewer->html();
?>

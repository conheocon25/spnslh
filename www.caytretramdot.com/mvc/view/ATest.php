<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ATest.html");
	echo $Viewer->html();
?>

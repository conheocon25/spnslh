<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/FPost.html");
	echo $Viewer->html();
?>

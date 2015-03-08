<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/APost.html");
	echo $Viewer->html();
?>

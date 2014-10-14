<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/FVideoDetail.html");
	echo $Viewer->html();
?>
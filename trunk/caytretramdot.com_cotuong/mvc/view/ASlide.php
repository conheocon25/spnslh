<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ASlide.html");
	echo $Viewer->html();
?>

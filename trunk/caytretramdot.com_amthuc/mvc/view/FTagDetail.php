<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/FTagDetail.html");
	echo $Viewer->html();
?>

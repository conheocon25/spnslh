<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ResultDetail.html");
	echo $Viewer->html();
?>

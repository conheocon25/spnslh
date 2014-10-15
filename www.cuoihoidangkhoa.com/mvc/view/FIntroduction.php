<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/FIntroduction.html");
	echo $Viewer->html();
?>

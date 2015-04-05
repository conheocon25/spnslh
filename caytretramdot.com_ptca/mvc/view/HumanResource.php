<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/HumanResource.html");
	echo $Viewer->html();
?>

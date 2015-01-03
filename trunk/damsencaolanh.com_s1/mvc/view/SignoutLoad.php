<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/SignoutLoad.html");
	echo $Viewer->html();
?>

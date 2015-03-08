<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ALinked.html");
	$Out = $Viewer->html();
	unset($Viewer);
	echo $Out;
?>

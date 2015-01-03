<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/CallLogLoading.html");
	$Out = $Viewer->html();
	unset($Viewer);
	echo $Out;
?>

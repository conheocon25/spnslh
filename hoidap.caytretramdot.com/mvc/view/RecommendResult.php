<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/RecommendResult.html");
	echo $Viewer->html();
?>

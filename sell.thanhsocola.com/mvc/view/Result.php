<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/Result.html");
	echo $Viewer->html();
?>

<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/FixedSession.html");
	echo $Viewer->html();
?>

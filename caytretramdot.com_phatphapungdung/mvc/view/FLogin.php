<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/FLogin.html");
	echo $Viewer->html();
?>

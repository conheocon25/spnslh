<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/UtilityNameCard.html");
	echo $Viewer->html();
?>

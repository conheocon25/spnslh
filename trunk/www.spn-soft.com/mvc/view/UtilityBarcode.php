<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/UtilityBarcode.html");
	echo $Viewer->html();
?>

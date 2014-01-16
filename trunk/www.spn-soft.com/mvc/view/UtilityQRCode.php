<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/UtilityQRCode.html");
	echo $Viewer->html();
?>

<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/WarehouseExportLoadQueue.html");
	echo $Viewer->html();
?>

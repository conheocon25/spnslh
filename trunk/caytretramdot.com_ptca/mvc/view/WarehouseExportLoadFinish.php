<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/WarehouseExportLoadFinish.html");
	echo $Viewer->html();
?>

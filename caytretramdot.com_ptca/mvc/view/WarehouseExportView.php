<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/WarehouseExportView.html");
	echo $Viewer->html();
?>

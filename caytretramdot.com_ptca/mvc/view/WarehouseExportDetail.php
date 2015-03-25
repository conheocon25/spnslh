<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/WarehouseExportDetail.html");
	echo $Viewer->html();
?>

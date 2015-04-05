<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/WarehouseExportViewPrint.html");
	echo $Viewer->html();
?>

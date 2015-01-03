<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ExportSupplierOrder.html");
	echo $Viewer->html();
?>

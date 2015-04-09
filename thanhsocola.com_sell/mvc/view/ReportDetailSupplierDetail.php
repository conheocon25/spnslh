<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ReportDetailSupplierDetail.html");
	echo $Viewer->html();
?>
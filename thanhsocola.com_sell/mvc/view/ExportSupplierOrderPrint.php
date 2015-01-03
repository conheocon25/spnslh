<?php	
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ExportSupplierOrderPrint.html");
	echo $Viewer->pdfA4();
?>

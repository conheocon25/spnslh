<?php	
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/AImportSupplierOrderPrint.html");
	echo $Viewer->pdfA4();
?>

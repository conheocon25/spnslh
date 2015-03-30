<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/BranchSaleInvoiceCustomerPrint.html");
	echo $Viewer->html();
?>

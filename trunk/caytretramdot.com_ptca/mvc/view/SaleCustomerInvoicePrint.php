<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/SaleCustomerInvoicePrint.html");
	echo $Viewer->html();
?>

<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/SaleInvoiceCustomerDetail.html");
	echo $Viewer->html();
?>

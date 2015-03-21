<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/SaleCustomerInvoice.html");
	echo $Viewer->html();
?>

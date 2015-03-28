<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/SaleCommandCustomerDetailPrint.html");
	echo $Viewer->html();
?>

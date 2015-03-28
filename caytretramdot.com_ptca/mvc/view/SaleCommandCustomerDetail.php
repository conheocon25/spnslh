<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/SaleCommandCustomerDetail.html");
	echo $Viewer->html();
?>

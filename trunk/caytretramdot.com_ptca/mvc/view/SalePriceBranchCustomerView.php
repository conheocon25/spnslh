<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/SalePriceBranchCustomerView.html");
	echo $Viewer->html();
?>

<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/AMoneyCollectCustomer.html");
	$Out = $Viewer->html();
	unset($Viewer);
	echo $Out;
?>

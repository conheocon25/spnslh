<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/BranchCustomerCollectView.html");
	echo $Viewer->html();
?>

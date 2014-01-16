<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/AppCustomer.html");
	echo $Viewer->html();
?>

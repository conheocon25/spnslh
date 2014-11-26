<?php	
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/SellingTablePrint1.html");
	echo $Viewer->html();
?>
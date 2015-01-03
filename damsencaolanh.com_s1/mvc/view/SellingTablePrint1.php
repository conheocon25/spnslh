<?php	
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/SellingTablePrint2.html");
	echo $Viewer->html();
?>
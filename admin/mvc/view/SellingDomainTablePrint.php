<?php	
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/SellingDomainTablePrint.html");
	$Out = $Viewer->custompdf();
	unset($Viewer);
	echo $Out;
?>
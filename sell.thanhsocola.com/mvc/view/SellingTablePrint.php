<?php	
	require_once("mvc/base/Viewer.php");
	$Viewer 	= new Viewer("mvc/templates/SellingTablePrint.html");
	$Request 	= \MVC\Base\RequestRegistry::getRequest();
	$Config 	= $Request->getObject("Config");	
	echo $Viewer->html();
?>
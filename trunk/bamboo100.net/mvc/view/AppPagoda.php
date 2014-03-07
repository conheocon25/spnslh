<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/AppPagoda.html");
	echo $Viewer->html();
?>

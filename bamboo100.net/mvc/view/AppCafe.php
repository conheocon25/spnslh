<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/AppCafe.html");
	echo $Viewer->html();
?>

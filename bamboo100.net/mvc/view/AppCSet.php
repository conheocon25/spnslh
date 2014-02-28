<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/AppCSet.html");
	echo $Viewer->html();
?>

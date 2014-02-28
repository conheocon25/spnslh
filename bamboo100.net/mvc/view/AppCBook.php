<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/AppCBook.html");
	echo $Viewer->html();
?>

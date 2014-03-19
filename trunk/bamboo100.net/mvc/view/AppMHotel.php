<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/AppMHotel.html");
	echo $Viewer->html();
?>

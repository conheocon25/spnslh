<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ABook.html");
	echo $Viewer->html();
?>

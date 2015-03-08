<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/FBook.html");
	echo $Viewer->html();
?>

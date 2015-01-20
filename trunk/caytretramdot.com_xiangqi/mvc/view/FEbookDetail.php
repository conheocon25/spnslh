<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/FEbookDetail.html");
	echo $Viewer->html();
?>

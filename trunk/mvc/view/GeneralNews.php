<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/GeneralNews.html");
	echo $Viewer->html();
?>

<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/MarketNews.html");
	echo $Viewer->html();
?>

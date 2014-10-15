<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/FAlbumImage.html");
	echo $Viewer->html();
?>
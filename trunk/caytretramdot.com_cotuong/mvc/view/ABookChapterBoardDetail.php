<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/ABookChapterBoardDetail.html");
	echo $Viewer->html();
?>

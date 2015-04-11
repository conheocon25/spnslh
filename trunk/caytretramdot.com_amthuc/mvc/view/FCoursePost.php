<?php
	require_once("mvc/base/Viewer.php");
	$Viewer = new Viewer("mvc/templates/FCoursePost.html");
	echo $Viewer->html();
?>

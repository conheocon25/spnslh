<?php
	require_once("mvc/base/Viewer.php");	
	$Viewer = new Viewer("mvc/templates/BranchReport.html");	
	echo $Viewer->html();
?>

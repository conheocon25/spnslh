<?php
	require_once("mvc/base/ViewHelper.php");
	$request = VH::getRequest();	
	$Data = array("Result" => "OK");
	echo json_encode($Data);
?>
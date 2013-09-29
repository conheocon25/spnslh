<?php
	require_once("mvc/base/ViewHelper.php");
	$request = VH::getRequest();
	$Customer = $request->getObject('Customer');
	$BC = $Customer->getBarcode();
	
	header('Content-type: image/png');
	imagegif($BC);
	imagedestroy($BC);
?>

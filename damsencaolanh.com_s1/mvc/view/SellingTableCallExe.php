<?php
	require_once("mvc/base/ViewHelper.php");
	$request = VH::getRequest();
	$SD = $request->getObject('SD');
	$Data = array(
		"Result" => "OK",
		"Name"=>$SD->getCourse()->getName(),
		"Unit"=>$SD->getCourse()->getUnit(),
		"Count"=>$SD->getCount(),
		"Value"=>$SD->getValuePrint()
	);
	echo json_encode($Data);
?>
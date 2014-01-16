<?php
	//require_once("mvc/base/Viewer.php");
	//$Viewer = new Viewer("mvc/templates/UtilityNameCardGenerate.html");
	//echo $Viewer->html();
	require_once("mvc/base/ViewHelper.php");			
	$request = VH::getRequest();
			
	$CompanyName 	= $request->getProperty('CompanyName');
	$Slogan			= $request->getProperty('Slogan');
	$FullName		= $request->getProperty('FullName');
	$Position		= $request->getProperty('Position');
	$Phone			= $request->getProperty('Phone');
	$Email			= $request->getProperty('Email');
	$Address		= $request->getProperty('Address');
	$Website		= $request->getProperty('Website');
	$TypeCard		= $request->getProperty('TypeCard');
	
	$URL = "mvc/templates/UtilityNameCardGenerate".$TypeCard.".html";
	
	$tpl = new PHPTAL( $URL);
	$tpl->CompanyName 	= $CompanyName;
	$tpl->Slogan 		= $Slogan;
	$tpl->FullName 		= $FullName;
	$tpl->Position 		= $Position;
	$tpl->Phone 		= $Phone;
	$tpl->Email 		= $Email;
	$tpl->Address 		= $Address;
	$tpl->Website 		= $Website;
	$tpl->TypeCard 		= $TypeCard;
	
	echo $tpl->execute();
?>

<?php
	require_once("mvc/base/ViewHelper.php");
	$req = VH::getRequest();
	
	$Projects = $req->getObject('Projects');
	$Solutions = $req->getObject('Solutions');
	$Services = $req->getObject('Services');
	$CustomerStories = $req->getObject('CustomerStories');
	$Technicals = $req->getObject('Technicals');
	$Channel = $req->getProperty('Channel');	
	$ActiveItem = $req->getProperty('ActiveItem');
	$URL = "mvc/templates/EntertainmentTVOnline".$Channel.".html";
	
	$tpl = new PHPTAL( $URL);
	$tpl->ActiveItem = $ActiveItem;
	$tpl->Projects = $Projects;
	$tpl->Solutions = $Solutions;
	$tpl->Services = $Services;
	$tpl->CustomerStories = $CustomerStories;
	$tpl->Technicals = $Technicals;
	
	echo $tpl->execute();
?>

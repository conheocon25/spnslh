<?php
	namespace MVC\Command;	
	class FixedSession extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session 			= \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mConfig 			= new \MVC\Mapper\Config();
			$mSession 			= new \MVC\Mapper\Session();
			$mSessionDisable 	= new \MVC\Mapper\SessionDisable();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Title 				= "PHIẾU HƯ";
			$Navigation 		= array();
			$FixedSessionAll 	= $mSessionDisable->findAll();
			$SessionAll 		= $mSession->findLimit200(array());
			$ConfigName 		= $mConfig->findByName("NAME");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																		
			$request->setProperty('Title', 			$Title);
			$request->setProperty('ActiveAdmin', 	'FixedSession');
			$request->setObject("Navigation", 		$Navigation);
			$request->setObject("FixedSessionAll", 	$FixedSessionAll);
			$request->setObject("SessionAll", 		$SessionAll);
			$request->setObject("ConfigName", 		$ConfigName);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
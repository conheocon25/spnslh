<?php
	namespace MVC\Command;	
	class Money extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mConfig = new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$Title 			= "THU / CHI";
			$Navigation 	= array();
			$ConfigName 	= $mConfig->findByName("NAME");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																		
			$request->setProperty('Title', 			$Title );
			$request->setProperty('ActiveAdmin', 	'Money' );
			$request->setObject("Navigation", 		$Navigation);
			$request->setObject("ConfigName", 		$ConfigName);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
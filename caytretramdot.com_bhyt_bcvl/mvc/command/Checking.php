<?php		
	namespace MVC\Command;	
	class Checking extends Command {
		function doExecute( \MVC\Controller\Request $request ){
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
			$mDomain = new \MVC\Mapper\Domain();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$DomainAll 	= $mDomain->findAll();
			$ConfigName = $mConfig->findByName("NAME");
						
			$Title 		= "ĐÓNG PHÍ";
			$Navigation = array();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title', 			$Title);
			$request->setProperty('ActiveAdmin', 	'Setting');
			$request->setObject('Navigation', 		$Navigation);
			$request->setObject('ConfigName', 		$ConfigName);
			$request->setObject('DomainAll', 		$DomainAll);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
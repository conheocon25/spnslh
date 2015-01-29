<?php		
	namespace MVC\Command;	
	class ATesting1 extends Command {
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
			$mConfig 	= new \MVC\Mapper\Config();
			$mBook 		= new \MVC\Mapper\Book();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$ConfigName = $mConfig->findByName("NAME");
			$BookAll	= $mBook->findAll();
						
			$Title = "THỬ NGHIỆM";
			$Navigation = array();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title', 			$Title);
			$request->setProperty('ActiveAdmin', 	'Setting');
			$request->setObject('Navigation', 		$Navigation);
			$request->setObject('ConfigName', 		$ConfigName);
			$request->setObject('BookAll', 			$BookAll);
									
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
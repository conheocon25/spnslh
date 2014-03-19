<?php
	namespace MVC\Command;	
	class AppMRestaurant extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();

			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mMRestaurant 	= new \MVC\Mapper\MRestaurant();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$MRestaurant	= $mMRestaurant->find(1);
						
			$Title	= "QUẢN LÝ QUÁN ĂN";
			$Navigation = array(
				array("TRANG CHỦ", "/trang-chu"),				
			);
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('MRestaurant', 		$MRestaurant);
			$request->setObject('Navigation', 	$Navigation);
			$request->setProperty('Title', 		$Title);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
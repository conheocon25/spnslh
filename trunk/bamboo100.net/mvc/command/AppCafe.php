<?php
	namespace MVC\Command;	
	class AppCafe extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();

			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCafe 	= new \MVC\Mapper\Cafe();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$Cafe	= $mCafe->find(1);
						
			$Title	= "QUẢN LÝ CAFE";
			$Navigation = array(
				array("TRANG CHỦ", "/trang-chu"),				
			);
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('Cafe', 		$Cafe);
			$request->setObject('Navigation', 	$Navigation);
			$request->setProperty('Title', 		$Title);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
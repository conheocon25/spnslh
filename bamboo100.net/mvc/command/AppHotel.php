<?php
	namespace MVC\Command;	
	class AppHotel extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();

			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mHotel 	= new \MVC\Mapper\Hotel();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$Hotel	= $mHotel->find(1);
						
			$Title	= "QUẢN LÝ KHÁCH SẠN";
			$Navigation = array(
				array("TRANG CHỦ", "/trang-chu"),				
			);
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('Hotel', 		$Hotel);
			$request->setObject('Navigation', 	$Navigation);
			$request->setProperty('Title', 		$Title);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
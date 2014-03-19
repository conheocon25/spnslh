<?php
	namespace MVC\Command;	
	class AppMHotel extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();

			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mMHotel 	= new \MVC\Mapper\MHotel();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$MHotel	= $mMHotel->find(1);
						
			$Title	= "QUẢN LÝ NHÀ TRỌ";
			$Navigation = array(
				array("TRANG CHỦ", "/trang-chu"),				
			);
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('MHotel', 		$MHotel);
			$request->setObject('Navigation', 	$Navigation);
			$request->setProperty('Title', 		$Title);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
<?php
	namespace MVC\Command;	
	class AppCustomerInsLoad extends Command{
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
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$Title = "QUẢN LÝ / THIẾT LẬP / KHÁCH HÀNG / THÊM MỚI";
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------															
			$request->setProperty("URLBack", '/app/customer');
			$request->setProperty("Title", $Title);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
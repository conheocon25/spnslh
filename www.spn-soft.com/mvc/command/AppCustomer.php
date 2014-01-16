<?php
	namespace MVC\Command;	
	class AppCustomer extends Command{
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
			$mCustomer = new \MVC\Mapper\Customer();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Customers = $mCustomer->findAll();						
			$Title = "QUẢN LÝ / THIẾT LẬP / KHÁCH HÀNG /";
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setObject('Customers', $Customers);						
			
			$request->setProperty("ActiveItem", 'customer');
			$request->setProperty("URLBack", '/app');
			$request->setProperty("Title", $Title);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
<?php
	namespace MVC\Command;	
	class AppCustomerInsExe extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$Name = $request->getProperty('Name');
			$Phone = $request->getProperty('Phone');
			$Address = $request->getProperty('Address');
			$Note = $request->getProperty('Note');
			$Debt = $request->getProperty('Debt');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCustomer = new \MVC\Mapper\Customer();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Customer = new \MVC\Domain\Customer(
				null,
				$Name,
				$Phone,
				$Address,
				$Note,
				$Debt
			);						
			$mCustomer->insert($Customer);
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
						
			return self::statuses('CMD_OK');
		}
	}
?>
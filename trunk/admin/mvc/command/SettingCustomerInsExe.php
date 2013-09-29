<?php
	namespace MVC\Command;	
	class SettingCustomerInsExe extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$Name = $request->getProperty('Name');
			$Type = $request->getProperty('Type');
			$Card = $request->getProperty('Card');
			$Phone = $request->getProperty('Phone');
			$Address = $request->getProperty('Address');
			$Note = $request->getProperty('Note');
			$Discount = $request->getProperty('Discount');
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mCustomer = new \MVC\Mapper\Customer();
					
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			if (!isset($Name)||$Name=="")
				return self::statuses('CMD_OK');
				
			$Customer = new \MVC\Domain\Customer(
				null,
				$Name,
				$Type,
				$Card,
				$Phone,
				$Address,
				$Note,
				$Discount
			);			
			$mCustomer->insert($Customer);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			return self::statuses('CMD_OK');
		}
	}
?>

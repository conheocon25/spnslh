<?php
	namespace MVC\Command;	
	class SettingCustomerUpdExe extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$IdCustomer = $request->getProperty('IdCustomer');
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
			if (!isset($Name))
				return self::statuses('CMD_OK');
				
			$Customer = $mCustomer->find($IdCustomer);
			$Customer->setName($Name);
			$Customer->setType($Type);
			$Customer->setCard($Card);
			$Customer->setPhone($Phone);
			$Customer->setAddress($Address);
			$Customer->setNote($Note);
			$Customer->setDiscount($Discount);
			
			$mCustomer->update($Customer);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			
			return self::statuses('CMD_OK');
		}
	}
?>

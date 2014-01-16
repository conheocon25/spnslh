<?php
	namespace MVC\Command;	
	class AppCustomerUpdExe extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdCustomer = $request->getProperty('IdCustomer');
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
			$Customer = $mCustomer->find($IdCustomer);
			$Customer->setName($Name);
			$Customer->setPhone($Phone);
			$Customer->setAddress($Address);
			$Customer->setNote($Note);
			$Customer->setDebt($Debt);
			
			$mCustomer->update($Customer);
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
						
			return self::statuses('CMD_OK');
		}
	}
?>
<?php
	namespace MVC\Command;	
	class AgencyRegisterUpdExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdAgency = $request->getProperty('IdAgency');
			$Name = $request->getProperty('Name');
			$Phone = $request->getProperty('Phone');
			$Email = $request->getProperty('Email');
			$Password = $request->getProperty('Password');
			$Address = $request->getProperty('Address');
			$Active = 1;
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mAgency = new \MVC\Mapper\Agency();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------												
			$Agency = $mAgency->find($IdAgency);
			$Agency->setName($Name);
			$Agency->setPhone($Phone);
			$Agency->setEmail($Email);
			$Agency->setPassword($Password);
			$Agency->setAddress($Address);
			$Agency->setActive($Active);
			$mAgency->update($Agency);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			return self::statuses('CMD_OK');
		}
	}
?>
<?php
	namespace MVC\Command;
	class SettingEmployeeUpdExe extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdEmployee = $request->getProperty('IdEmployee');
			$Name = $request->getProperty('Name');
			$Gender = $request->getProperty('Gender');
			$Job = $request->getProperty('Job');
			$Phone = $request->getProperty('Phone');
			$Address = $request->getProperty('Address');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$mEmployee = new \MVC\Mapper\Employee();
			if (isset($IdEmployee) && $Name != null) {
				$Employee = $mEmployee->find($IdEmployee);
				$Employee->setName($Name);
				$Employee->setGender($Gender);
				$Employee->setJob($Job);
				$Employee->setPhone($Phone);
				$Employee->setAddress($Address);
				$mEmployee->update($Employee);
			}
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>

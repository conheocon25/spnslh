<?php
	namespace MVC\Command;
	class SettingUserUpdExe extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdUser = $request->getProperty('IdUser');
			$Name = $request->getProperty('Name');
			$Email = $request->getProperty('Email');
			$Pass = $request->getProperty('Pass');
			$Type = $request->getProperty('Type');
			$Gender = $request->getProperty('Gender');
			$Code = $request->getProperty('Code');
			$Note = $request->getProperty('Note');
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mUser = new \MVC\Mapper\User();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$User = $mUser->find($IdUser);
						
			$User->setName($Name);
			$User->setEmail($Email);
			$User->setPass($Pass);
			$User->setType($Type);
			$User->setGender($Gender);
			$User->setCode($Code);
			$User->setNote($Note);
			$mUser->update($User);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>
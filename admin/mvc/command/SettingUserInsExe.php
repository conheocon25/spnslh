<?php
	namespace MVC\Command;
	class SettingUserInsExe extends Command{
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
			$User = new \MVC\Domain\User(
				null,				
				$Name,
				$Email, 
				$Pass,
				$Gender,
				$Note,
				null,	
				null,
				null,	
				$Type,
				$Code
			);
			$mUser->insert($User);
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>

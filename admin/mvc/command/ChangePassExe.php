<?php
	namespace MVC\Command;
	class ChangePassExe extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdUser = $Session->getCurrentIdUser();
			
			$Pass = $request->getProperty('Pass');
			$Pass1 = $request->getProperty('Pass1');
									
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mUser = new \MVC\Mapper\User();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$User = $mUser->find($IdUser);
			if ($Pass!=$Pass1){				
				return self::statuses('CMD_OK');
			}			
			$User->setPass($Pass);
			$mUser->update($User);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>
<?php
	namespace MVC\Command;	
	class SettingMStoreInfoExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$Introduction	= \stripslashes($request->getProperty('Introduction'));
			$Count 			= $request->getProperty('Count');
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mMStore = new \MVC\Mapper\MStore();
					
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------													
			$MStore = $mMStore->find(1);
			$MStore->setIntroduction($Introduction);			
			$MStore->setCount($Count);
			$mMStore->update($MStore);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>
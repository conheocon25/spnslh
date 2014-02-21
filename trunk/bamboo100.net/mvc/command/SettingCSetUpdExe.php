<?php
	namespace MVC\Command;	
	class SettingCSetUpdExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$IdCSet 	= $request->getProperty('IdCSet');
			$IdCBook 	= $request->getProperty('IdCBook');
			$Name 		= $request->getProperty('Name');
			$Content 	= \stripslashes($request->getProperty('Content'));
			$Count 		= $request->getProperty('Count');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mCS = new \MVC\Mapper\CSet();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------													
			$CS = $mCS->find($IdCSet);			
			$CS->setContent($Content);			
			$CS->setName($Name);
			$CS->setCount($Count);
			$CS->reKey();
			$mCS->update($CS);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>

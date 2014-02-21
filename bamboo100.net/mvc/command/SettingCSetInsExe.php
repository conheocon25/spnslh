<?php
	namespace MVC\Command;	
	class SettingCSetInsExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------												
			$IdCBook	= $request->getProperty('IdCBook');
			$Name 		= $request->getProperty('Name');
			$Content 	= \stripslashes($request->getProperty('Content'));			
			$Count		= $request->getProperty('Count');
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mCSet = new \MVC\Mapper\CSet();
					
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------								
			$CSet = new \MVC\Domain\CSet(
				null,				
				$IdCBook,				
				$Name,
				$Content,
				1,
				""
			);
			$CSet->reKey();
			$mCSet->insert($CSet);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			return self::statuses('CMD_OK');
		}
	}
?>
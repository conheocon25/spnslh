<?php
	namespace MVC\Command;
	class SettingDomainTableUpdExe extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Name = $request->getProperty("Name");
			$Type = $request->getProperty("Type");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			
			$mTable = new \MVC\Mapper\Table();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			if (!isset($Name) || !isset($Type))
				return self::statuses('CMD_OK');
				
			$IdTable = $request->getProperty("IdTable");
			$Table = $mTable->find($IdTable);
			$Table->setName($Name);
			$Table->setType($Type);
			$mTable->update($Table);
								
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			
			return self::statuses('CMD_OK');
		}
	}
?>
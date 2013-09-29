<?php
	namespace MVC\Command;
	class SettingSupplierResourceInsExe extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdSupplier = $request->getProperty('IdSupplier');
			$Name = $request->getProperty('Name');
			$Unit = $request->getProperty('Unit');
			$Price = $request->getProperty('Price');
			$Description = $request->getProperty('Description');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			
			$mResource = new \MVC\Mapper\Resource();								
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			if (!isset($Name))
				return self::statuses('CMD_OK');
				
			$Resource = new \MVC\Domain\Resource(
				null,
				$IdSupplier,
				$Name,
				$Unit,
				$Price,
				$Description
			);
			$mResource->Insert($Resource);
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>

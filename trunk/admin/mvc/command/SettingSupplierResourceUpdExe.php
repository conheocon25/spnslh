<?php	
	namespace MVC\Command;
	class SettingSupplierResourceUpdExe extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdResource = $request->getProperty("IdResource");
			$Name = $request->getProperty("Name");						
			$Price = $request->getProperty("Price");
			$Unit = $request->getProperty("Unit");
			$Description = $request->getProperty("Description");
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			
			$mResource = new \MVC\Mapper\Resource();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$Resource = $mResource->find($IdResource);
			if (!isset($Name) || !isset($Price) || !isset($Unit) )
				return self::statuses('CMD_OK');
				
			$OldName = $Resource->getName();
			$Resource->setName($Name);						
			$Resource->setPrice($Price);
			$Resource->setUnit($Unit);
			$Resource->setDescription($Description);
						
			$mResource->update($Resource);
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			
			return self::statuses('CMD_OK');
		}
	}
?>
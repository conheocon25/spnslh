<?php		
	namespace MVC\Command;	
	class ASettingProductMapExe extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------						
			$IdProduct 	= $request->getProperty('IdProduct');
			$Latitude 	= $request->getProperty('Latitude');
			$Longitude 	= $request->getProperty('Longitude');
									
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mProductMap	= new \MVC\Mapper\ProductMap();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------															
			$IdPM  	= $mProductMap->exist(array($IdProduct));
			$PM 	= $mProductMap->find($IdPM);
						
			$PM->setLatitude($Latitude);
			$PM->setLongitude($Longitude);			
			$mProductMap->update($PM);
			
			return self::statuses('CMD_OK');
		}
	}
?>
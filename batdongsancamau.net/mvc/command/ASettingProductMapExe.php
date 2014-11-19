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
			$IdDistrict = $request->getProperty('IdDistrict');
			$IdProduct 	= $request->getProperty('IdProduct');
			$Latitude 	= $request->getProperty('Latitude');
			$Longitude 	= $request->getProperty('Longitude');
			$Address 	= $request->getProperty('Address');
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mProductMap	= new \MVC\Mapper\ProductMap();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------															
			$IdPM  	= $mProductMap->exist(array($IdProduct));
			$PM 	= $mProductMap->find($IdPM);
			
			$PM->setIdDistrict($IdDistrict);
			$PM->setLatitude($Latitude);
			$PM->setLongitude($Longitude);
			$PM->setAddress($Address);
			$mProductMap->update($PM);
			
			return self::statuses('CMD_OK');
		}
	}
?>
<?php		
	namespace MVC\Command;	
	class WarehouseReport extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdKey = $request->getProperty('IdKey');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 		= new \MVC\Mapper\Config();
			$mWarehouse 	= new \MVC\Mapper\Warehouse();
			$mTrack 		= new \MVC\Mapper\Track();
															
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$TrackAll	= $mTrack->findAll();
			
			$Warehouse	= $mWarehouse->findByKey($IdKey);
			$Title 		= "BÁO CÁO";
			$Navigation = array(
				array(mb_strtoupper($Warehouse->getName(), 'UTF8'), "/kho-hang/".$Warehouse->getKey())
			);
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setObject("Navigation", $Navigation);
			$request->setProperty("Title"	, $Title);
			
			$request->setObject("Warehouse"	, $Warehouse);
			$request->setObject("TrackAll"	, $TrackAll);			
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
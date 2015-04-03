<?php		
	namespace MVC\Command;	
	class WarehouseReportTrackDaily extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdKey 		= $request->getProperty('IdKey');
			$IdTrack 	= $request->getProperty('IdTrack');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 				= new \MVC\Mapper\Config();
			$mWarehouse 			= new \MVC\Mapper\Warehouse();
			$mTrack 				= new \MVC\Mapper\Track();
			$mTrackDailyWarehouse 	= new \MVC\Mapper\TrackDailyWarehouse();
															
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$Warehouse	= $mWarehouse->findByKey($IdKey);
			$Track 		= $mTrack->find($IdTrack);
			
			$TDWAll 	= $mTrackDailyWarehouse->findByTrackWarehouse(array($Track->getId(), $Warehouse->getId()));
			if ($TDWAll->count()==0){
				$Track->generateDailyWarehouse($Warehouse);
				$TDWAll = $mTrackDailyWarehouse->findByTrackWarehouse(array($Track->getId(), $Warehouse->getId()));
			}
			
			$Title 		= $Track->getName();
			$Navigation = array(
				array(mb_strtoupper($Warehouse->getName(), 'UTF8'), "/don-vi/".$Warehouse->getKey()),
				array("BÁO CÁO", "/don-vi/".$Warehouse->getKey()."/bao-cao")
			);
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setObject("Navigation", $Navigation);
			$request->setProperty("Title"	, $Title);
						
			$request->setObject("Track"		, $Track);
			$request->setObject("TDWAll"	, $TDWAll);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
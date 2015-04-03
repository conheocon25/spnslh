<?php		
	namespace MVC\Command;	
	class WarehouseReportTrackDailyView extends Command {
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
			$IdTDW 		= $request->getProperty('IdTDW');
			
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
			$TDW 		= $mTrackDailyWarehouse->find($IdTDW);
						
			
			$Title 		= $TDW->getDatePrint();
			$Navigation = array(
				array(mb_strtoupper($Warehouse->getName(), 'UTF8'), "/don-vi/".$Warehouse->getKey()),
				array("BÁO CÁO", "/don-vi/".$Warehouse->getKey()."/bao-cao"),
				array($Track->getName(), $Warehouse->getURLTrackDaily( $Track ))
			);
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setObject("Navigation", $Navigation);
			$request->setProperty("Title"	, $Title);
						
			$request->setObject("Warehouse"	, $Warehouse);
			$request->setObject("Track"		, $Track);
			$request->setObject("TDW"		, $TDW);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
<?php		
	namespace MVC\Command;	
	class ReportTrackWarehouseView extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdTrack 	= $request->getProperty('IdTrack');
			$Date 		= $request->getProperty('Date');
			$IdTDW 		= $request->getProperty('IdTDW');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 	= new \MVC\Mapper\Config();
			$mTrack 	= new \MVC\Mapper\Track();
			$mTDW 		= new \MVC\Mapper\TrackDailyWarehouse();
														
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Track 			= $mTrack->find($IdTrack);
			$TDWAll			= $mTDW->findByDate(array($Date));
			$TDW			= $mTDW->find($IdTDW);					
			
			$DateStr		= date('d/m/Y', strtotime($Date));			
			$Title 			= $DateStr.' KHO HÀNG';
			$Navigation 	= array(
				array("BÁO CÁO", 		"/ql-bao-cao"),
				array($Track->getName(), $Track->getURLReport())
			);
																							
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setProperty("Title", 		$Title);
			$request->setObject("Navigation", 	$Navigation);
												
			$request->setObject("Track", 		$Track);
			$request->setObject("TDWAll", 		$TDWAll);
			$request->setObject("TDW", 			$TDW);
																		
			return self::statuses('CMD_DEFAULT');	
		}
	}
?>
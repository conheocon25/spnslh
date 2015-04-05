<?php		
	namespace MVC\Command;	
	class ReportTrackWarehouse extends Command {
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
			$IdTD 		= $request->getProperty('IdTD');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 	= new \MVC\Mapper\Config();
			$mTrack 	= new \MVC\Mapper\Track();
			$mTD 		= new \MVC\Mapper\TrackDaily();
											
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Track 			= $mTrack->find($IdTrack);
			$TD 			= $mTD->find($IdTD);
			
			$Title 			= $TD->getDatePrint().' KHO HÀNG';
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
			$request->setObject("TD", 			$TD);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
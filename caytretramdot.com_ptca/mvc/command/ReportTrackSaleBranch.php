<?php		
	namespace MVC\Command;	
	class ReportTrackSaleBranch extends Command {
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
			$IdTDB 		= $request->getProperty('IdTDB');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 	= new \MVC\Mapper\Config();
			$mTrack 	= new \MVC\Mapper\Track();
			$mTDB 		= new \MVC\Mapper\TrackDailyBranch();
											
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Track 			= $mTrack->find($IdTrack);
			$TDB			= $mTDB->find($IdTDB);
						
			$Title 			= $TDB->getBranch()->getName();
			$Navigation 	= array(
				array("BÁO CÁO", 						"/ql-bao-cao"),
				array($Track->getName(), 				$Track->getURLReport()),
				array($TDB->getDatePrint()." BÁN HÀNG", "/ql-bao-cao/".$Track->getId()."/".$TDB->getDate()."/ban-hang")
			);
																		
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setProperty("Title", 		$Title);
			$request->setObject("Navigation", 	$Navigation);
						
			$request->setObject("Track", 		$Track);
			$request->setObject("TDB", 			$TDB);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
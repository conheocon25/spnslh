<?php		
	namespace MVC\Command;	
	class ReportTrackSale extends Command {
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
			$TDBAll			= $mTDB->findByDate(array($Date));
			
			$DateStr		= date('d/m/Y', strtotime($Date));
			$Title 			= $DateStr.' BÁN HÀNG';
			
			$Navigation 	= array(
				array("BÁO CÁO", 		"/ql-bao-cao"),
				array($Track->getName(), $Track->getURLReport())
			);
																		
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setProperty("Title", 		$Title);
			$request->setObject("Navigation", 	$Navigation);
			
			$request->setProperty("Date", 		$Date);
			$request->setObject("Track", 		$Track);
			$request->setObject("TDBAll", 		$TDBAll);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
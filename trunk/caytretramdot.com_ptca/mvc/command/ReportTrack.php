<?php		
	namespace MVC\Command;	
	class ReportTrack extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdTrack = $request->getProperty('IdTrack');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 		= new \MVC\Mapper\Config();
			$mTrack 		= new \MVC\Mapper\Track();
															
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																					
			$TrackAll 		= $mTrack->findAll();
			$Track 			= $mTrack->find($IdTrack);
			
			$Title 			= $Track->getName();
			$Navigation 	= array(
				array("BÁO CÁO", "/ql-bao-cao")
			);
															
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setProperty("Title", 		$Title);
			$request->setObject("Navigation", 	$Navigation);
			$request->setProperty("DateCurrent",\date("Y-m-d"));
			
			$request->setObject("Track", 		$Track);
			$request->setObject("TrackAll", 	$TrackAll);
																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
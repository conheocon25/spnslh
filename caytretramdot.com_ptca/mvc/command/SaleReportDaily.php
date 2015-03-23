<?php		
	namespace MVC\Command;	
	class SaleReportDaily extends Command{
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
			$IdDaily = $request->getProperty('IdDaily');
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 		= new \MVC\Mapper\Config();
			$mTrack 		= new \MVC\Mapper\Track();
			$mTrackDaily 	= new \MVC\Mapper\TrackDaily();
															
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																								
			$Track 			= $mTrack->find($IdTrack);
			$TrackDaily 	= $mTrackDaily->find($IdDaily);
			
			$Title 			= $TrackDaily->getDatePrint();
			$Navigation 	= array(
				array("BÁO CÁO BÁN HÀNG", $Track->getURLSaleView()),
				array($Track->getName(), $Track->getURLSaleView())
			);
																								
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("Track"			, $Track);
			$request->setObject("TrackDaily"	, $TrackDaily);
			
			$request->setObject("Navigation", $Navigation);				
			$request->setProperty("Title"	, $Title);
																										
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
<?php		
	namespace MVC\Command;	
	class PayRoll extends Command {
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
			$mTracking = new \MVC\Mapper\Tracking();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$TrackAll = $mTracking->findAll();
			if (!isset($IdTrack)){
				$Track = $TrackAll->current();
				$IdTrack = $Track->getId();
			}else{
				$Track = $mTracking->find($IdTrack);
			}
			
			$Title = "Chấm Công";
			$Navigation = array();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setProperty('Title', $Title);						
			$request->setObject('TrackAll', $TrackAll);
			$request->setObject('Track', $Track);
			$request->setObject('Navigation', $Navigation);
		}
	}
?>
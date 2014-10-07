<?php		
	namespace MVC\Command;	
	class PayRollPrint extends Command {
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
			$IdPayRoll 	= $request->getProperty('IdPayRoll');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mTrack 	= new \MVC\Mapper\Tracking();			
			$mPayRoll 	= new \MVC\Mapper\PayRoll();
			$mPE 		= new \MVC\Mapper\PaidEmployee();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$ConfigName	= $mConfig->findByName("NAME");
			
			$PayRoll 	= $mPayRoll->find($IdPayRoll);
			$Track 		= $mTrack->find($IdTrack);
			$PaidAll	= $mPE->findByTracking1(array($PayRoll->getIdEmployee(), $Track->getDateStart(), $Track->getDateEnd()));
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setObject('PayRoll', 		$PayRoll);
			$request->setObject('PaidAll', 		$PaidAll);
			$request->setObject('Track', 		$Track);
			$request->setObject('ConfigName', 	$ConfigName);			
		}
	}
?>
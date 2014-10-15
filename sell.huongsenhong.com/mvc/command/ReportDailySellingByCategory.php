<?php		
	namespace MVC\Command;	
	class ReportDailySellingByCategory extends Command {
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
			$mSession 	= new \MVC\Mapper\Session();
			$mTracking 	= new \MVC\Mapper\Tracking();
			$mTD 		= new \MVC\Mapper\TrackingDaily();
			$mCategory	= new \MVC\Mapper\Category();
			$mConfig	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$ConfigName		= $mConfig->findByName("NAME");
			$ConfigAddress	= $mConfig->findByName("ADDRESS");
			$ConfigPhone	= $mConfig->findByName("PHONE");
			
			$TD 			= $mTD->find($IdTD);
			$Tracking		= $mTracking->find($IdTrack);
			$CategoryAll	= $mCategory->findAll();
																					
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('ConfigAddress'	, $ConfigAddress);
			$request->setObject('ConfigPhone'	, $ConfigPhone);
			$request->setObject('TD'			, $TD);			
			$request->setObject('CategoryAll'	, $CategoryAll);
		}
	}
?>
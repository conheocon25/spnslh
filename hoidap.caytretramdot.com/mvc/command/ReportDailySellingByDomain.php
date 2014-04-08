<?php		
	namespace MVC\Command;	
	class ReportDailySellingByDomain extends Command {
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
			$mDomain	= new \MVC\Mapper\Domain();
			$mConfig	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$ConfigName		= $mConfig->findByName("NAME");
			$ConfigAddress	= $mConfig->findByName("ADDRESS");
			$ConfigPhone	= $mConfig->findByName("PHONE");
			
			$TD 		= $mTD->find($IdTD);
			$Tracking	= $mTracking->find($IdTrack);
			$DomainAll	= $mDomain->findAll();
			
			$SessionAll = $mSession->findByTracking( array(
				$TD->getDate()." 0:0:0", 
				$TD->getDate()." 23:59:59"
			));
															
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('ConfigAddress'	, $ConfigAddress);
			$request->setObject('ConfigPhone'	, $ConfigPhone);
			
			$request->setObject('TD'			, $TD);
			$request->setObject('DomainAll'		, $DomainAll);
			$request->setObject('SessionAll'	, $SessionAll);
		}
	}
?>
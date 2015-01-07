<?php		
	namespace MVC\Command;	
	class ReportDetail extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
														
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdTrack = $request->getProperty("IdTrack");
									
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mTracking 	= new \MVC\Mapper\Tracking();
			$mConfig 	= new \MVC\Mapper\Config();
			
			$mDomain 	= new \MVC\Mapper\Domain();
			$mTable 	= new \MVC\Mapper\Table();
			$mStudent 	= new \MVC\Mapper\Student();
			$mSession 	= new \MVC\Mapper\Session();
												
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Tracking 			= $mTracking->find($IdTrack);
			$TrackingAll 		= $mTracking->findAll();
			$ConfigName 		= $mConfig->findByName("NAME");
			
			$DomainAll			= $mDomain->findAll();
			$TableAll			= $mTable->findAll();
			$StudentAll			= $mStudent->findAll();
			$StudentAll1		= $mStudent->findByGender(array(1));
			$StudentAll2		= $mStudent->findByGender(array(0));
			
			$SessionAll			= $mSession->findByTracking(array($Tracking->getId()));
			$SessionAll1		= $mSession->findByTrackingGender(array($Tracking->getId(), 1));
			$SessionAll2		= $mSession->findByTrackingGender(array($Tracking->getId(), 0));
												
			$Title = $Tracking->getName();
			$Navigation = array(array("BÁO CÁO", "/report"));
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);			
			$request->setObject('ConfigName'	, $ConfigName);
			
			$request->setObject('TrackingAll'	, $TrackingAll);
			$request->setObject('Tracking'		, $Tracking);
			$request->setObject('DomainAll'		, $DomainAll);
			$request->setObject('TableAll'		, $TableAll);
			
			$request->setObject('StudentAll'	, $StudentAll);
			$request->setObject('StudentAll1'	, $StudentAll1);
			$request->setObject('StudentAll2'	, $StudentAll2);
			
			$request->setObject('SessionAll'	, $SessionAll);
			$request->setObject('SessionAll1'	, $SessionAll1);
			$request->setObject('SessionAll2'	, $SessionAll2);
		}
	}
?>
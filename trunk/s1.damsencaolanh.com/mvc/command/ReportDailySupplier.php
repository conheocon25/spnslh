<?php		
	namespace MVC\Command;	
	class ReportDailySupplier extends Command{
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
			$mTracking 	= new \MVC\Mapper\Tracking();
			$mTD 		= new \MVC\Mapper\TrackingDaily();
			$mSupplier	= new \MVC\Mapper\Supplier();
			$mConfig	= new \MVC\Mapper\Config();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$TD 			= $mTD->find($IdTD);
			$Tracking		= $mTracking->find($IdTrack);
			$SupplierAll	= $mSupplier->findAll();
			$ConfigName		= $mConfig->findByName("NAME");
									
			$Title 		= "NHÀ CUNG CẤP ".$TD->getDatePrint();
			$Navigation = array(
				array("BÁO CÁO"				, "/report"),
				array($Tracking->getName()	, $Tracking->getURLView())				
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title'		, $Title);
			$request->setProperty('IdTrack'		, $IdTrack);
			$request->setProperty('IdTD'		, $IdTD);
			
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('SupplierAll'	, $SupplierAll);
								
			$request->setObject('TD'			, $TD);
			$request->setObject('ConfigName'	, $ConfigName);
		}
	}
?>
<?php		
	namespace MVC\Command;	
	class ReportDetailSupplier extends Command {
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
			$mSupplier 	= new \MVC\Mapper\Supplier();
			$mConfig 	= new \MVC\Mapper\Config();
												
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Tracking 			= $mTracking->find($IdTrack);
			$TrackingAll 		= $mTracking->findAll();
						
			$SupplierAll 		= $mSupplier->findAll();
			$ConfigName 		= $mConfig->findByName("NAME");
						
			$TSAll 				= $Tracking->getSupplierAll();
			if ($TSAll->count()<=0){
				$Tracking->generateSupplier();
				$TSAll = $Tracking->getSupplierAll();
			}
												
			$Title = $Tracking->getName(). "/ N.CUNG CẤP";
			$Navigation = array(array("BÁO CÁO", "/report"));
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('SupplierAll'	, $SupplierAll);
			$request->setObject('TSAll'			, $TSAll);
			$request->setObject('Tracking'		, $Tracking);			
			$request->setObject('TrackingAll'	, $TrackingAll);
			$request->setObject('ConfigName'	, $ConfigName);
		}
	}
?>
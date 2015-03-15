<?php		
	namespace MVC\Command;	
	class ReportDetailCustomer extends Command {
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
			$mCustomer 	= new \MVC\Mapper\Customer();
			$mConfig 	= new \MVC\Mapper\Config();
												
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Tracking 			= $mTracking->find($IdTrack);
			$TrackingAll 		= $mTracking->findAll();
						
			$CustomerAll 		= $mCustomer->findAll();
			$ConfigName 		= $mConfig->findByName("NAME");
						
			$TCAll 				= $Tracking->getCustomerAll();			
			if ($TCAll->count()<=0){
				$Tracking->generateCustomer();
				$TCAll = $Tracking->getCustomerAll();
			}
												
			$Title = $Tracking->getName(). "/ KHÁCH HÀNG";
			$Navigation = array(
				array("BÁO CÁO", "/report")
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('CustomerAll'	, $CustomerAll);
			$request->setObject('TCAll'			, $TCAll);
			$request->setObject('Tracking'		, $Tracking);			
			$request->setObject('TrackingAll'	, $TrackingAll);
			$request->setObject('ConfigName'	, $ConfigName);
		}
	}
?>
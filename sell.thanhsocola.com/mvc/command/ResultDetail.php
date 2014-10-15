<?php		
	namespace MVC\Command;	
	class ResultDetail extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
														
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdTrack 	= $request->getProperty("IdTrack");
			$IdTD 		= $request->getProperty("IdTD");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mTracking 	= new \MVC\Mapper\Tracking();			
			$mTD 		= new \MVC\Mapper\TrackingDaily();			
			$mConfig 	= new \MVC\Mapper\Config();
												
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Tracking 	= $mTracking->find($IdTrack);
			$TD 		= $mTD->find($IdTD);
									
			$Title = $TD->getDatePrint();
			
			$Navigation = array(				
				array("KẾT QUẢ", "/result")				
			);
			$ConfigName = $mConfig->findByName("NAME");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$request->setProperty('Title'		, $Title);									
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('TD'			, $TD);
			$request->setObject('Tracking'		, $Tracking);
			$request->setObject('ConfigName'	, $ConfigName);
						
		}
	}
?>
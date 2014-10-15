<?php		
	namespace MVC\Command;	
	class ResultDetailPrint extends Command{
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
			$mTD 		= new \MVC\Mapper\TrackingDaily();
			$mConfig 	= new \MVC\Mapper\Config();
												
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$TD 		= $mTD->find($IdTD);
			$LotoAll	= $TD->getLotoAll();
			$ConfigName = $mConfig->findByName("NAME");			
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------															
			$request->setObject('TD'			, $TD);
			$request->setObject('LotoAll'		, $LotoAll);			
			$request->setProperty('ConfigName'	, $ConfigName);
						
		}
	}
?>
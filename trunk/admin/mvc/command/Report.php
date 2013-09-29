<?php		
	namespace MVC\Command;	
	class Report extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
														
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mTracking = new \MVC\Mapper\Tracking();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Tracks = $mTracking->findAll();
			$Title = "BÁO CÁO";			
			$Navigation = array(
				array("ỨNG DỤNG", "/app")
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setProperty('Title', $Title);
			$request->setProperty('ActiveAdmin', "Report");						
			$request->setObject('Tracks', $Tracks);
			$request->setObject('Navigation', $Navigation);
		}
	}
?>
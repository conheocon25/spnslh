<?php		
	namespace MVC\Command;	
	class CallLog extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------
			$Session = \MVC\Base\SessionRegistry::instance();
														
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mCL = new \MVC\Mapper\CourseLog();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$CLAll 	= $mCL->findAll();
			$Title 	= "BẾP XEM";
			$Navigation = array();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setProperty('Title'		, $Title);
			$request->setProperty('ActiveAdmin'	, 'CallLog');			
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('CLAll'			, $CLAll);
		}
	}
?>
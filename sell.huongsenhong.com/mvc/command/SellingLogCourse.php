<?php		
	namespace MVC\Command;	
	class SellingLogCourse extends Command {
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
			$CLAllPrint 	= $mCL->findByPrint(array());
			$CLAllKitchen 	= $mCL->findByKitchen(array());
			$CLAllFinished 	= $mCL->findByFinished(array());
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setObject('CLAllPrint'			, $CLAllPrint);
			$request->setObject('CLAllKitchen'			, $CLAllKitchen);
			$request->setObject('CLAllFinished'			, $CLAllFinished);
		}
	}
?>
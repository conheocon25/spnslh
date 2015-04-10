<?php
	namespace MVC\Command;	
	class FHome extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mConfig 			= new \MVC\Mapper\Config();			
			$mCourse 			= new \MVC\Mapper\Course();
			$mCategoryPost		= new \MVC\Mapper\CategoryPost();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------												
			$CourseAll 			= $mCourse->findAll();						
															
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setObject("CourseAll", 			$CourseAll);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
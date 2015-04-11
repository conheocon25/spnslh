<?php
	namespace MVC\Command;	
	class FCoursePost extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$KCourse 	= $request->getProperty('KCourse');
			$KPost 		= $request->getProperty('KPost');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mConfig 			= new \MVC\Mapper\Config();			
			$mCourse 			= new \MVC\Mapper\Course();
			$mPost 				= new \MVC\Mapper\Post();
												
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------												
			$Course 			= $mCourse->findByKey($KCourse);
			$Post 				= $mPost->findByKey($KPost);
															
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setObject("Course", 			$Course);
			$request->setObject("Post", 			$Post);
			$request->setProperty("URLShare", 		"#");
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
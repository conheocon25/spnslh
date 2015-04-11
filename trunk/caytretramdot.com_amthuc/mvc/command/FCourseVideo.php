<?php
	namespace MVC\Command;	
	class FCourseVideo extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$KCourse = $request->getProperty('KCourse');
			$IdVideo = $request->getProperty('IdVideo');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mConfig 			= new \MVC\Mapper\Config();			
			$mCourse 			= new \MVC\Mapper\Course();
			$mVideo 			= new \MVC\Mapper\Video();
												
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------												
			$Course 			= $mCourse->findByKey($KCourse);
			$Video 				= $mVideo->find($IdVideo);
															
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setObject("Course", 			$Course);
			$request->setObject("Video", 			$Video);
			$request->setProperty("URLShare", 		"#");
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
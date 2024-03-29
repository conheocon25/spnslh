<?php		
	namespace MVC\Command;	
	class ACourse extends Command {
		function doExecute( \MVC\Controller\Request $request ){
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
			$mCourse 		= new \MVC\Mapper\Course();
			$mCookMethod 	= new \MVC\Mapper\CookMethod();
			$mConfig 		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$CookMethodAll 	= $mCookMethod->findAll();
			$CourseAll 		= $mCourse->findAll();
						
			$Title = "MÓN ĂN";
			$Navigation = array();			
			$Config 	= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName = $mConfig->findByName("NAME");
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('ActiveAdmin'	, 'Course');			
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('Navigation'	, $Navigation);
			
			$request->setObject('CookMethodAll'	, $CookMethodAll);
			$request->setObject('CourseAll'		, $CourseAll);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
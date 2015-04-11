<?php		
	namespace MVC\Command;	
	class ACoursePostUpdExe extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdCourse 	= $request->getProperty('IdCourse');
			$IdPost 	= $request->getProperty('IdPost');
			$Title 		= $request->getProperty('Title');
			$Content 	= \stripslashes($request->getProperty('Content'));
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCourse 	= new \MVC\Mapper\Course();
			$mPost 		= new \MVC\Mapper\Post();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																					
			$Course 	= $mCourse->find($IdCourse);
			$Post 		= $mPost->find($IdPost);
			$Post->setTitle($Title);
			$Post->setContent($Content);
			$Post->setDateTimeUpdated(\date('Y-m-d H:i'));
			$mPost->update($Post);
											
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
																					
			return self::statuses('CMD_OK');
		}
	}
?>
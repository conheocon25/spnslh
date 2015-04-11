<?php
	namespace MVC\Command;	
	class ACoursePostInsExe extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$IdCourse 	= $request->getProperty('IdCourse');			
			$Title 		= $request->getProperty('Title');
			$Content 	= \stripslashes($request->getProperty('Content'));
												
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mPost 	= new \MVC\Mapper\Post();			
								
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------							
			$Post = new \MVC\Domain\Post(
				null,
				$IdCourse,
				$Title,
				\date('Y-m-d H:i'),
				\date('Y-m-d H:i'),
				$Content,
				""
			);
			$Post->reKey();
			$mPost->insert($Post);
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			return self::statuses('CMD_OK');
		}
	}
?>

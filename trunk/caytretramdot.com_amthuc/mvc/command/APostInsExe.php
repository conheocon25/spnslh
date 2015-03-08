<?php
	namespace MVC\Command;	
	class APostInsExe extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$IdCategory = $request->getProperty('IdCategory');			
			$Title 		= $request->getProperty('Title');
			$Content 	= \stripslashes($request->getProperty('Content'));
			$Author 	= $request->getProperty('Author');			
			$Time	 	= date('Y-m-d H:i:s');
			$Viewed	 	= $request->getProperty('Viewed');
			$Liked	 	= $request->getProperty('Liked');
									
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mPost 	= new \MVC\Mapper\Post();			
								
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------							
			$Post = new \MVC\Domain\Post(
				null,
				$IdCategory,
				$Title,
				$Content,				
				$Time,				
				"",
				$Viewed,
				$Liked
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

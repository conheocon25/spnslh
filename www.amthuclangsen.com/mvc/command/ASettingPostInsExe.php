<?php
	namespace MVC\Command;	
	class ASettingPostInsExe extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------												
			$IdTag 		= $request->getProperty('IdTag');
			$Title 		= $request->getProperty('Title');
			$Content 	= \stripslashes($request->getProperty('Content'));
			$Author 	= $request->getProperty('Author');
			$Count	 	= $request->getProperty('Count');
			$Time	 	= $request->getProperty('Time');
									
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mPost 	= new \MVC\Mapper\Post();
			$mTag 	= new \MVC\Mapper\Tag();
			$mPT 	= new \MVC\Mapper\PostTag();
					
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------							
			$Post = new \MVC\Domain\Post(
				null,
				$Title,
				$Content,
				$Author,
				$Time,
				$Count,
				""
			);
			$Post->reKey();
			$mPost->insert($Post);
			
			$PT = new \MVC\Domain\PostTag(
				null,
				$Post->getId(),
				$IdTag
			);
			$mPT->insert($PT);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			return self::statuses('CMD_OK');
		}
	}
?>

<?php
	namespace MVC\Command;	
	class SettingPostInsExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------									
			$DateTime 	= $request->getProperty('DateTime');
			$Content 	= \stripslashes($request->getProperty('Content'));
			$Title 		= $request->getProperty('Title');
			$Count		= $request->getProperty('Count');
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mPost = new \MVC\Mapper\Post();
					
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------								
			$Post = new \MVC\Domain\Post(
				null,
				$Session->getCurrentUser()->getId(),
				$DateTime,
				$Title,
				$Content,
				1,
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

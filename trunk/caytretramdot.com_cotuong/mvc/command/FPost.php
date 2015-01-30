<?php
	namespace MVC\Command;	
	class FPost extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$KCategory 	= $request->getProperty('KCategory');
			$KPost 		= $request->getProperty('KPost');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mConfig 		= new \MVC\Mapper\Config();
			$mPost 			= new \MVC\Mapper\Post();			
			$mCategoryBook 	= new \MVC\Mapper\CategoryBook();
			$mCategoryPost 	= new \MVC\Mapper\CategoryPost();
			$mCategoryVideo	= new \MVC\Mapper\CategoryVideo();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------											
			$Post 				= $mPost->findByKey($KPost);
			$Post->setViewed($Post->getViewed() + 1);
			$mPost->update($Post);
			
			$CategoryPostAll 	= $mCategoryPost->findAll();
			$CategoryBookAll 	= $mCategoryBook->findAll();
			$CategoryVideoAll 	= $mCategoryVideo->findAll();
															
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("URLShare", 			$Post->getURLViewFull());
			$request->setObject("Post", 				$Post);			
			$request->setObject("Category", 			$Post->getCategory());
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);
			$request->setObject("CategoryBookAll", 		$CategoryBookAll);
			$request->setObject("CategoryVideoAll", 	$CategoryVideoAll);
									
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
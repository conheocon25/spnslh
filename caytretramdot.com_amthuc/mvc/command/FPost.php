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

			$mCategoryBuddha = new \MVC\Mapper\CategoryBuddha();
			$mCategoryPost 	= new \MVC\Mapper\CategoryPost();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------											
			$Category 			= $mCategoryPost->findByKey($KCategory);
			$Post 				= $mPost->findByKey($KPost);
			$Post->setViewed($Post->getViewed() + 1);
			$mPost->update($Post);
			
			$CategoryPostAll 	= $mCategoryPost->findAll();
			$CategoryBuddhaAll 	= $mCategoryBuddha->findAll();
															
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("URLShare", 			$Post->getURLViewFull());
			$request->setObject("Category", 			$Category);
			$request->setObject("Post", 				$Post);
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);
			$request->setObject("CategoryBuddhaAll", 		$CategoryBuddhaAll);
									
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
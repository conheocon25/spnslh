<?php
	namespace MVC\Command;	
	class FCategoryPost extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$KCategory = $request->getProperty('KCategory');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mConfig 		= new \MVC\Mapper\Config();
			$mCategoryVideo = new \MVC\Mapper\CategoryVideo();
			$mCategoryPost 	= new \MVC\Mapper\CategoryPost();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------											
			$Category 			= $mCategoryPost->findByKey($KCategory);
			$CategoryVideoAll 	= $mCategoryVideo->findAll();
			$CategoryPostAll 	= $mCategoryPost->findAll();
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("Category", 			$Category);
			$request->setObject("CategoryVideoAll", 	$CategoryVideoAll);
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);
									
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
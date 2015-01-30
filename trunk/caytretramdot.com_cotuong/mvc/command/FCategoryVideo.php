<?php
	namespace MVC\Command;	
	class FCategoryVideo extends Command {
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
			$mCategoryBook 	= new \MVC\Mapper\CategoryBook();			
			$mCategoryPost 	= new \MVC\Mapper\CategoryPost();
			$mCategoryVideo	= new \MVC\Mapper\CategoryVideo();						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------											
			$Category 			= $mCategoryVideo->findByKey($KCategory);
			$CategoryBookAll 	= $mCategoryBook->findAll();
			$CategoryPostAll 	= $mCategoryPost->findAll();
			$CategoryVideoAll 	= $mCategoryVideo->findAll();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("Category", 			$Category);
			$request->setObject("CategoryBookAll", 		$CategoryBookAll);
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);
			$request->setObject("CategoryVideoAll", 	$CategoryVideoAll);								
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
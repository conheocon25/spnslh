<?php
	namespace MVC\Command;	
	class FCategoryBook extends Command {
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
			$Page 		= $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mConfig 		= new \MVC\Mapper\Config();
			$mBook 			= new \MVC\Mapper\Book();
			$mCategoryBook 	= new \MVC\Mapper\CategoryBook();			
			$mCategoryPost 	= new \MVC\Mapper\CategoryPost();
			$mCategoryVideo	= new \MVC\Mapper\CategoryVideo();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------											
			if (!isset($Page)) $Page = 1;			
			$Category 			= $mCategoryBook->findByKey($KCategory);
			
			$BookAll 	= $mBook->findByPage(array($Category->getId(), $Page, 8));
			$PN 		= new \MVC\Domain\PageNavigation($Category->getBookAll()->count(), 8, $Category->getURLView() );
			
			$CategoryBookAll 	= $mCategoryBook->findAll();
			$CategoryPostAll 	= $mCategoryPost->findAll();
			$CategoryVideoAll 	= $mCategoryVideo->findAll();
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("Category", 			$Category);
			$request->setObject("BookAll", 				$BookAll);
			$request->setObject("PN", 					$PN);
			$request->setProperty("Page", 				$Page);
			
			$request->setObject("CategoryBookAll", 		$CategoryBookAll);
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);
			$request->setObject("CategoryVideoAll", 	$CategoryVideoAll);								
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
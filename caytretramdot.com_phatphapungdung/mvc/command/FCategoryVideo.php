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
			$KCategory 	= $request->getProperty('KCategory');
			$Page 		= $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mConfig 		= new \MVC\Mapper\Config();
			$mVideo 		= new \MVC\Mapper\Video();
			
			$mCategoryPost 	= new \MVC\Mapper\CategoryPost();
			$mCategoryVideo	= new \MVC\Mapper\CategoryVideo();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------											
			$Category 			= $mCategoryVideo->findByKey($KCategory);
			
			if (!isset($Page)) $Page = 1;
			$VideoAll 	= $mVideo->findByPage(array($Category->getId(), $Page, 8));
			$PN 		= new \MVC\Domain\PageNavigation($Category->getVideoAll()->count(), 8, $Category->getURLView() );
			
			$CategoryPostAll 	= $mCategoryPost->findAll();
			$CategoryVideoAll 	= $mCategoryVideo->findAll();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("PN", 					$PN);
			$request->setProperty("Page", 				$Page);
			$request->setObject("VideoAll", 			$VideoAll);
			
			$request->setObject("Category", 			$Category);			
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);
			$request->setObject("CategoryVideoAll", 	$CategoryVideoAll);								
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
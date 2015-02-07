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
			$OrderBy 	= $request->getProperty('OrderBy');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mConfig 		= new \MVC\Mapper\Config();
			$mVideo 		= new \MVC\Mapper\Video();
			$mCategoryBook 	= new \MVC\Mapper\CategoryBook();			
			$mCategoryPost 	= new \MVC\Mapper\CategoryPost();
			$mCategoryVideo	= new \MVC\Mapper\CategoryVideo();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------											
			$Category 			= $mCategoryVideo->findByKey($KCategory);
			
			if (!isset($Page)) $Page = 1;
			
			$VideoRecentAll 	= $mVideo->findByRecentPage(array($Category->getId(), $Page, 8));			
			$PNByRecent 		= new \MVC\Domain\PageNavigation($Category->getVideoAll()->count(), 8, $Category->getURLView() );
			
			$VideoViewedAll 	= $mVideo->findByViewedPage(array($Category->getId(), $Page, 8));			
			$PNByViewed 		= new \MVC\Domain\PageNavigation($Category->getVideoAll()->count(), 8, $Category->getURLView() );
			
			$VideoLikedAll 		= $mVideo->findByLikedPage(array($Category->getId(), $Page, 8));
			$PNByLiked 			= new \MVC\Domain\PageNavigation($Category->getVideoAll()->count(), 8, $Category->getURLView() );
						
			$CategoryBookAll 	= $mCategoryBook->findAll();
			$CategoryPostAll 	= $mCategoryPost->findAll();
			$CategoryVideoAll 	= $mCategoryVideo->findAll();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("PNByRecent", 			$PNByRecent);
			$request->setObject("PNByViewed", 			$PNByViewed);
			$request->setObject("PNByLiked", 			$PNByLiked);
			
			$request->setProperty("Page", 				$Page);
			$request->setProperty("OrderBy", 			$OrderBy);
			$request->setObject("VideoRecentAll", 		$VideoRecentAll);
			$request->setObject("VideoViewedAll", 		$VideoViewedAll);
			$request->setObject("VideoLikedAll", 		$VideoLikedAll);
			
			$request->setObject("Category", 			$Category);
			$request->setObject("CategoryBookAll", 		$CategoryBookAll);
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);
			$request->setObject("CategoryVideoAll", 	$CategoryVideoAll);								
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
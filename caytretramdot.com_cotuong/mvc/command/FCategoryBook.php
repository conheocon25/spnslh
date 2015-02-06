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
			$OrderBy 	= $request->getProperty('OrderBy');
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
			$Category 				= $mCategoryBook->findByKey($KCategory);
			
			$BookOrderByViewedAll 	= $mBook->findByViewedPage(array($Category->getId(), $Page, 8));
			$BookOrderByLikedAll 	= $mBook->findByLikedPage(array($Category->getId(), $Page, 8));
			$BookOrderByRecentAll 	= $mBook->findByRecentPage(array($Category->getId(), $Page, 8));
			
			$PNByViewed 		= new \MVC\Domain\PageNavigation($Category->getBookAll()->count(), 8, $Category->getURLView()."/orderbyviewed" );
			$PNByLiked 			= new \MVC\Domain\PageNavigation($Category->getBookAll()->count(), 8, $Category->getURLView()."/orderbyliked" );
			$PNByRecent			= new \MVC\Domain\PageNavigation($Category->getBookAll()->count(), 8, $Category->getURLView()."/orderbyrecent");
			
			$CategoryBookAll 	= $mCategoryBook->findAll();
			$CategoryPostAll 	= $mCategoryPost->findAll();
			$CategoryVideoAll 	= $mCategoryVideo->findAll();
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("Category", 			$Category);
			$request->setObject("BookOrderByViewedAll", $BookOrderByViewedAll);
			$request->setObject("PNByViewed", 			$PNByViewed);
			
			$request->setObject("BookOrderByLikedAll", $BookOrderByLikedAll);
			$request->setObject("PNByLiked", 			$PNByLiked);
			
			$request->setObject("BookOrderByRecentAll", $BookOrderByRecentAll);
			$request->setObject("PNByRecent", 			$PNByRecent);
			
			$request->setProperty("Page", 				$Page);
			$request->setProperty("OrderBy", 			$OrderBy);
			
			$request->setObject("CategoryBookAll", 		$CategoryBookAll);
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);
			$request->setObject("CategoryVideoAll", 	$CategoryVideoAll);								
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
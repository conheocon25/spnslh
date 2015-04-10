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
			$KBuddha 	= $request->getProperty('KBuddha');
			$KCategory 	= $request->getProperty('KCategory');
			$Page 		= $request->getProperty('Page');
			$OrderBy 	= $request->getProperty('OrderBy');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mConfig 		= new \MVC\Mapper\Config();
			$mVideo 		= new \MVC\Mapper\Video();
						
			$mCategoryPost 		= new \MVC\Mapper\CategoryPost();
			$mCategoryBuddha	= new \MVC\Mapper\CategoryBuddha();
			$mCategoryVideo		= new \MVC\Mapper\CategoryVideo();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------											
			$Buddha 			= $mCategoryBuddha->findByKey($KBuddha);
			$Category 			= $mCategoryVideo->findByKey($KCategory);
						
			if (!isset($Page)) $Page = 1;
			$VideoOrderViewedAll 	= $mVideo->findByOrderViewedPage(array($Category->getId(), $Page, 24));
			$VideoOrderLikedAll 	= $mVideo->findByOrderLikedPage(array($Category->getId(), $Page, 24));
			$VideoOrderNameAll 		= $mVideo->findByOrderNamePage(array($Category->getId(), $Page, 24));
			
			$PNByViewed	= new \MVC\Domain\PageNavigation($Category->getVideoAll()->count(), 24, $Category->getURLView()."/orderbyviewed" );
			$PNByLiked	= new \MVC\Domain\PageNavigation($Category->getVideoAll()->count(), 24, $Category->getURLView()."/orderbyliked" );
			$PNByName	= new \MVC\Domain\PageNavigation($Category->getVideoAll()->count(), 24, $Category->getURLView()."/orderbyname" );
			
			$CategoryPostAll 	= $mCategoryPost->findAll();
			$CategoryVideoAll 	= $mCategoryVideo->findAll();
			$CategoryBuddhaAll 	= $mCategoryBuddha->findAll();
			
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("PNByViewed", 			$PNByViewed);
			$request->setObject("PNByLiked", 			$PNByLiked);
			$request->setObject("PNByName", 			$PNByName);
			$request->setProperty("Page", 				$Page);
			$request->setProperty("OrderBy", 			$OrderBy);
			
			$request->setObject("VideoOrderViewedAll", 	$VideoOrderViewedAll);
			$request->setObject("VideoOrderLikedAll", 	$VideoOrderLikedAll);
			$request->setObject("VideoOrderNameAll", 	$VideoOrderNameAll);
			
			$request->setObject("Buddha", 				$Buddha);
			$request->setObject("Category", 			$Category);
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);
			$request->setObject("CategoryVideoAll", 	$CategoryVideoAll);
			$request->setObject("CategoryBuddhaAll", 	$CategoryBuddhaAll);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
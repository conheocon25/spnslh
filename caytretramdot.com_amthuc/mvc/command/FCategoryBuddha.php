<?php
	namespace MVC\Command;	
	class FCategoryBuddha extends Command {
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
			$Page 		= $request->getProperty('Page');
			$OrderBy 	= $request->getProperty('OrderBy');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mConfig 		= new \MVC\Mapper\Config();
									
			$mCategoryPost 		= new \MVC\Mapper\CategoryPost();
			$mCategoryBuddha	= new \MVC\Mapper\CategoryBuddha();
			$mCategoryVideo		= new \MVC\Mapper\CategoryVideo();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------											
			$Buddha 			= $mCategoryBuddha->findByKey($KBuddha);
			
			if (!isset($Page)) $Page = 1;
			$CategoryVideoOrderNameAll 	= $mCategoryVideo->findByOrderNamePage(array($Buddha->getId(), $Page, 8));
			$CategoryVideoOrderVideoAll = $mCategoryVideo->findByOrderVideoPage(array($Buddha->getId(), $Page, 8));
			
			$PNByName 			= new \MVC\Domain\PageNavigation($Buddha->getCategoryAll()->count(), 8, $Buddha->getURLView()."/orderbyname" );
			$PNByVideo 			= new \MVC\Domain\PageNavigation($Buddha->getCategoryAll()->count(), 8, $Buddha->getURLView()."/orderbyvideo");
			
			$CategoryPostAll 	= $mCategoryPost->findAll();
			$CategoryBuddhaAll 	= $mCategoryBuddha->findAll();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("PNByName", 			$PNByName);
			$request->setObject("PNByVideo", 			$PNByVideo);
			$request->setProperty("Page", 				$Page);
			$request->setProperty("OrderBy", 			$OrderBy);
									
			$request->setObject("Buddha", 				$Buddha);			
			$request->setObject("CategoryBuddhaAll", 	$CategoryBuddhaAll);
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);
			
			$request->setObject("CategoryVideoOrderNameAll", 	$CategoryVideoOrderNameAll);
			$request->setObject("CategoryVideoOrderVideoAll", 	$CategoryVideoOrderVideoAll);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
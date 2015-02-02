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
			$CategoryVideoAll 	= $mCategoryVideo->findByPage(array($Buddha->getId(), $Page, 8));
			$PN 				= new \MVC\Domain\PageNavigation($Buddha->getCategoryAll()->count(), 8, $Buddha->getURLView() );
			
			$CategoryPostAll 	= $mCategoryPost->findAll();
			$CategoryBuddhaAll 	= $mCategoryBuddha->findAll();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("PN", 					$PN);
			$request->setProperty("Page", 				$Page);
									
			$request->setObject("Buddha", 				$Buddha);			
			$request->setObject("CategoryBuddhaAll", 	$CategoryBuddhaAll);
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);
			$request->setObject("CategoryVideoAll", 	$CategoryVideoAll);								
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
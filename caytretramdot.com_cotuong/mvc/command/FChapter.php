<?php
	namespace MVC\Command;	
	class FChapter extends Command {
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
			$KBook 		= $request->getProperty('KBook');
			$KChapter	= $request->getProperty('KChapter');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mConfig 		= new \MVC\Mapper\Config();
			$mPost 			= new \MVC\Mapper\Post();
			$mBook 			= new \MVC\Mapper\Book();
			$mChapter 		= new \MVC\Mapper\Chapter();
			
			$mCategoryPost 	= new \MVC\Mapper\CategoryPost();
			$mCategoryBook 	= new \MVC\Mapper\CategoryBook();
			$mCategoryVideo	= new \MVC\Mapper\CategoryVideo();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------											
			$PostTop 			= $mPost->findByTop(array())->current();
			$Book 				= $mBook->findByKey($KBook);
			$Category 			= $Book->getCategory();
			$Chapter 			= $mChapter->findByKey($KChapter);
						
			$CategoryPostAll 	= $mCategoryPost->findAll();
			$CategoryBookAll 	= $mCategoryBook->findAll();
			$CategoryVideoAll 	= $mCategoryVideo->findAll();
															
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("URLShare", 			$Book->getURLViewFull());
			$request->setObject("PostTop", 				$PostTop);
			$request->setObject("Category", 			$Category);
			$request->setObject("Book", 				$Book);
			$request->setObject("Chapter", 				$Chapter);
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);
			$request->setObject("CategoryBookAll", 		$CategoryBookAll);
			$request->setObject("CategoryVideoAll", 	$CategoryVideoAll);						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
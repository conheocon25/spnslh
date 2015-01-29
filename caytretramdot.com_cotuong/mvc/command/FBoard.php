<?php
	namespace MVC\Command;	
	class FBoard extends Command {
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
			$KChapter 	= $request->getProperty('KChapter');
			$KBoard 	= $request->getProperty('KBoard');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mConfig 		= new \MVC\Mapper\Config();			
			$mCategoryBook 	= new \MVC\Mapper\CategoryBook();
			$mCategoryPost 	= new \MVC\Mapper\CategoryPost();
			$mBook	 		= new \MVC\Mapper\Book();
			$mChapter 		= new \MVC\Mapper\Chapter();
			$mBoard 		= new \MVC\Mapper\Board();
												
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$CategoryBookAll 	= $mCategoryBook->findAll();
			$CategoryPostAll 	= $mCategoryPost->findAll();
			$Category 			= $mCategoryBook->findByKey($KBoard);
			$Book 				= $mBook->findByKey($KBook);
			$Chapter 			= $mChapter->findByKey($KChapter);
			$Board 				= $mBoard->findByKey($KBoard);
			
			$Board->setViewed($Board->getViewed()+1);
			$mBoard->update($Board);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);			
			$request->setObject("CategoryBookAll", 		$CategoryBookAll);
						
			$request->setObject('Category', 			$Category);
			$request->setObject('Book', 				$Book);
			$request->setObject('Chapter', 				$Chapter);
			$request->setObject('Board', 				$Board);
		}
	}
?>
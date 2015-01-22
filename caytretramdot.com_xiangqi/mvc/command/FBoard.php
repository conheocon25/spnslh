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
			$mCategoryBoard = new \MVC\Mapper\CategoryBoard();
			$mCategoryBook 	= new \MVC\Mapper\CategoryBook();
			$mCategoryPost 	= new \MVC\Mapper\CategoryPost();
			$mBook	 		= new \MVC\Mapper\Book();
			$mChapter 		= new \MVC\Mapper\Chapter();
			$mBoard 		= new \MVC\Mapper\Board();
												
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$CategoryBoardAll 	= $mCategoryBoard->findAll();
			$CategoryBookAll 	= $mCategoryBook->findAll();
			$CategoryPostAll 	= $mCategoryPost->findAll();
			$Category 			= $mCategoryBoard->findByKey($KBoard);
			$Book 				= $mBook->findByKey($KBook);
			$Chapter 			= $mBook->findByKey($KChapter);
			$Board 				= $mBoard->findByKey($KBoard);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);
			$request->setObject("CategoryBoardAll", 	$CategoryBoardAll);
			$request->setObject("CategoryBookAll", 		$CategoryBookAll);
						
			$request->setObject('Category', 			$Category);
			$request->setObject('Book', 				$Book);
			$request->setObject('Chapter', 				$Chapter);
			$request->setObject('Board', 				$Board);
		}
	}
?>
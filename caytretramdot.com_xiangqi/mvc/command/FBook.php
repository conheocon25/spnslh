<?php
	namespace MVC\Command;	
	class FBook extends Command {
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
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mConfig 		= new \MVC\Mapper\Config();
			$mBook 			= new \MVC\Mapper\Book();
			$mCategoryBoard = new \MVC\Mapper\CategoryBoard();
			$mCategoryPost 	= new \MVC\Mapper\CategoryPost();
			$mCategoryBook 	= new \MVC\Mapper\CategoryBook();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------											
			$Book 				= $mBook->findByKey($KBook);
			$Category 			= $Book->getCategory();
			$Book->setViewed($Book->getViewed() + 1);
			$mBook->update($Book);
			
			$CategoryPostAll 	= $mCategoryPost->findAll();
			$CategoryBookAll 	= $mCategoryBook->findAll();
			$CategoryBoardAll 	= $mCategoryBoard->findAll();
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("URLShare", 			$Book->getURLViewFull());
			$request->setObject("Category", 			$Category);
			$request->setObject("Book", 				$Book);
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);
			$request->setObject("CategoryBookAll", 		$CategoryBookAll);
			$request->setObject("CategoryBoardAll", 	$CategoryBoardAll);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
<?php
	namespace MVC\Command;	
	class FPostDetail extends Command {
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
			$KPost 		= $request->getProperty('KPost');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mConfig 		= new \MVC\Mapper\Config();
			$mPost 			= new \MVC\Mapper\Post();
			$mCategoryBoard = new \MVC\Mapper\CategoryBoard();
			$mCategoryBook 	= new \MVC\Mapper\CategoryBook();
			$mCategoryPost 	= new \MVC\Mapper\CategoryPost();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------											
			$Post 				= $mPost->findByKey($KPost);			
			$CategoryPostAll 	= $mCategoryPost->findAll();
			$CategoryBookAll 	= $mCategoryBook->findAll();
			$CategoryBoardAll 	= $mCategoryBoard->findAll();
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("URLShare", 			'abc');			
			$request->setObject("Post", 				$Post);			
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);
			$request->setObject("CategoryBookAll", 		$CategoryBookAll);
			$request->setObject("CategoryBoardAll", 	$CategoryBoardAll);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
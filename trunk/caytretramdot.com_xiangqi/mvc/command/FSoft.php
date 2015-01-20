<?php
	namespace MVC\Command;	
	class FSoft extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mConfig 		= new \MVC\Mapper\Config();						
			$mCategoryPost 	= new \MVC\Mapper\CategoryPost();
			$mCategoryBoard = new \MVC\Mapper\CategoryBoard();
			$mCategoryBook 	= new \MVC\Mapper\CategoryBook();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------											
			$CategoryPostAll 	= $mCategoryPost->findAll();
			$CategoryBoardAll 	= $mCategoryBoard->findAll();
			$CategoryBookAll 	= $mCategoryBook->findAll();
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Active", 'Tool');
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);
			$request->setObject("CategoryBoardAll", 	$CategoryBoardAll);
			$request->setObject("CategoryBookAll", 		$CategoryBookAll);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
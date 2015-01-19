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
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mConfig 		= new \MVC\Mapper\Config();
			$mCategoryBoard = new \MVC\Mapper\CategoryBoard();
			$mCategoryPost 	= new \MVC\Mapper\CategoryPost();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------											
			$CategoryPostAll 	= $mCategoryPost->findAll();
			$CategoryBoardAll 	= $mCategoryBoard->findAll();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject('CategoryBoardAll', $CategoryBoardAll);
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
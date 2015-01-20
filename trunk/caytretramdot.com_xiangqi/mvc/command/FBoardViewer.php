<?php
	namespace MVC\Command;	
	class FBoardViewer extends Command {
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
			$KBoard 	= $request->getProperty('KBoard');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mConfig 		= new \MVC\Mapper\Config();
			$mCategoryBoard = new \MVC\Mapper\CategoryBoard();
			$mCategoryBook 	= new \MVC\Mapper\CategoryBook();
			$mCategoryPost 	= new \MVC\Mapper\CategoryPost();
			$mCBM 			= new \MVC\Mapper\CBM();
												
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$CategoryBoardAll 	= $mCategoryBoard->findAll();
			$CategoryBookAll 	= $mCategoryBook->findAll();
			$CategoryPostAll 	= $mCategoryPost->findAll();
			$Category 			= $mCategoryBoard->findByKey($KBoard);
			$CBM 				= $mCBM->findByKey($KBoard);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject('CBM', 					$CBM);
			$request->setObject('Category', 			$Category);
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);
			$request->setObject("CategoryBoardAll", 	$CategoryBoardAll);
			$request->setObject("CategoryBookAll", 		$CategoryBookAll);
			
			return self::statuses('CMD_DEFAULT');
			
		}
	}
?>
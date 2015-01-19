<?php
	namespace MVC\Command;	
	class FBoardDetail extends Command {
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
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mConfig 		= new \MVC\Mapper\Config();
			$mCategoryBoard = new \MVC\Mapper\CategoryBoard();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------											
			$CategoryBoardAll 	= $mCategoryBoard->findAll();
			$Category 			= $mCategoryBoard->findByKey($KCategory);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject('Category'			, $Category);
			$request->setObject('CategoryBoardAll'	, $CategoryBoardAll);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
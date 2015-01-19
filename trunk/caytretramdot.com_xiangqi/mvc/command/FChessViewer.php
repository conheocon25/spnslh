<?php
	namespace MVC\Command;	
	class FChessViewer extends Command {
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
			$mCBM 			= new \MVC\Mapper\CBM();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Category 	= $mCategoryBoard->findByKey($KBoard);
			$CBM 		= $mCBM->findByKey($KBoard);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject('CBM'		, $CBM);
			$request->setObject('Category'	, $Category);
			return self::statuses('CMD_DEFAULT');
			
		}
	}
?>
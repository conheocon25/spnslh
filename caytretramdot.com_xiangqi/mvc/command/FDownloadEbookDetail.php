<?php
	namespace MVC\Command;	
	class FDownloadEbookDetail extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$KCategory = $request->getProperty('KCategory');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mConfig 		= new \MVC\Mapper\Config();
			$mCategoryBook 	= new \MVC\Mapper\CategoryBook();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------											
			$Category 		= $mCategoryBook->findByKey($KCategory);
			$CategoryAll 	= $mCategoryBook->findAll();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("Category", $Category);
			$request->setObject("CategoryAll", $CategoryAll);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
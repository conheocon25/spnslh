<?php
	namespace MVC\Command;	
	class FHome extends Command {
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
			$mCategoryPost	= new \MVC\Mapper\CategoryPost();			
			$mCategoryBook	= new \MVC\Mapper\CategoryBook();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------											
			$CategoryPostAll 	= $mCategoryPost->findAll();			
			$CategoryBookAll 	= $mCategoryBook->findAll();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Active", 			'Home');
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);			
			$request->setObject("CategoryBookAll", 		$CategoryBookAll);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
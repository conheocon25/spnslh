<?php
	namespace MVC\Command;	
	class FLinked extends Command{
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
			$mCategoryBook 	= new \MVC\Mapper\CategoryBook();			
			$mCategoryPost 	= new \MVC\Mapper\CategoryPost();
			$mCategoryVideo	= new \MVC\Mapper\CategoryVideo();
			$mLinked 		= new \MVC\Mapper\Linked();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$LinkedAll 			= $mLinked->findAll();
			
			$CategoryBookAll 	= $mCategoryBook->findAll();
			$CategoryPostAll 	= $mCategoryPost->findAll();
			$CategoryVideoAll 	= $mCategoryVideo->findAll();
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setObject("LinkedAll", 			$LinkedAll);
			$request->setObject("CategoryBookAll", 		$CategoryBookAll);
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);
			$request->setObject("CategoryVideoAll", 	$CategoryVideoAll);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
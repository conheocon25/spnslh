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
			$mVideo 		= new \MVC\Mapper\Video();												
			$mPost 			= new \MVC\Mapper\Post();
			
			$mCategoryPost	= new \MVC\Mapper\CategoryPost();						
			$mCategoryVideo	= new \MVC\Mapper\CategoryVideo();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------											
			$VideoTopAll 		= $mVideo->findByTop(array());			
			$PostTopAll 		= $mPost->findByTop(array());
			
			$CategoryPostAll 	= $mCategoryPost->findAll();			
			$CategoryVideoAll 	= $mCategoryVideo->findAll();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Active", 			'Home');
			$request->setObject("VideoTopAll", 			$VideoTopAll);			
			$request->setObject("PostTopAll", 			$PostTopAll);
			
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);			
			$request->setObject("CategoryVideoAll", 	$CategoryVideoAll);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
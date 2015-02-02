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
			$mConfig 			= new \MVC\Mapper\Config();
			$mCategoryBuddha	= new \MVC\Mapper\CategoryBuddha();
			$mPost 				= new \MVC\Mapper\Post();
			
			$mCategoryPost		= new \MVC\Mapper\CategoryPost();
			$mCategoryBuddha	= new \MVC\Mapper\CategoryBuddha();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$PostTopAll 		= $mPost->findByTop(array());
			
			$CategoryPostAll 	= $mCategoryPost->findAll();			
			$CategoryBuddhaAll 	= $mCategoryBuddha->findAll();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Active", 			'Home');			
			$request->setObject("PostTopAll", 			$PostTopAll);
			
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);			
			$request->setObject("CategoryBuddhaAll", 	$CategoryBuddhaAll);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
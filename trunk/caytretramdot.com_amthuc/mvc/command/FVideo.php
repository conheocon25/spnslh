<?php
	namespace MVC\Command;	
	class FVideo extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$KBuddha 	= $request->getProperty('KBuddha');
			$KCategory 	= $request->getProperty('KCategory');
			$KVideo 	= $request->getProperty('KVideo');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mConfig 		= new \MVC\Mapper\Config();
			$mVideo			= new \MVC\Mapper\Video();			
			
			$mCategoryPost 	= new \MVC\Mapper\CategoryPost();
			$mCategoryBuddha= new \MVC\Mapper\CategoryBuddha();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------											
			$Video 				= $mVideo->findByKey($KVideo);
						
			$CategoryPostAll 	= $mCategoryPost->findAll();			
			$CategoryBuddhaAll 	= $mCategoryBuddha->findAll();
															
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("URLShare", 			$Video->getURLView());
			$request->setObject("Video", 				$Video);			
			$request->setObject("Category", 			$Video->getCategory());
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);			
			$request->setObject("CategoryBuddhaAll", 	$CategoryBuddhaAll);
									
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
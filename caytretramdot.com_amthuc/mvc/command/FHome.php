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
			$mPresentation 		= new \MVC\Mapper\Presentation();
			
			$mCategoryPost		= new \MVC\Mapper\CategoryPost();
			$mCategoryBuddha	= new \MVC\Mapper\CategoryBuddha();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$ConfigPHome 		= $mConfig->findByName("PRESENTATION_HOME");
			
			$CategoryPostAll 	= $mCategoryPost->findAll();
			$CategoryBuddhaAll 	= $mCategoryBuddha->findAll();
			
			$Presentation 		= $mPresentation->find($ConfigPHome->getValue());
			
			$PostLastest		= $mPost->findByLastest(array());
			$PostPopular		= $mPost->findByPopular(array());
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Active", 			'Home');
			
			$request->setObject("ConfigPHome", 			$ConfigPHome);
			$request->setObject("Presentation", 		$Presentation);
			
			$request->setObject("PostLastest", 			$PostLastest);
			$request->setObject("PostPopular", 			$PostPopular);
			
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);
			$request->setObject("CategoryBuddhaAll", 	$CategoryBuddhaAll);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
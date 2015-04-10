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
			$mPost 				= new \MVC\Mapper\Post();
			$mPresentation 		= new \MVC\Mapper\Presentation();			
			$mCategoryPost		= new \MVC\Mapper\CategoryPost();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$ConfigPHome 		= $mConfig->findByName("PRESENTATION_HOME");
			
			$CategoryPostAll 	= $mCategoryPost->findAll();						
			$Presentation 		= $mPresentation->find($ConfigPHome->getValue());
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Active", 			'Home');
			
			$request->setObject("ConfigPHome", 			$ConfigPHome);
			$request->setObject("Presentation", 		$Presentation);
						
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);
									
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
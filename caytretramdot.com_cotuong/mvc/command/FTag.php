<?php
	namespace MVC\Command;	
	class FTag extends Command {
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
			$mTag 			= new \MVC\Mapper\Tag();												
			$mPresentation 	= new \MVC\Mapper\Presentation();
			$mCategoryPost	= new \MVC\Mapper\CategoryPost();			
			$mCategoryBook	= new \MVC\Mapper\CategoryBook();
			$mCategoryVideo	= new \MVC\Mapper\CategoryVideo();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$ConfigPHome 		= $mConfig->findByName("PRESENTATION_HOME");
			$Presentation 		= $mPresentation->find($ConfigPHome->getValue());
			$TagAll				= $mTag->findAll();

			$CategoryPostAll 	= $mCategoryPost->findAll();
			$CategoryBookAll 	= $mCategoryBook->findAll();
			$CategoryVideoAll 	= $mCategoryVideo->findAll();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Active", 			'Tag');
			
			$request->setObject("Presentation", 		$Presentation);
			$request->setObject("TagAll", 				$TagAll);
			
			$request->setObject("CategoryPostAll", 		$CategoryPostAll);
			$request->setObject("CategoryBookAll", 		$CategoryBookAll);
			$request->setObject("CategoryVideoAll", 	$CategoryVideoAll);
									
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
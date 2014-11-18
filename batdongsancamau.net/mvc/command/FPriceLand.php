<?php
	namespace MVC\Command;	
	class FPriceLand extends Command {
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
			$mConfig 	= new \MVC\Mapper\Config();
			$mCategory 	= new \MVC\Mapper\Category();
			$mPost	 	= new \MVC\Mapper\Post();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$ConfigName 			= $mConfig->findByName("NAME");
			$ConfigSlogan 			= $mConfig->findByName("SLOGAN");			
			$ConfigPhone1 			= $mConfig->findByName("PHONE1");
			$ConfigPhone2 			= $mConfig->findByName("PHONE2");
			$ConfigGmail 			= $mConfig->findByName("CONTACT_GTALK");
			$ConfigSkype 			= $mConfig->findByName("CONTACT_SKYPE");
			$ConfigIntro 			= $mConfig->findByName("POST_PRICE_LAND");
			
			$CategoryAll 			= $mCategory->findAll();			
			$Post 					= $mPost->find($ConfigIntro->getValue() );
			$Post->setViewed($Post->getViewed()+1);
			$mPost->update($Post);
									
			$Title = "BẢNG GIÁ ĐẤT";
			$Navigation = array();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Title", 				$Title);
			$request->setProperty("Active", 			'Price');
			$request->setObject("Navigation", 			$Navigation);
			$request->setObject("ConfigName", 			$ConfigName);
			$request->setObject("ConfigSlogan", 		$ConfigSlogan);
			$request->setObject("ConfigPhone1", 		$ConfigPhone1);
			$request->setObject("ConfigPhone2", 		$ConfigPhone2);
			$request->setObject("ConfigGmail", 			$ConfigGmail);
			$request->setObject("ConfigSkype", 			$ConfigSkype);
						
			$request->setObject("Post", 				$Post);			
			$request->setObject("CategoryAll", 			$CategoryAll);
												
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
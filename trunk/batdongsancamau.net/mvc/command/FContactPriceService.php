<?php
	namespace MVC\Command;	
	class FContactPriceService extends Command {
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
			$mCategory1	= new \MVC\Mapper\Category1();
			$mPost	 	= new \MVC\Mapper\Post();
			$mProvince	= new \MVC\Mapper\Province();
			$mEstate	= new \MVC\Mapper\TypeEstate();
			$mTag		= new \MVC\Mapper\Tag();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$ConfigName 			= $mConfig->findByName("NAME");
			$ConfigContact 			= $mConfig->findByName("CONTACT_NAME");
			$ConfigSlogan 			= $mConfig->findByName("SLOGAN");			
			$ConfigPhone1 			= $mConfig->findByName("PHONE1");
			$ConfigPhone2 			= $mConfig->findByName("PHONE2");
			$ConfigGmail 			= $mConfig->findByName("CONTACT_GTALK");
			$ConfigSkype 			= $mConfig->findByName("CONTACT_SKYPE");
			$ConfigIntro 			= $mConfig->findByName("POST_PRICE_SERVICE");
			
			$EstateAll 				= $mEstate->findAll();
			$Province 				= $mProvince->find(15);
			$TagAll 				= $mTag->findByPosition(array(1));
			
			$CategoryAll 			= $mCategory->findAll();			
			$CategoryAll1 			= $mCategory1->findAll();			
			$Post 					= $mPost->find($ConfigIntro->getValue() );
			$Post->setViewed($Post->getViewed()+1);
			$mPost->update($Post);
									
			$Title = "BẢNG GIÁ DỊCH VỤ";
			$Navigation = array();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Title", 				$Title);
			$request->setProperty("Active", 			'Contact');
			$request->setObject("Navigation", 			$Navigation);
			$request->setObject("ConfigName", 			$ConfigName);
			$request->setObject("ConfigContact", 		$ConfigContact);
			$request->setObject("ConfigSlogan", 		$ConfigSlogan);
			$request->setObject("ConfigPhone1", 		$ConfigPhone1);
			$request->setObject("ConfigPhone2", 		$ConfigPhone2);
			$request->setObject("ConfigGmail", 			$ConfigGmail);
			$request->setObject("ConfigSkype", 			$ConfigSkype);
						
			$request->setObject("Post", 				$Post);			
			$request->setObject("TagAll", 				$TagAll);			
			$request->setObject("CategoryAll", 			$CategoryAll);			
			$request->setObject("CategoryAll1", 		$CategoryAll1);			
			$request->setObject("EstateAll", 			$EstateAll);
			$request->setObject("Province", 			$Province);
												
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
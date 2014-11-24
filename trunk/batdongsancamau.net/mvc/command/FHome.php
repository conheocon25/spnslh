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
			$mCategory 		= new \MVC\Mapper\Category();
			$mCategory1 	= new \MVC\Mapper\Category1();						
			$mProvince		= new \MVC\Mapper\Province();
			$mEstate		= new \MVC\Mapper\TypeEstate();
			$mTag 			= new \MVC\Mapper\Tag();
			$mPost 			= new \MVC\Mapper\Post();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$ConfigName 	= $mConfig->findByName("NAME");
			$ConfigSlogan 	= $mConfig->findByName("SLOGAN");
			$ConfigContact 	= $mConfig->findByName("CONTACT_NAME");
			$ConfigPHome 	= $mConfig->findByName("PRESENTATION_HOME");
			$ConfigPhone1 	= $mConfig->findByName("PHONE1");
			$ConfigPhone2 	= $mConfig->findByName("PHONE2");
			$ConfigGmail 	= $mConfig->findByName("CONTACT_GTALK");
			$ConfigSkype 	= $mConfig->findByName("CONTACT_SKYPE");
			
			$EstateAll 		= $mEstate->findAll();
			$CategoryAll 	= $mCategory->findAll();
			$CategoryAll1 	= $mCategory1->findAll();
			$Province		= $mProvince->find(15);
			$TagAll 		= $mTag->findByPosition(array(1));
			$PostTopAll 	= $mPost->findByTop(array());
			
			$Title 			= "";
			$Navigation = array();
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Active", 			'Home');
			$request->setProperty("Title", 				$Title);
			$request->setObject("Navigation", 			$Navigation);
			$request->setObject("ConfigName", 			$ConfigName);
			$request->setObject("ConfigContact", 		$ConfigContact);
			$request->setObject("ConfigSlogan", 		$ConfigSlogan);
			$request->setObject("ConfigPhone1", 		$ConfigPhone1);
			$request->setObject("ConfigPhone2", 		$ConfigPhone2);
			$request->setObject("ConfigGmail", 			$ConfigGmail);
			$request->setObject("ConfigSkype", 			$ConfigSkype);
											
			$request->setObject("Province", 			$Province);
			$request->setObject("TagAll", 				$TagAll);
			$request->setObject("PostTopAll", 			$PostTopAll);
			$request->setObject("CategoryAll", 			$CategoryAll);
			$request->setObject("CategoryAll1", 		$CategoryAll1);
			$request->setObject("EstateAll", 			$EstateAll);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
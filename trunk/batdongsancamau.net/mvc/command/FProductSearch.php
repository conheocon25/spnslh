<?php
	namespace MVC\Command;	
	class FProductSearch extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdCategory 	= $request->getProperty('IdCategory');
			$IdEstate 		= $request->getProperty('IdEstate');
			$IdDistrict 	= $request->getProperty('IdDistrict');
			$IdDirection 	= $request->getProperty('IdDirection');
			$IdPrice 		= $request->getProperty('IdPrice');
			$IdArea 		= $request->getProperty('IdArea');
			$Page 			= $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mConfig 		= new \MVC\Mapper\Config();			
			$mCategory 		= new \MVC\Mapper\Category();
			$mCategory1		= new \MVC\Mapper\Category1();
			$mProvince		= new \MVC\Mapper\Province();
			$mEstate		= new \MVC\Mapper\TypeEstate();
			$mTag 			= new \MVC\Mapper\Tag();
			$mProduct 		= new \MVC\Mapper\Product();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$ConfigName 	= $mConfig->findByName("NAME");
			$ConfigSlogan 	= $mConfig->findByName("SLOGAN");
			$ConfigPHome 	= $mConfig->findByName("PRESENTATION_HOME");
			$ConfigPhone1 	= $mConfig->findByName("PHONE1");
			$ConfigPhone2 	= $mConfig->findByName("PHONE2");
			$ConfigGmail 	= $mConfig->findByName("CONTACT_GTALK");
			$ConfigSkype 	= $mConfig->findByName("CONTACT_SKYPE");
			
			if (!isset($Page)) $Page = 1;
			
			$ProductAll1	= $mProduct->search(array($IdCategory));
			$ProductAll 	= $mProduct->searchPage(array($IdCategory, $Page, 9));			
			$PN 			= new \MVC\Domain\PageNavigation($ProductAll1->count(), 9, "/tim-kiem");
			
			$EstateAll 		= $mEstate->findAll();
			$CategoryAll 	= $mCategory->findAll();
			$CategoryAll1 	= $mCategory1->findAll();
			$Province		= $mProvince->find(15);
			$TagAll 		= $mTag->findByPosition(array(1));
			
			$Title 			= "TÌM KIẾM";
			$Navigation 	= array();
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Active", 			'Home');
			$request->setProperty("Title", 				$Title);			
			$request->setObject("Navigation", 			$Navigation);
			$request->setObject("ConfigName", 			$ConfigName);
			$request->setObject("ConfigSlogan", 		$ConfigSlogan);
			$request->setObject("ConfigPhone1", 		$ConfigPhone1);
			$request->setObject("ConfigPhone2", 		$ConfigPhone2);
			$request->setObject("ConfigGmail", 			$ConfigGmail);
			$request->setObject("ConfigSkype", 			$ConfigSkype);
								
			$request->setProperty("Page", 				$Page);
			$request->setObject("ProductAll", 			$ProductAll);
			$request->setObject("PN", 					$PN);
			
			$request->setObject("Province", 			$Province);			
			$request->setObject("TagAll", 				$TagAll);
			$request->setObject("CategoryAll", 			$CategoryAll);
			$request->setObject("CategoryAll1", 		$CategoryAll1);
			$request->setObject("EstateAll", 			$EstateAll);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
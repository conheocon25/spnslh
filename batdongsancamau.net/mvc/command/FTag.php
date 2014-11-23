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
			$KTag 	= $request->getProperty('KTag');
			$Page 	= $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 	= new \MVC\Mapper\Config();
			$mCategory 	= new \MVC\Mapper\Category();
			$mCategory1	= new \MVC\Mapper\Category1();
			$mPostTag	= new \MVC\Mapper\PostTag();
			$mTag 		= new \MVC\Mapper\Tag();
			$mProvince 	= new \MVC\Mapper\Province();
			$mEstate 	= new \MVC\Mapper\TypeEstate();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$ConfigName 			= $mConfig->findByName("NAME");
			$ConfigContact 			= $mConfig->findByName("CONTACT_NAME");
			$ConfigSlogan 			= $mConfig->findByName("SLOGAN");
			$ConfigPHome 			= $mConfig->findByName("PRESENTATION_HOME");
			$ConfigPhone1 			= $mConfig->findByName("PHONE1");
			$ConfigPhone2 			= $mConfig->findByName("PHONE2");
			$ConfigGmail 			= $mConfig->findByName("CONTACT_GTALK");
			$ConfigSkype 			= $mConfig->findByName("CONTACT_SKYPE");
			
			$CategoryAll 			= $mCategory->findAll();			
			$CategoryAll1 			= $mCategory1->findAll();
			$EstateAll				= $mEstate->findAll();
			$Province				= $mProvince->find(15);
			
			if (!isset($Page)) $Page = 1;
			$TagAll 				= $mTag->findByPosition(array(1));
			$Tag 					= $mTag->findByKey($KTag);
			$PTAll 					= $mPostTag->findByTagPage(array($Tag->getId(), $Page, 6));
			$PN 					= new \MVC\Domain\PageNavigation($Tag->getPostAll()->count(), 6, $Tag->getURLView());
									
			$Title = mb_strtoupper($Tag->getName(), 'UTF8');
			$Navigation = array(
				array(mb_strtoupper('Tin tức', 'UTF8'), '/trang-chu')
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setProperty("Title", 				$Title);
			$request->setProperty("Active", 			'News');
			$request->setProperty("Page", 				$Page);
			$request->setObject("Navigation", 			$Navigation);
			
			$request->setObject("ConfigName", 			$ConfigName);
			$request->setObject("ConfigContact", 		$ConfigContact);
			$request->setObject("ConfigSlogan", 		$ConfigSlogan);
			$request->setObject("ConfigPhone1", 		$ConfigPhone1);
			$request->setObject("ConfigPhone2", 		$ConfigPhone2);
			$request->setObject("ConfigGmail", 			$ConfigGmail);
			$request->setObject("ConfigSkype", 			$ConfigSkype);
			
			$request->setObject("Province", 			$Province);
			$request->setObject("CategoryAll", 			$CategoryAll);
			$request->setObject("CategoryAll1", 		$CategoryAll1);
			$request->setObject("TagAll", 				$TagAll);
			$request->setObject("Tag", 					$Tag);
			$request->setObject("PTAll", 				$PTAll);
			$request->setObject("PN", 					$PN);
			$request->setObject("EstateAll", 			$EstateAll);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
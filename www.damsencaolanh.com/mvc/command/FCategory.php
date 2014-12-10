<?php
	namespace MVC\Command;	
	class FCategory extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$KCategory1 	= 	$request->getProperty('KCategory1');			
			$KCategory 		= 	$request->getProperty('KCategory');			
			$Page 			= 	$request->getProperty('Page');
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 		= new \MVC\Mapper\Config();
			$mCategory 		= new \MVC\Mapper\Category();
			$mCategory1 	= new \MVC\Mapper\Category1();
			$mTag			= new \MVC\Mapper\Tag();
			$mProduct		= new \MVC\Mapper\Product();
			$mBranch 		= new \MVC\Mapper\Branch();
			$mLinked		= new \MVC\Mapper\Linked();
			$mPresentation 	= new \MVC\Mapper\Presentation();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title = "";
			$ConfigName 	= $mConfig->findByName("NAME");
			$ConfigSlogan 	= $mConfig->findByName("SLOGAN");
			$ConfigGmail 	= $mConfig->findByName("CONTACT_GTALK");
			$ConfigSkype 	= $mConfig->findByName("CONTACT_SKYPE");
			$ConfigPhone1 	= $mConfig->findByName("PHONE1");
			$ConfigPhone2 	= $mConfig->findByName("PHONE2");
			$ConfigPHome 	= $mConfig->findByName("PRESENTATION_INTRO");
			$ConfigMarqueeWelcome	= $mConfig->findByName("MARQUEE_WELCOME");
			
			$Category 		= $mCategory->findByKey($KCategory);
			$Category1 		= $mCategory1->findByKey(array($Category->getId(), $KCategory1));
			$TagAll 		= $mTag->findByPosition(array(1));
			$BranchAll 		= $mBranch->findAll();
			$Presentation1 	= $mPresentation->find($ConfigPHome->getValue());

			if (!isset($Page)) $Page = 1;
			
			$LinkedAll 		= $mLinked->findByTop(array());
			
			$Title = mb_strtoupper($Category->getName(), 'UTF8');
			$Navigation = array(
				array(mb_strtoupper("Menu", 'UTF8'), "/")
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Title", 				$Title);			
			$request->setProperty("Active", 			"Menu");
			$request->setProperty("Page", 				$Page);
			$request->setObject("Navigation", 			$Navigation);
			
			$request->setObject("ConfigName", 			$ConfigName);			
			$request->setObject("ConfigSlogan", 		$ConfigSlogan);
			$request->setObject("ConfigGmail", 			$ConfigGmail);
			$request->setObject("ConfigSkype", 			$ConfigSkype);
			$request->setObject("ConfigPhone1", 		$ConfigPhone1);
			$request->setObject("ConfigPhone2", 		$ConfigPhone2);
			$request->setObject("ConfigMarqueeWelcome", $ConfigMarqueeWelcome);
			
			$request->setObject("Presentation1", 		$Presentation1);	
			$request->setObject("Category", 			$Category);
			$request->setObject("Category1", 			$Category1);
			$request->setObject("TagAll", 				$TagAll);
			$request->setObject("BranchAll", 			$BranchAll);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
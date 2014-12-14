<?php
	namespace MVC\Command;	
	class FProduct extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$KCategory 		= 	$request->getProperty('KCategory');
			$KProduct 		= 	$request->getProperty('KProduct');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 		= new \MVC\Mapper\Config();
			$mCategory 		= new \MVC\Mapper\Category();
			$mProduct 		= new \MVC\Mapper\Product();
			$mTag 			= new \MVC\Mapper\Tag();
			$mBranch 		= new \MVC\Mapper\Branch();
			$mLinked		= new \MVC\Mapper\Linked();
			$mPresentation	= new \MVC\Mapper\Presentation();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title 					= "";
			$ConfigName 			= $mConfig->findByName("NAME");
			$ConfigSlogan 			= $mConfig->findByName("SLOGAN");
			$ConfigPhone1 			= $mConfig->findByName("PHONE1");
			$ConfigPhone2 			= $mConfig->findByName("PHONE2");
			$ConfigGmail 			= $mConfig->findByName("CONTACT_GTALK");
			$ConfigSkype 			= $mConfig->findByName("CONTACT_SKYPE");
			$ConfigMenu 			= $mConfig->findByName("MENU_MAIN");
			$ConfigMarqueeWelcome	= $mConfig->findByName("MARQUEE_WELCOME");
			$ConfigPresentation 	= $mConfig->findByName("PRESENTATION_HOME");
			
			$Presentation1 			= $mPresentation->find($ConfigPresentation->getValue());
			$Category 				= $mCategory->find($ConfigMenu->getValue());
			$Product 				= $mProduct->findByKey($KProduct);
			$TagAll 				= $mTag->findByPosition(array(1));
			$BranchAll 				= $mBranch->findAll();						
			$LinkedAll 				= $mLinked->findByTop(array());
			$URLShare 				= "http://huongsenhong.com".$Product->getURLView();
			
			$Title = mb_strtoupper("Món Ăn",'UTF8');
			$Navigation = array(
				array(mb_strtoupper("Danh mục", 'UTF8'), "/")
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Title", 		$Title);
			$request->setProperty("Active", 	"Menu");
			$request->setProperty("URLShare", 	$URLShare);
			$request->setObject("Navigation", 	$Navigation);
			
			$request->setObject("ConfigName", 	$ConfigName);
			$request->setObject("ConfigSlogan", $ConfigSlogan);			
			$request->setObject("ConfigPhone1", $ConfigPhone1);
			$request->setObject("ConfigPhone2", $ConfigPhone2);
			$request->setObject("ConfigGmail", 	$ConfigGmail);
			$request->setObject("ConfigSkype", 	$ConfigSkype);
			$request->setObject("ConfigMarqueeWelcome", $ConfigMarqueeWelcome);
			
			$request->setObject("Presentation1", 	$Presentation1);
			$request->setObject("Category", 		$Category);
			$request->setObject("Product", 			$Product);
			$request->setObject("TagAll", 			$TagAll);
			$request->setObject("BranchAll", 		$BranchAll);
			$request->setObject("LinkedAll", 		$LinkedAll);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
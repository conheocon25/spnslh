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
			//$KCategory 		= 	$request->getProperty('KCategory');
			$KProduct 		= 	$request->getProperty('KProduct');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 		= new \MVC\Mapper\Config();
			$mCategory  	= new \MVC\Mapper\Category();			
			
			$mBranch		= new \MVC\Mapper\Branch();			
			$mProduct		= new \MVC\Mapper\Product();			
			$mLinked		= new \MVC\Mapper\Linked();			
			$mPostTag 		= new \MVC\Mapper\PostTag();
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title = "sdfsa sdfasdf";
			$ConfigName 			= $mConfig->findByName("NAME");
			$ConfigSlogan 			= $mConfig->findByName("SLOGAN");
			$ConfigGmail 			= $mConfig->findByName("CONTACT_GTALK");
			$ConfigSkype 			= $mConfig->findByName("CONTACT_SKYPE");
			$ConfigPhone1 			= $mConfig->findByName("PHONE1");
			$ConfigPhone2 			= $mConfig->findByName("PHONE2");
			$ConfigPHome 			= $mConfig->findByName("PRESENTATION_INTRO");
			$ConfigMarqueeWelcome	= $mConfig->findByName("MARQUEE_WELCOME");
			
			$BranchAll				= $mBranch->findAll();			
			$ProductAll 			= $mProduct->findByTop(array());			
			$LastestPostAll 		= $mPostTag->findByLastest4(array(null));
			
			$LinkedAll 				= $mLinked->findByTop(array());
			$DProduct 				= $mProduct->find($KProduct);
			
			$Title 					= mb_strtoupper($DProduct->getName(), 'UTF8');
			$Navigation = array(array(mb_strtoupper("Menu", 'UTF8'), "/"));
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Title", 				$Title);			
			$request->setProperty("Active", 			"Menu");
			//$request->setProperty("Page", 				$Page);
			$request->setObject("Navigation", 			$Navigation);
			
			$request->setObject("ConfigName", 			$ConfigName);			
			$request->setObject("ConfigSlogan", 		$ConfigSlogan);
			$request->setObject("ConfigGmail", 			$ConfigGmail);
			$request->setObject("ConfigSkype", 			$ConfigSkype);
			$request->setObject("ConfigPhone1", 		$ConfigPhone1);
			$request->setObject("ConfigPhone2", 		$ConfigPhone2);
			$request->setObject("ConfigMarqueeWelcome", $ConfigMarqueeWelcome);
			
			
			$request->setObject("DProduct", 			$DProduct);			
			$request->setObject("BranchAll", 			$BranchAll);			
			
			$request->setObject("ProductAll", 				$ProductAll);
			$request->setObject("LastestPostAll", 			$LastestPostAll);
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
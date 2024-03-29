<?php
	namespace MVC\Command;	
	class FIntroduction extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
			$DPackCart = $Session->getPackCart();							
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 	= new \MVC\Mapper\Config();
			$mCategory 	= new \MVC\Mapper\Category();
			$mTag 		= new \MVC\Mapper\Tag();
			
			$mBranch 	= new \MVC\Mapper\Branch();
			$mLinked		= new \MVC\Mapper\Linked();
			$mPostTag		= new \MVC\Mapper\PostTag();
			$mProduct 		= new \MVC\Mapper\Product();
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title 					= "";
			$ConfigName 			= $mConfig->findByName("NAME");
			$ConfigSlogan 			= $mConfig->findByName("SLOGAN");
			$ConfigContact 			= $mConfig->findByName("CONTACT_NAME");
			$ConfigAddress 			= $mConfig->findByName("ADDRESS");
			$ConfigPhone1 			= $mConfig->findByName("PHONE1");
			$ConfigPhone2 			= $mConfig->findByName("PHONE2");
			$ConfigGmail 			= $mConfig->findByName("CONTACT_GTALK");
			$ConfigSkype 			= $mConfig->findByName("CONTACT_SKYPE");
			$ConfigMenu 			= $mConfig->findByName("MENU_MAIN");
			$ConfigMarqueeWelcome	= $mConfig->findByName("MARQUEE_WELCOME");
			
			$Category 		= $mCategory->find($ConfigMenu->getValue());
			
			$TagAll 		= $mTag->findByPosition(array(1));
			$BranchAll 		= $mBranch->findAll();
			$LinkedAll 		= $mLinked->findByTop(array());
			$LastestPostAll = $mPostTag->findByLastest4(array(null));
			$ProductAll 	= $mProduct->findByTop(array());
			
			$Title = "LIÊN HỆ";
			$Navigation = array();
			
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Title", 				$Title);
			$request->setProperty("Active", 			'Contact');
			$request->setObject("Navigation", 			$Navigation);
			
			$request->setObject("ConfigName", 			$ConfigName);
			$request->setObject("ConfigSlogan", 		$ConfigSlogan);
			$request->setObject("ConfigContact", 		$ConfigContact);
			$request->setObject("ConfigAddress", 		$ConfigAddress);
			$request->setObject("ConfigPhone1", 		$ConfigPhone1);
			$request->setObject("ConfigPhone2", 		$ConfigPhone2);
			$request->setObject("ConfigGmail", 			$ConfigGmail);
			$request->setObject("ConfigSkype", 			$ConfigSkype);
			$request->setObject("ConfigMarqueeWelcome", $ConfigMarqueeWelcome);
			
			$request->setObject("Category", 			$Category);
			$request->setObject("TagAll", 				$TagAll);
			$request->setObject("BranchAll", 			$BranchAll);
			$request->setObject("LinkedAll", 			$LinkedAll);
			$request->setObject("LastestPostAll", 		$LastestPostAll);
			$request->setObject("ProductAll", 			$ProductAll);						
			$request->setObject("DPackCart", 			$DPackCart);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
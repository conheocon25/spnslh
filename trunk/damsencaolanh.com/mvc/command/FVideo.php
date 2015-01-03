<?php
	namespace MVC\Command;	
	class FVideo extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$Page 	= $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 		= new \MVC\Mapper\Config();
			$mCategory 		= new \MVC\Mapper\Category();
			$mVideo			= new \MVC\Mapper\Video();
			$mTag 			= new \MVC\Mapper\Tag();
			$mPostTag 		= new \MVC\Mapper\PostTag();
			$mBranch 		= new \MVC\Mapper\Branch();
			$mStoryLine		= new \MVC\Mapper\StoryLine();
			$mLinked		= new \MVC\Mapper\Linked();
			$mPresentation	= new \MVC\Mapper\Presentation();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$ConfigName 			= $mConfig->findByName("NAME");
			$ConfigSlogan 			= $mConfig->findByName("SLOGAN");
			$ConfigPIntro 			= $mConfig->findByName("PRESENTATION_INTRO");
			$ConfigPhone1 			= $mConfig->findByName("PHONE1");
			$ConfigPhone2 			= $mConfig->findByName("PHONE2");
			$ConfigGmail 			= $mConfig->findByName("CONTACT_GTALK");
			$ConfigSkype 			= $mConfig->findByName("CONTACT_SKYPE");
			$ConfigMenu 			= $mConfig->findByName("MENU_MAIN");
			$ConfigMarqueeWelcome	= $mConfig->findByName("MARQUEE_WELCOME");
			
			$Category 				= $mCategory->find($ConfigMenu->getValue());
			$BranchAll 				= $mBranch->findAll();
			$StoryLineAll			= $mStoryLine->findAll();
			
			if (!isset($Page)) $Page = 1;
			$TagAll 				= $mTag->findByPosition(array(1));			
			
			$VideoAll1 				= $mVideo->findAll();
			$VideoAll 				= $mVideo->findByPage(array($Page, 8));
			$PN 					= new \MVC\Domain\PageNavigation($VideoAll1->count(), 8, "/hinh-anh");
			
			$LastestPostAll 		= $mPostTag->findByLastest4(array(null));
			$LinkedAll 				= $mLinked->findByTop(array());
			
			$Presentation1 			= $mPresentation->find($ConfigPIntro->getValue());
			
			$Title = "VIDEO";
			$Navigation = array();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setProperty("Title", 				$Title);
			$request->setProperty("Active", 			'Video');
			$request->setProperty("Page", 				$Page);
			$request->setObject("Navigation", 			$Navigation);
			
			$request->setObject("ConfigName", 			$ConfigName);
			$request->setObject("ConfigSlogan", 		$ConfigSlogan);
			$request->setObject("ConfigPhone1", 		$ConfigPhone1);
			$request->setObject("ConfigPhone2", 		$ConfigPhone2);
			$request->setObject("ConfigGmail", 			$ConfigGmail);
			$request->setObject("ConfigSkype", 			$ConfigSkype);
			$request->setObject("ConfigMarqueeWelcome", $ConfigMarqueeWelcome);
	
			$request->setObject("Presentation1", 		$Presentation1);
			$request->setObject("BranchAll", 			$BranchAll);
			$request->setObject("Category", 			$Category);
			$request->setObject("TagAll", 				$TagAll);
			$request->setObject("VideoAll", 			$VideoAll);			
			$request->setObject("PN", 					$PN);
			
			$request->setObject("StoryLineAll", 		$StoryLineAll);
			$request->setObject("LastestPostAll", 		$LastestPostAll);
			$request->setObject("LinkedAll", 			$LinkedAll);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
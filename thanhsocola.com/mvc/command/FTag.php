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
			$mConfig 		= new \MVC\Mapper\Config();
			$mCategory 		= new \MVC\Mapper\Category();
			$mPostTag		= new \MVC\Mapper\PostTag();
			$mTag 			= new \MVC\Mapper\Tag();
			$mBranch 		= new \MVC\Mapper\Branch();
			$mStoryLine		= new \MVC\Mapper\StoryLine();
			$mLinked		= new \MVC\Mapper\Linked();
			$mPresentation 	= new \MVC\Mapper\Presentation();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$ConfigName 			= $mConfig->findByName("NAME");
			$ConfigSlogan 			= $mConfig->findByName("SLOGAN");
			$ConfigPHome 			= $mConfig->findByName("PRESENTATION_HOME");
			$ConfigPhone1 			= $mConfig->findByName("PHONE1");
			$ConfigPhone2 			= $mConfig->findByName("PHONE2");
			$ConfigGmail 			= $mConfig->findByName("CONTACT_GTALK");
			$ConfigSkype 			= $mConfig->findByName("CONTACT_SKYPE");
			$ConfigMenu 			= $mConfig->findByName("MENU_MAIN");
			$ConfigRowPerPage 		= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigMarqueeWelcome	= $mConfig->findByName("MARQUEE_WELCOME");
						
			$Presentation1 			= $mPresentation->find($ConfigPHome->getValue());
			$Category 				= $mCategory->find($ConfigMenu->getValue());
			$BranchAll 				= $mBranch->findAll();
			$StoryLineAll			= $mStoryLine->findAll();
			$LastestPostAll 		= $mPostTag->findByLastest4(array(null));
			
			if (!isset($Page)) $Page = 1;
			$TagAll 				= $mTag->findByPosition(array(1));
			$Tag 					= $mTag->findByKey($KTag);
			$PTAll 					= $mPostTag->findByTagPage(array($Tag->getId(), $Page, $ConfigRowPerPage->getValue() ));
			$PN 					= new \MVC\Domain\PageNavigation($Tag->getPostAll()->count(), $ConfigRowPerPage->getValue(), $Tag->getURLView());
			
			$LinkedAll 				= $mLinked->findByTop(array());
			
			$Title = mb_strtoupper('Tin Tức', 'UTF8');
			$Navigation = array();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setProperty("Title", 				$Title);
			$request->setProperty("Active", 			'News');
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
			$request->setObject("StoryLineAll", 		$StoryLineAll);
			$request->setObject("Category", 			$Category);
			$request->setObject("TagAll", 				$TagAll);
			$request->setObject("Tag", 					$Tag);
			$request->setObject("PTAll", 				$PTAll);
			$request->setObject("PN", 					$PN);
			$request->setObject("LinkedAll", 			$LinkedAll);
			$request->setObject("LastestPostAll", 		$LastestPostAll);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
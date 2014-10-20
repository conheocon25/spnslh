<?php
	namespace MVC\Command;	
	class FIntroduction extends Command {
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
			$mPost 		= new \MVC\Mapper\Post();
			$mPostTag	= new \MVC\Mapper\PostTag();
			$mTag 		= new \MVC\Mapper\Tag();
			$mBranch 	= new \MVC\Mapper\Branch();
			$mStoryLine	= new \MVC\Mapper\StoryLine();
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
			$ConfigIntro 			= $mConfig->findByName("POST_INTRODUCTION");
			
			$Category 				= $mCategory->find(1);
			$BranchAll 				= $mBranch->findAll();
			$TagAll 				= $mTag->findByPosition(array(1));
			$StoryLineAll			= $mStoryLine->findAll();
			$LastestPostAll 		= $mPostTag->findByLastest4(array(null));
			
			$Presentation1 			= $mPresentation->find($ConfigPHome->getValue());
			
			$Post 					= $mPost->find($ConfigIntro->getValue() );
			$Post->setViewed($Post->getViewed()+1);
			$mPost->update($Post);
						
			$Title = "GIỚI THIỆU";
			$Navigation = array();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Title", 				$Title);
			$request->setProperty("Active", 			'Introduction');
			$request->setObject("Navigation", 			$Navigation);
			$request->setObject("ConfigName", 			$ConfigName);
			$request->setObject("ConfigSlogan", 		$ConfigSlogan);
			$request->setObject("ConfigPhone1", 		$ConfigPhone1);
			$request->setObject("ConfigPhone2", 		$ConfigPhone2);
			$request->setObject("ConfigGmail", 			$ConfigGmail);
			$request->setObject("ConfigSkype", 			$ConfigSkype);
			
			$request->setObject("Presentation1", 		$Presentation1);
			$request->setObject("Post", 				$Post);
			$request->setObject("StoryLineAll", 		$StoryLineAll);
			$request->setObject("LastestPostAll", 		$LastestPostAll);
			$request->setObject("TagAll", 				$TagAll);
			$request->setObject("Category", 			$Category);
			$request->setObject("BranchAll", 			$BranchAll);
									
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
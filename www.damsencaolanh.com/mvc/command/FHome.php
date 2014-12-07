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
			$mAlbum 		= new \MVC\Mapper\Album();
			$mConfig 		= new \MVC\Mapper\Config();			
			$mCategory 		= new \MVC\Mapper\Category();
			$mProduct 		= new \MVC\Mapper\Product();
			$mPresentation 	= new \MVC\Mapper\Presentation();
			$mTag 			= new \MVC\Mapper\Tag();
			$mPostTag 		= new \MVC\Mapper\PostTag();						
			$mBranch		= new \MVC\Mapper\Branch();
			$mStoryLine		= new \MVC\Mapper\StoryLine();
			$mVideo			= new \MVC\Mapper\Video();
			$mLinked		= new \MVC\Mapper\Linked();
			
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
			
			$BranchAll		= $mBranch->findAll();
			$StoryLineAll	= $mStoryLine->findAll();
												
			$Category 		= $mCategory->find($ConfigMenu->getValue());
			$ProductAll 	= $mProduct->findByTop(array());			
			$Presentation1 	= $mPresentation->find($ConfigPHome->getValue());
			$Presentation2	= $mPresentation->find(3);
			
			$TagAll 		= $mTag->findByPosition(array(1));
			
			$LastestPostAll = $mPostTag->findByLastest4(array(null));
			$LastestAlbumAll= $mAlbum->findByLastest(array(null));
			$LastestVideoAll= $mVideo->findByLastest(array(null));
			
			$LinkedAll 		= $mLinked->findByTop(array());
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Active", 			'Home');
			$request->setObject("ConfigName", 			$ConfigName);
			$request->setObject("ConfigSlogan", 		$ConfigSlogan);
			$request->setObject("ConfigPhone1", 		$ConfigPhone1);
			$request->setObject("ConfigPhone2", 		$ConfigPhone2);
			$request->setObject("ConfigGmail", 			$ConfigGmail);
			$request->setObject("ConfigSkype", 			$ConfigSkype);
			$request->setObject("ConfigMenu", 			$ConfigMenu);
			
			$request->setObject("TagAll", 				$TagAll);
			$request->setObject("BranchAll", 			$BranchAll);
			$request->setObject("StoryLineAll", 		$StoryLineAll);
			
			$request->setObject("LastestPostAll", 		$LastestPostAll);			
			$request->setObject("LastestAlbumAll", 		$LastestAlbumAll);
			$request->setObject("LastestVideoAll", 		$LastestVideoAll);
						
			$request->setObject("Presentation1", 		$Presentation1);
			$request->setObject("Presentation2", 		$Presentation2);
			$request->setObject("Category", 			$Category);
			$request->setObject("ProductAll", 			$ProductAll);			
			$request->setObject("LinkedAll", 			$LinkedAll);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
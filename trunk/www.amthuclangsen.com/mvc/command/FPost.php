<?php
	namespace MVC\Command;	
	class FPost extends Command {
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
			$KPost 	= $request->getProperty('KPost');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 	= new \MVC\Mapper\Config();
			$mCategory 	= new \MVC\Mapper\Category();
			$mPost 		= new \MVC\Mapper\Post();
			$mPostTag 	= new \MVC\Mapper\PostTag();
			$mTag 		= new \MVC\Mapper\Tag();
			$mBranch 	= new \MVC\Mapper\Branch();
			$mStoryLine = new \MVC\Mapper\StoryLine();
			
			
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
			
			$CategoryAll 			= $mCategory->findAll();
			$BranchAll 				= $mBranch->findAll();
			$StoryLineAll	= $mStoryLine->findAll();
			
			$Post 					= $mPost->findByKey($KPost);
			$Tag 					= $mTag->findByKey($KTag);
			$TagAll 				= $mTag->findByPosition(array(1));
			
			$Post->setCount($Post->getCount()+1);
			$mPost->update($Post);
			
			$LastestPostAll = $mPostTag->findByLastest4(array(null));
			
			$Title = mb_strtoupper($Post->getTitle(), 'UTF8');
			$Navigation = array(
				array(mb_strtoupper($Tag->getName(), 'UTF8'), $Tag->getURLView())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Title", 				$Title);
			$request->setProperty("Active", 			'News');
			$request->setObject("Navigation", 			$Navigation);
			$request->setObject("ConfigName", 			$ConfigName);
			$request->setObject("ConfigSlogan", 		$ConfigSlogan);
			$request->setObject("ConfigPhone1", 		$ConfigPhone1);
			$request->setObject("ConfigPhone2", 		$ConfigPhone2);
			$request->setObject("ConfigGmail", 			$ConfigGmail);
			$request->setObject("ConfigSkype", 			$ConfigSkype);
			
			$request->setObject("Post", 				$Post);
			$request->setObject("CategoryAll", 			$CategoryAll);
			$request->setObject("BranchAll", 			$BranchAll);
			$request->setObject("StoryLineAll", 		$StoryLineAll);
			$request->setObject("LastestPostAll", 		$LastestPostAll);
			$request->setObject("TagAll", 				$TagAll);
			$request->setObject("Tag", 					$Tag);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
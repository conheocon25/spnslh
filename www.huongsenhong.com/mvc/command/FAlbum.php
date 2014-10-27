<?php
	namespace MVC\Command;	
	class FAlbum extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$KAlbum	= $request->getProperty('KAlbum');
			$Page 	= $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 	= new \MVC\Mapper\Config();
			$mCategory 	= new \MVC\Mapper\Category();
			$mAlbum		= new \MVC\Mapper\Album();
			$mTag 		= new \MVC\Mapper\Tag();
			$mPostTag 	= new \MVC\Mapper\PostTag();
			$mBranch 	= new \MVC\Mapper\Branch();
			$mStoryLine = new \MVC\Mapper\StoryLine();
			$mLinked	= new \MVC\Mapper\Linked();
			
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
			$StoryLineAll 			= $mStoryLine->findAll();
			
			if (!isset($Page)) $Page = 1;
			$TagAll 				= $mTag->findByPosition(array(1));			
			
			$AlbumAll1 				= $mAlbum->findAll();
			$AlbumAll 				= $mAlbum->findByPage(array($Page, 8));
			$PN 					= new \MVC\Domain\PageNavigation($AlbumAll1->count(), 8, "/hinh-anh");
			
			$LastestPostAll = $mPostTag->findByLastest4(array(null));
			$LinkedAll 		= $mLinked->findByTop(array());
			
			$Title = "HÌNH ẢNH";
			$Navigation = array();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setProperty("Title", 				$Title);
			$request->setProperty("Active", 			'Album');
			$request->setProperty("Page", 				$Page);
			$request->setObject("Navigation", 			$Navigation);
			
			$request->setObject("ConfigName", 			$ConfigName);
			$request->setObject("ConfigSlogan", 		$ConfigSlogan);
			$request->setObject("ConfigPhone1", 		$ConfigPhone1);
			$request->setObject("ConfigPhone2", 		$ConfigPhone2);
			$request->setObject("ConfigGmail", 			$ConfigGmail);
			$request->setObject("ConfigSkype", 			$ConfigSkype);
			
			$request->setObject("StoryLineAll", 		$StoryLineAll);
			$request->setObject("LastestPostAll", 		$LastestPostAll);
			$request->setObject("BranchAll", 			$BranchAll);
			$request->setObject("CategoryAll", 			$CategoryAll);
			$request->setObject("TagAll", 				$TagAll);
			$request->setObject("AlbumAll", 			$AlbumAll);
			$request->setObject("PN", 					$PN);
			$request->setObject("LinkedAll", 			$LinkedAll);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
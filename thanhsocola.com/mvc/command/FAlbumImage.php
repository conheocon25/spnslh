<?php
	namespace MVC\Command;	
	class FAlbumImage extends Command {
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
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$ConfigName 			= $mConfig->findByName("NAME");
			$ConfigSlogan 			= $mConfig->findByName("SLOGAN");
			$ConfigPHome 			= $mConfig->findByName("PRESENTATION_HOME");
			$ConfigPhone1 			= $mConfig->findByName("PHONE1");
			$ConfigPhone2 			= $mConfig->findByName("PHONE2");
			$ConfigGmail		 	= $mConfig->findByName("CONTACT_GTALK");
			$ConfigSkype 			= $mConfig->findByName("CONTACT_SKYPE");
			
			$CategoryAll 			= $mCategory->findAll();
			$BranchAll 				= $mBranch->findAll();
			$StoryLineAll 			= $mStoryLine->findAll();
			
			if (!isset($Page)) $Page = 1;
			$TagAll 				= $mTag->findByPosition(array(1));			
			
			$Album 	= $mAlbum->findByKey($KAlbum);
			$Album->setViewed( $Album->getViewed()+1 );
			$mAlbum->update($Album);
			
			$LastestPostAll = $mPostTag->findByLastest4(array(null));
									
			$Title = mb_strtoupper($Album->getName(), 'UTF8');
			$Navigation = array( array("HÌNH ẢNH", "/hinh-anh") );
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$request->setProperty("Title", 				$Title);
			$request->setProperty("Active", 			'Post');
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
			$request->setObject("Album", 				$Album);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
<?php
	namespace MVC\Command;	
	class FBookmark extends Command {
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
			$mConfig 		= new \MVC\Mapper\Config();			
			$mCategory 		= new \MVC\Mapper\Category();
			$mProduct 		= new \MVC\Mapper\Product();			
			$mTag 			= new \MVC\Mapper\Tag();						
			$mBranch		= new \MVC\Mapper\Branch();
			$mStoryLine		= new \MVC\Mapper\StoryLine();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$ConfigName 			= $mConfig->findByName("NAME");
			$ConfigSlogan 			= $mConfig->findByName("SLOGAN");
			$ConfigPHome 			= $mConfig->findByName("PRESENTATION_HOME");
			$ConfigPhone1 			= $mConfig->findByName("PHONE1");
			$ConfigPhone2 			= $mConfig->findByName("PHONE2");
			$ConfigYahooMessenger 	= $mConfig->findByName("CONTACT_YAHOOMESSENGER");
			$ConfigSkype 			= $mConfig->findByName("CONTACT_SKYPE");
			
			$BranchAll		= $mBranch->findAll();						
			$StoryLineAll	= $mStoryLine->findAll();
									
			$CategoryAll 	= $mCategory->findAll();			
			
			$TagAll 		= $mTag->findByPosition(array(1));
									
			$Title = "ĐÁNH DẤU";
			$Navigation = array(
				
			);
			
			$Cart = $Session->getBookmark();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Active", 			'Bookmark');
			$request->setProperty("Title", 				$Title);
			$request->setObject("ConfigName", 			$ConfigName);
			$request->setObject("ConfigSlogan", 		$ConfigSlogan);
			$request->setObject("ConfigPhone1", 		$ConfigPhone1);
			$request->setObject("ConfigPhone2", 		$ConfigPhone2);
			$request->setObject("ConfigYahooMessenger", $ConfigYahooMessenger);
			$request->setObject("ConfigSkype", 			$ConfigSkype);
			$request->setObject("Navigation", 			$Navigation);
			
			$request->setObject("TagAll", 				$TagAll);
			
			$request->setObject("BranchAll", 			$BranchAll);										
			$request->setObject("CategoryAll", 			$CategoryAll);
								
			$request->setObject("Cart", 				$Cart);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
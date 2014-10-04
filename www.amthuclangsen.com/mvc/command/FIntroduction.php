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
			$mTag 		= new \MVC\Mapper\Tag();
			$mBranch 	= new \MVC\Mapper\Branch();
			
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
			$ConfigIntro 			= $mConfig->findByName("POST_INTRODUCTION");
			
			$CategoryAll 			= $mCategory->findAll();
			$BranchAll 				= $mBranch->findAll();
			$TagAll 				= $mTag->findAll();
			
			$Post 					= $mPost->find($ConfigIntro->getValue() );
						
			$Title = "GIỚI THIỆU";
			$Navigation = array(
				
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Title", 				$Title);
			$request->setProperty("Active", 			'Post');
			$request->setObject("Navigation", 			$Navigation);
			$request->setObject("ConfigName", 			$ConfigName);
			$request->setObject("ConfigSlogan", 		$ConfigSlogan);
			$request->setObject("ConfigPhone1", 		$ConfigPhone1);
			$request->setObject("ConfigPhone2", 		$ConfigPhone2);
			$request->setObject("ConfigYahooMessenger", $ConfigYahooMessenger);
			$request->setObject("ConfigSkype", 			$ConfigSkype);
			
			$request->setObject("Post", 				$Post);
			$request->setObject("TagAll", 				$TagAll);
			$request->setObject("CategoryAll", 			$CategoryAll);
			$request->setObject("BranchAll", 			$BranchAll);
									
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
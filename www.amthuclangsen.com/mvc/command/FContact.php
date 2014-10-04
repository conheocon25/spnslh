<?php
	namespace MVC\Command;	
	class FContact extends Command {
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
			$mTag 		= new \MVC\Mapper\Tag();
			$mBranch 	= new \MVC\Mapper\Branch();
			
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
			
			$CategoryAll 	= $mCategory->findAll();
			$TagAll 		= $mTag->findByPosition(array(1));
			$BranchAll 		= $mBranch->findAll();
			
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
			$request->setObject("CategoryAll", 			$CategoryAll);
			$request->setObject("TagAll", 				$TagAll);
			$request->setObject("BranchAll", 			$BranchAll);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
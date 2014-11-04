<?php
	namespace MVC\Command;	
	class FUser extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdUser = $request->getProperty('IdUser');
			$Page 	= $request->getProperty('Page');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 	= new \MVC\Mapper\Config();			
			$mPost		= new \MVC\Mapper\Post();
			$mUser		= new \MVC\Mapper\User();
			$mTag 		= new \MVC\Mapper\Tag();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$User = $mUser->find($IdUser);
			$TagAll 	= $mTag->findAll();
			
			if (!isset($Page)) $Page = 1;						
			$PostAll1 	= $mPost->searchByUser(array($User->getId()));
			$PostAll 	= $mPost->searchByUserPage(array($User->getId(), $Page, 6));
			
			$PN 		= new \MVC\Domain\PageNavigation($PostAll1->count(), 6, $User->getURLView());
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty("Page", 				$Page);																		
			$request->setObject("User1", 				$User);
			$request->setObject("PostAll", 				$PostAll);
			$request->setObject("PN", 					$PN);
			$request->setObject("TagAll", 				$TagAll);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
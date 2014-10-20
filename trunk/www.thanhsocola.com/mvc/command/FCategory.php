<?php
	namespace MVC\Command;	
	class FCategory extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$KCategory1 	= 	$request->getProperty('KCategory1');
			$KCategory2 	= 	$request->getProperty('KCategory2');
			$IdManufacturer = 	$request->getProperty('IdManufacturer');
			$Page 			= 	$request->getProperty('Page');
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 		= new \MVC\Mapper\Config();
			$mCategory 		= new \MVC\Mapper\Category();
			$mCategory1		= new \MVC\Mapper\Category1();
			$mTag			= new \MVC\Mapper\Tag();
			$mProduct		= new \MVC\Mapper\Product();
			$mBranch 		= new \MVC\Mapper\Branch();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title = "";
			$ConfigName 	= $mConfig->findByName("NAME");
			$ConfigSlogan 	= $mConfig->findByName("SLOGAN");
			$ConfigGmail 	= $mConfig->findByName("CONTACT_GTALK");
			$ConfigSkype 	= $mConfig->findByName("CONTACT_SKYPE");
			$ConfigPhone1 	= $mConfig->findByName("PHONE1");
			$ConfigPhone2 	= $mConfig->findByName("PHONE2");
			$CategoryAll 	= $mCategory->findAll();
			$Category1 		= $mCategory->findByKey($KCategory1);
			$Category2 		= $mCategory1->findByKey(array($Category1->getId(), $KCategory2));
			$TagAll 		= $mTag->findByPosition(array(1));
			$BranchAll 		= $mBranch->findAll();
			
			$PMAll 			= $mProduct->findManufacturer1(array($Category2->getId()));
						
			if (!isset($Page)) $Page = 1;
			
			if (!isset($IdManufacturer)){
				$ProductAll 	= $mProduct->findByCategoryPage(array($Category2->getId(), $Page, 9));
				$PN 			= new \MVC\Domain\PageNavigation($Category2->getProductAll()->count(), 9, $Category2->getURLView());
			}else{
				$ProductAll 	= $mProduct->findByCategoryManufacturerPage(array($Category2->getId(), $IdManufacturer, $Page, 9));
				$PN 			= new \MVC\Domain\PageNavigation($Category2->getProductManufacturerAll($IdManufacturer)->count(), 9, $Category2->getURLViewManufacturer($IdManufacturer));
			}
			
			$Title = mb_strtoupper($Category2->getName(), 'UTF8');
			$Navigation = array(
				array(mb_strtoupper($Category1->getName(), 'UTF8'), "/")
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Title", 				$Title);			
			$request->setProperty("Active", 			"Menu");
			$request->setProperty("Page", 				$Page);
			$request->setObject("PN", 					$PN);
			$request->setObject("Navigation", 			$Navigation);
			
			$request->setObject("ConfigName", 			$ConfigName);
			$request->setObject("ConfigSlogan", 		$ConfigSlogan);
			$request->setObject("ConfigGmail", 			$ConfigGmail);
			$request->setObject("ConfigSkype", 			$ConfigSkype);
			$request->setObject("ConfigPhone1", 		$ConfigPhone1);
			$request->setObject("ConfigPhone2", 		$ConfigPhone2);
			
			$request->setObject("CategoryAll", 			$CategoryAll);
			$request->setObject("Category1", 			$Category1);			
			$request->setObject("Category2", 			$Category2);
			$request->setObject("TagAll", 				$TagAll);
			$request->setObject("ProductAll", 			$ProductAll);
			$request->setObject("BranchAll", 			$BranchAll);
			$request->setObject("PMAll", 				$PMAll);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
<?php
	namespace MVC\Command;	
	class FSupplier extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Page 		= $request->getProperty("Page");
			$KSupplier 	= $request->getProperty("KSupplier");
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mConfig 		= new \MVC\Mapper\Config();			
			$mCategory 		= new \MVC\Mapper\Category();						
			$mSupplier 		= new \MVC\Mapper\Supplier();
			$mProduct 		= new \MVC\Mapper\Product();
			$mTag 			= new \MVC\Mapper\Tag();
						
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
			
			$Supplier		= $mSupplier->find($KSupplier);
			$CategoryAll 	= $mCategory->findAll();
			$TagAll 		= $mTag->findByPosition(array(1));
			
			if (!isset($Page)) $Page = 1;			
			$ProductAll 	= $mProduct->findBySupplierPage(array($Supplier->getId(), $Page, 6));
			$PN 			= new \MVC\Domain\PageNavigation($Supplier->getProductAll()->count(), 6, $Supplier->getURLView());
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Active", 			'Home');
			$request->setProperty("Page", 				$Page);
			$request->setObject("ConfigName", 			$ConfigName);
			$request->setObject("ConfigSlogan", 		$ConfigSlogan);
			$request->setObject("ConfigPhone1", 		$ConfigPhone1);
			$request->setObject("ConfigPhone2", 		$ConfigPhone2);
			$request->setObject("ConfigGmail", 			$ConfigGmail);
			$request->setObject("ConfigSkype", 			$ConfigSkype);
						
			$request->setObject("Supplier", 			$Supplier);					
			$request->setObject("ProductAll", 			$ProductAll);
			$request->setObject("TagAll", 				$TagAll);
			$request->setObject("PN", 					$PN);
			$request->setObject("CategoryAll", 			$CategoryAll);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
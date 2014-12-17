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
			$mCategory1		= new \MVC\Mapper\Category1();
			$mSupplier 		= new \MVC\Mapper\Supplier();
			$mProduct 		= new \MVC\Mapper\Product();
			$mTag 			= new \MVC\Mapper\Tag();
			$mEstate 		= new \MVC\Mapper\TypeEstate();
			$mProvince		= new \MVC\Mapper\Province();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$ConfigName 			= $mConfig->findByName("NAME");
			$ConfigContact 			= $mConfig->findByName("CONTACT_NAME");
			$ConfigSlogan 			= $mConfig->findByName("SLOGAN");
			$ConfigPHome 			= $mConfig->findByName("PRESENTATION_HOME");
			$ConfigPhone1 			= $mConfig->findByName("PHONE1");
			$ConfigPhone2 			= $mConfig->findByName("PHONE2");
			$ConfigGmail 			= $mConfig->findByName("CONTACT_GTALK");
			$ConfigSkype 			= $mConfig->findByName("CONTACT_SKYPE");

			$SupplierAll			= $mSupplier->findAll();
			$Supplier				= $mSupplier->find($KSupplier);
			$CategoryAll 			= $mCategory->findAll();
			$CategoryAll1 			= $mCategory1->findAll();
			$TagAll 				= $mTag->findByPosition(array(1));
			$EstateAll				= $mEstate->findAll();
			$Province				= $mProvince->find(15);
			
			if (!isset($Page)) $Page = 1;			
			$ProductAll 	= $mProduct->findBySupplierPage(array($Supplier->getId(), $Page, 9));
			$PN 			= new \MVC\Domain\PageNavigation($Supplier->getProductAll()->count(), 9, $Supplier->getURLView());
			
			$Title = $Supplier->getName();
			$Navigation = array(
				array(mb_strtoupper('Nhà môi giới', 'UTF8'), '/trang-chu')
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Title", 				$Title);
			$request->setProperty("Active", 			'Home');
			$request->setProperty("Page", 				$Page);
			$request->setObject("ConfigName", 			$ConfigName);
			$request->setObject("ConfigContact", 		$ConfigContact);
			$request->setObject("ConfigSlogan", 		$ConfigSlogan);
			$request->setObject("ConfigPhone1", 		$ConfigPhone1);
			$request->setObject("ConfigPhone2", 		$ConfigPhone2);
			$request->setObject("ConfigGmail", 			$ConfigGmail);
			$request->setObject("ConfigSkype", 			$ConfigSkype);
			$request->setObject("Navigation", 			$Navigation);
						
			$request->setObject("SupplierAll", 			$SupplierAll);					
			$request->setObject("SupplierCurrent", 		$Supplier);
			$request->setObject("ProductAll", 			$ProductAll);
			$request->setObject("TagAll", 				$TagAll);
			$request->setObject("PN", 					$PN);
			$request->setObject("CategoryAll", 			$CategoryAll);
			$request->setObject("CategoryAll1", 		$CategoryAll1);
			$request->setObject("EstateAll", 			$EstateAll);
			$request->setObject("Province", 			$Province);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
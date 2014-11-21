<?php
	namespace MVC\Command;	
	class FProduct extends Command {
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
			$KProduct 		= 	$request->getProperty('KProduct');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 	= new \MVC\Mapper\Config();
			$mCategory 	= new \MVC\Mapper\Category();
			$mCategory1	= new \MVC\Mapper\Category1();
			$mProvince 	= new \MVC\Mapper\Province();
			$mProduct 	= new \MVC\Mapper\Product();
			$mEstate 	= new \MVC\Mapper\TypeEstate();
			$mTag 		= new \MVC\Mapper\Tag();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Title 			= "";
			$ConfigName 	= $mConfig->findByName("NAME");
			$ConfigSlogan 	= $mConfig->findByName("SLOGAN");
			$ConfigPhone1 	= $mConfig->findByName("PHONE1");
			$ConfigPhone2 	= $mConfig->findByName("PHONE2");
			$ConfigGmail 	= $mConfig->findByName("CONTACT_GTALK");
			$ConfigSkype 	= $mConfig->findByName("CONTACT_SKYPE");
			
			$CategoryAll 	= $mCategory->findAll();
			$EstateAll 		= $mEstate->findAll();
			$Product 		= $mProduct->findByKey($KProduct);
			$Category1 		= $Product->getCategory();
			$Category 		= $Category1->getCategory();
			$Province 		= $mProvince->find(15);
			$TagAll 		= $mTag->findByPosition(array(1));
						
			$Title = mb_strtoupper($Product->getName(),'UTF8');
			$Navigation = array(
				array(mb_strtoupper($Category->getName(), 'UTF8'), 	$Category->getURLView()),
				array(mb_strtoupper($Category1->getName(), 'UTF8'), $Category1->getURLView())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Title", 		$Title);
			$request->setProperty("Active", 	"Menu");
			$request->setObject("Navigation", 	$Navigation);
			
			$request->setObject("ConfigName", 	$ConfigName);
			$request->setObject("ConfigSlogan", $ConfigSlogan);			
			$request->setObject("ConfigPhone1", $ConfigPhone1);
			$request->setObject("ConfigPhone2", $ConfigPhone2);
			$request->setObject("ConfigGmail", 	$ConfigGmail);
			$request->setObject("ConfigSkype", 	$ConfigSkype);
						
			$request->setObject("TagAll", 		$TagAll);
			$request->setObject("CategoryAll", 	$CategoryAll);
			$request->setObject("EstateAll", 	$EstateAll);
			$request->setObject("Category", 	$Category);
			$request->setObject("Category1", 	$Category1);
			$request->setObject("Province", 	$Province);
			$request->setObject("Product", 		$Product);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
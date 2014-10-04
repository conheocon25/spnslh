<?php
	namespace MVC\Command;	
	class FHome extends Command {
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
			$mSave 			= new \MVC\Mapper\Save();
			$mCategory 		= new \MVC\Mapper\Category();
			$mProduct 		= new \MVC\Mapper\Product();
			$mPresentation 	= new \MVC\Mapper\Presentation();
			$mTag 			= new \MVC\Mapper\Tag();
			//$mOED 			= new \MVC\Mapper\OrderExportDetail();
			//$mOID 			= new \MVC\Mapper\OrderImportDetail();
			$mManufacturer	= new \MVC\Mapper\Manufacturer();
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
			$ManufacturerAll= $mManufacturer->findAll();
			$StoryLineAll	= $mStoryLine->findAll();
			
			$SaveAll 		= $mSave->findAll();
			$Save	 		= $SaveAll->current();
			
			$CategoryAll 	= $mCategory->findAll();
			$ProductAll1 	= $mProduct->findByTop(array());			
			$Presentation1 	= $mPresentation->find($ConfigPHome->getValue());
			$Presentation2	= $mPresentation->find(3);
			
			$TagAll 		= $mTag->findByPosition(array(1));
			
			//$OEDAll 		= $mOED->findTop(array());
			//$OIDAll 		= $mOID->findTop(array());
			
			$OEDAll 		= null;
			$OIDAll 		= null;
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Active", 			'Home');
			$request->setObject("ConfigName", 			$ConfigName);
			$request->setObject("ConfigSlogan", 		$ConfigSlogan);
			$request->setObject("ConfigPhone1", 		$ConfigPhone1);
			$request->setObject("ConfigPhone2", 		$ConfigPhone2);
			$request->setObject("ConfigYahooMessenger", $ConfigYahooMessenger);
			$request->setObject("ConfigSkype", 			$ConfigSkype);
			
			$request->setObject("TagAll", 				$TagAll);
			$request->setObject("Tag", 					$TagAll->current());
			
			$request->setObject("BranchAll", 			$BranchAll);
			$request->setObject("ManufacturerAll", 		$ManufacturerAll);
			$request->setObject("StoryLineAll", 		$StoryLineAll);
			
			$request->setObject("Save", 				$Save);
			$request->setObject("Presentation1", 		$Presentation1);
			$request->setObject("Presentation2", 		$Presentation2);
			$request->setObject("CategoryAll", 			$CategoryAll);
			$request->setObject("ProductAll1", 			$ProductAll1);
			
			$request->setObject("OEDAll", 				$OEDAll);
			$request->setObject("OIDAll", 				$OIDAll);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
<?php
	namespace MVC\Command;	
	class FDealer extends Command {
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdManufacturer = $request->getProperty('IdManufacturer');
			$KCategory2 	= $request->getProperty('KCategory2');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 		= new \MVC\Mapper\Config();
			$mSave 			= new \MVC\Mapper\Save();
			$mCategory 		= new \MVC\Mapper\Category();
			$mCategory1 	= new \MVC\Mapper\Category1();
			$mProduct 		= new \MVC\Mapper\Product();
			$mPresentation 	= new \MVC\Mapper\Presentation();
			$mTag 			= new \MVC\Mapper\Tag();
			$mOED 			= new \MVC\Mapper\OrderExportDetail();
			$mOID 			= new \MVC\Mapper\OrderImportDetail();
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
									
			$CategoryAll 	= $mCategory->findAll();
			$ProductAll 	= $mProduct->findByTop(array());			
			$Presentation 	= $mPresentation->find($ConfigPHome->getValue());
			
			$SaveAll 		= $mSave->findAll();
			$Save	 		= $SaveAll->current();
			
			$PMAll 			= $mProduct->findManufacturer2(array($Save->getId()));			
			$TagAll 		= $mTag->findByPosition(array(1));
			
			if (isset($IdManufacturer)){
				$PSAll = $Save->getSPMAll($IdManufacturer);
			}else if (isset($KCategory2)){
				$Category2 = $mCategory1->findByKey($KCategory2);
				$PSAll = $Save->getSPCAll( $Category2->getId() );
			}else{
				$PSAll = $Save->getSPAll();
			}
												
			$Title = "KHUYẾN MÃI";
			$Navigation = array(
			
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty("Active", 			'Dialer');
			$request->setProperty("Title", 				$Title);
			$request->setObject("ConfigName", 			$ConfigName);
			$request->setObject("ConfigSlogan", 		$ConfigSlogan);
			$request->setObject("ConfigPhone1", 		$ConfigPhone1);
			$request->setObject("ConfigPhone2", 		$ConfigPhone2);
			$request->setObject("ConfigYahooMessenger", $ConfigYahooMessenger);
			$request->setObject("ConfigSkype", 			$ConfigSkype);
			$request->setObject("Navigation", 			$Navigation);
			
			$request->setObject("TagAll", 				$TagAll);
			$request->setObject("Tag", 					$TagAll->current());
			
			$request->setObject("BranchAll", 			$BranchAll);
			$request->setObject("ManufacturerAll", 		$ManufacturerAll);
						
			$request->setObject("Save", 				$Save);
			$request->setObject("PMAll", 				$PMAll);
			$request->setObject("PSAll", 				$PSAll);
			
			$request->setObject("Presentation", 		$Presentation);
			$request->setObject("CategoryAll", 			$CategoryAll);
												
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
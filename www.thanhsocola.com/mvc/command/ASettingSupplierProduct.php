<?php		
	namespace MVC\Command;	
	class ASettingSupplierProduct extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$Page 			= $request->getProperty('Page');
			$IdSupplier 	= $request->getProperty('IdSupplier');
			$IdCategory1 	= $request->getProperty('IdCategory1');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mSupplier 		= new \MVC\Mapper\Supplier();
			$mProduct 		= new \MVC\Mapper\Product();
			$mCategory1		= new \MVC\Mapper\Category1();
			$mManufacturer 	= new \MVC\Mapper\Manufacturer();
			$mConfig 		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$Supplier = $mSupplier->find($IdSupplier);
			$CategoryAll1 = $mCategory1->findAll();			
			
			if (!isset($IdCategory1)){
				$Category1 	 = $CategoryAll1->current();
				$IdCategory1 = $CategoryAll1->current()->getId();
			}else{
				$Category1 	 = $mCategory1->find($IdCategory1);
			}
			$SupplierAll 	= $mSupplier->findAll();
									
			$Title = mb_strtoupper($Category1->getName(), 'UTF8');
			$Navigation = array(				
				array("THIẾT LẬP", "/admin/setting"),
				array(mb_strtoupper($Supplier->getName(),'UTF8'), "/admin/setting/supplier")
			);
			if (!isset($Page)) $Page=1;
			$Config 	= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName = $mConfig->findByName("NAME");
			
			$ProductAll1 = $mProduct->findByPage1(array($IdSupplier, $IdCategory1, $Page, $Config->getValue() ));
			
			$PN = new \MVC\Domain\PageNavigation( 
				$Supplier->getProductAllByCategory($IdCategory1)->count(),
				$Config->getValue(), 
				$Supplier->getURLSettingCategory($IdCategory1) 
			);			
			$ManufacturerAll = $mManufacturer->findAll();			
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('IdCategory1'	, $IdCategory1);
			$request->setProperty('Page'		, $Page);
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('PN'			, $PN);
			
			$request->setObject('ManufacturerAll', $ManufacturerAll);
			$request->setObject('CategoryAll1'	, $CategoryAll1);
			$request->setObject('ProductAll1'	, $ProductAll1);
			$request->setObject('Supplier'		, $Supplier);			
			$request->setObject('ConfigName'	, $ConfigName);			
			$request->setObject('SupplierAll'	, $SupplierAll);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
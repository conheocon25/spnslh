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
			$IdManufacturer = $request->getProperty('IdManufacturer');
			
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
			if (!isset($IdManufacturer)){
				$P1All = $Supplier->getManufacturerAll();
				$IdManufacturer = $mManufacturer->findAll()->current()->getId();
			}
			
			$SupplierAll 		= $mSupplier->findAll();
			$ManufacturerAll 	= $mManufacturer->findAll();
						
			$Title = mb_strtoupper($Supplier->getName(), 'UTF8');
			$Navigation = array(				
				array("THIẾT LẬP", "/admin/setting"),
				array("NHÀ CUNG CẤP", "/admin/setting/supplier")
			);
			if (!isset($Page)) $Page=1;
			$Config 	= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName = $mConfig->findByName("NAME");
			
			$ProductAll1 = $mProduct->findByPage1(array($IdSupplier, $IdManufacturer, $Page, $Config->getValue() ));
			
			$PN = new \MVC\Domain\PageNavigation( 
					$Supplier->getProductManufacturer($IdManufacturer)->count(), 
					$Config->getValue(), 
					$Supplier->getURLSettingManufacturer($IdManufacturer) 
				);
			$CategoryAll1 = $mCategory1->findAll();			
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('IdManufacturer'	, $IdManufacturer);
			$request->setProperty('Page'		, $Page);
			$request->setObject('Navigation'	, $Navigation);
			
			$request->setObject('CategoryAll1'	, $CategoryAll1);
			$request->setObject('ProductAll1'	, $ProductAll1);
			$request->setObject('Supplier'		, $Supplier);
			$request->setObject('PN'			, $PN);
			$request->setObject('ConfigName'	, $ConfigName);
			
			$request->setObject('SupplierAll'		, $SupplierAll);
			$request->setObject('ManufacturerAll'	, $ManufacturerAll);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
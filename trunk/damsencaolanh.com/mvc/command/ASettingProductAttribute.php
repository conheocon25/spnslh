<?php		
	namespace MVC\Command;	
	class ASettingProductAttribute extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdSupplier = $request->getProperty('IdSupplier');
			$IdProduct 	= $request->getProperty('IdProduct');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mSupplier 			= new \MVC\Mapper\Supplier();
			$mProduct 			= new \MVC\Mapper\Product();			
			$mProductAttribute 	= new \MVC\Mapper\ProductAttribute();
			$mCategory1			= new \MVC\Mapper\Category1();
			$mManufacturer 		= new \MVC\Mapper\Manufacturer();
			$mConfig 			= new \MVC\Mapper\Config();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$Product 		= $mProduct->find($IdProduct);
			$Supplier 		= $mSupplier->find($IdSupplier);
			
			$PAAll = $Product->getAttributeAll();
			if ($PAAll->count()==0){
				
				$Category 		= $Product->getCategory();
				$GAttribute 	= $Category->getGAttribute();
				$AttributeAll 	= $GAttribute->getAttributeAll();
				
				while ($AttributeAll->valid()){
					$Attribute = $AttributeAll->current();
					
					$PA = new \MVC\Domain\ProductAttribute(
						null,
						$Product->getId(),
						$Attribute->getId(),
						"ABC"
					);									
					$mProductAttribute->insert($PA);					
					$AttributeAll->next();
				}
			}
									
			$Title = mb_strtoupper($Product->getName(), 'UTF8');
			$Navigation = array(				
				array("THIẾT LẬP", 		"/admin/setting"),
				array("NHÀ CUNG CẤP", 	"/admin/setting/supplier"),
				array(mb_strtoupper($Supplier->getName(),'UTF8'), $Supplier->getURLProduct())
			);						
			$ConfigName = $mConfig->findByName("NAME");
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('ActiveAdmin'	, 'Product');			
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('Product'		, $Product);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
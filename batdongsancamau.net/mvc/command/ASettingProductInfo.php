<?php		
	namespace MVC\Command;	
	class ASettingProductInfo extends Command {
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
			$mSupplier 		= new \MVC\Mapper\Supplier();
			$mProduct 		= new \MVC\Mapper\Product();
			$mProductInfo	= new \MVC\Mapper\ProductInfo();
			$mCategory1		= new \MVC\Mapper\Category1();			
			$mConfig 		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$Product 		= $mProduct->find($IdProduct);									
			$Supplier 		= $mSupplier->find($IdSupplier);
			
			$IdPI  			= $mProductInfo->exist(array($IdProduct));
			if ($IdPI==-1){
				$PI = new \MVC\Domain\ProductInfo(
					null,
					$IdProduct,
					"abc", 
					"", "", "", "", "", "", "", "", "", "", "", "", "", ""
				);											
				$mProductInfo->insert($PI);
			}else{
				$PI = $mProductInfo->find($IdPI);
			}
			
			$Title = "GIỚI THIỆU";
			$Navigation = array(				
				array("THIẾT LẬP", "/admin/setting"),
				array(mb_strtoupper($Supplier->getName(),'UTF8'), "/admin/setting/supplier"),				
				array(mb_strtoupper($Product->getName(),'UTF8'), $Product->getURLSetting())
			);						
			$ConfigName = $mConfig->findByName("NAME");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);
			$request->setProperty('ActiveAdmin'	, 'Product');
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('Product'		, $Product);
			$request->setObject('PI'			, $PI);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
<?php		
	namespace MVC\Command;	
	class ASettingProductMap extends Command {
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
			$mProvince 		= new \MVC\Mapper\Province();
			$mProduct 		= new \MVC\Mapper\Product();
			$mProductMap	= new \MVC\Mapper\ProductMap();
			$mConfig 		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$Province 		= $mProvince->find(15);
			$Product 		= $mProduct->find($IdProduct);									
			$Supplier 		= $mSupplier->find($IdSupplier);
			
			$IdPM  			= $mProductMap->exist(array($IdProduct));
			if ($IdPM==-1){
				$PM = new \MVC\Domain\ProductMap(null, $IdProduct, 1, 0, 0, "Địa chỉ");
				$mProductMap->insert($PM);
			}else{
				$PM = $mProductMap->find($IdPM);
			}
			
			$Title = "BẢN ĐỒ";
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
			$request->setObject('Province'		, $Province);
			$request->setObject('Product'		, $Product);
			$request->setObject('PM'			, $PM);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
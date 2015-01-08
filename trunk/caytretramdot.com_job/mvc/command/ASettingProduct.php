<?php		
	namespace MVC\Command;	
	class ASettingProduct extends Command {
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
			$mCategory1		= new \MVC\Mapper\Category1();			
			$mEstate		= new \MVC\Mapper\TypeEstate();			
			$mProvince		= new \MVC\Mapper\Province();
			$mConfig 		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$Product 		= $mProduct->find($IdProduct);									
			$Supplier 		= $mSupplier->find($IdSupplier);
			$CategoryAll1 	= $mCategory1->findAll();
			$EstateAll 		= $mEstate->findAll();
			$Province 		= $mProvince->find(15);
									
			$Title 			= mb_strtoupper($Product->getName(), 'UTF8');
			$Navigation = array(				
				array("THIẾT LẬP", "/admin/setting"),
				array(mb_strtoupper($Supplier->getName(),'UTF8'), "/admin/setting/supplier"),
				array(mb_strtoupper("TIN ĐĂNG",'UTF8'), $Supplier->getURLSettingProduct())
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
			$request->setObject('CategoryAll1'	, $CategoryAll1);
			$request->setObject('EstateAll'		, $EstateAll);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
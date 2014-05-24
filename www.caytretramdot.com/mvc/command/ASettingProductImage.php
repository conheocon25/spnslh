<?php		
	namespace MVC\Command;	
	class ASettingProductImage extends Command {
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
			$mSupplier 	= new \MVC\Mapper\Supplier();
			$mProduct 	= new \MVC\Mapper\Product();
			$mConfig 	= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																		
			$Supplier = $mSupplier->find($IdSupplier);
			$Product = $mProduct->find($IdProduct);
			
			$Title = mb_strtoupper($Product->getName(), 'UTF8');
			$Navigation = array(				
				array("THIẾT LẬP", "/admin/setting"),
				array("NHÀ CUNG CẤP", "/admin/setting/supplier"),
				array(mb_strtoupper($Supplier->getName(), 'UTF8'), $Supplier->getURLProduct())
			);
			
			$Config 	= $mConfig->findByName("ROW_PER_PAGE");
			$ConfigName = $mConfig->findByName("NAME");
												
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$request->setProperty('Title'		, $Title);						
			$request->setObject('Navigation'	, $Navigation);
			$request->setObject('ConfigName'	, $ConfigName);
			
			$request->setObject('Product'		, $Product);
			$request->setObject('Supplier'		, $Supplier);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
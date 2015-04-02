<?php		
	namespace MVC\Command;	
	class SettingSupplierInit extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdType 	= $request->getProperty('IdType');
			$IdSupplier = $request->getProperty('IdSupplier');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mSupplierType 		= new \MVC\Mapper\SupplierType();
			$mSupplier 			= new \MVC\Mapper\Supplier();
			$mSupplierInit 		= new \MVC\Mapper\SupplierInit();
			$mConfig 			= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$SupplierType		= $mSupplierType->find($IdType);
			$SupplierInit		= $mSupplierInit->check($IdSupplier);
			$Supplier			= $mSupplier->find($IdSupplier);
			
			if (!isset($SupplierInit)){
				$SupplierInit = new \MVC\Domain\SupplierInit(null, $IdSupplier, 1);
				$mSupplierInit->insert($SupplierInit);
			}			
						
			$Title = mb_strtoupper($Supplier->getName(), 'UTF8');
			$Navigation = array(				
				array("THIẾT LẬP", 									"/ql-thiet-lap"),
				array("KHÁCH HÀNG", 								"/ql-thiet-lap/khach-hang"),
				array(mb_strtoupper($SupplierType->getName(), 'UTF8'), 	$SupplierType->getURLSetting())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setProperty('Title'			, $Title);			
			$request->setObject('Navigation'		, $Navigation);
						
			$request->setObject('SupplierType'		, $SupplierType);
			$request->setObject('Supplier'			, $Supplier);
			$request->setObject('SupplierInit'		, $SupplierInit);
																								
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
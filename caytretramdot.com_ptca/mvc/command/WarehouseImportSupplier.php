<?php		
	namespace MVC\Command;	
	class WarehouseImportSupplier extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdKey 		= $request->getProperty('IdKey');
			$IdSupplier = $request->getProperty('IdSupplier');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 		= new \MVC\Mapper\Config();
			$mSupplier 		= new \MVC\Mapper\Supplier();
			$mEmployee 		= new \MVC\Mapper\Employee();
			$mWarehouse 	= new \MVC\Mapper\Warehouse();
															
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Supplier	 	= $mSupplier->find($IdSupplier);
			$SupplierAll 	= $mSupplier->findAll();
			$Warehouse 		= $mWarehouse->findByKey($IdKey);
			$User			= $Session->getCurrentUser();
			
			$Title 		= "LỆNH NHẬP KHO";
			$Navigation = array(
				array(mb_strtoupper($Warehouse->getName(), 'UTF8'), "/kho-hang/".$Warehouse->getKey())
			);
																		
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setObject("Warehouse", 	$Warehouse);
			$request->setObject("Supplier", 	$Supplier);
			$request->setObject("SupplierAll", 	$SupplierAll);
			$request->setObject("User", 		$User);
			
			$request->setObject("Navigation", 	$Navigation);
			$request->setProperty("Title"	, 	$Title);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
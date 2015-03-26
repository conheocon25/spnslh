<?php		
	namespace MVC\Command;	
	class WarehouseImport extends Command {
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
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 		= new \MVC\Mapper\Config();
			$mSupplier 		= new \MVC\Mapper\Supplier();
			$mEmployee 		= new \MVC\Mapper\Employee();
															
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																								
			$SupplierAll 	= $mSupplier->findAll();
			$EmployeeAll 	= $mEmployee->findAll();
			
			if (!isset($IdSupplier)){
				$Supplier 	= $SupplierAll->current();
			}else{
				$Supplier 	= $mSupplier->find($IdSupplier);
			}
			
			$Title 			= mb_strtoupper($Supplier->getName(), 'UTF8');
			$Navigation 	= array(
				array("LỆNH NHẬP", "/ql-kho-hang/lenh-nhap")
			);
																		
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setObject("SupplierAll", 	$SupplierAll);
			$request->setObject("EmployeeAll", 	$EmployeeAll);
			$request->setObject("Supplier", 	$Supplier);
			$request->setObject("Navigation", 	$Navigation);
			$request->setProperty("Title"	, 	$Title);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
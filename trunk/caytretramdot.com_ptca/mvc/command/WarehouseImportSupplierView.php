<?php		
	namespace MVC\Command;	
	class WarehouseImportSupplierView extends Command {
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
			$IdInvoice 	= $request->getProperty('IdInvoice');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 		= new \MVC\Mapper\Config();
			$mSupplier 		= new \MVC\Mapper\Supplier();			
			$mWarehouse 	= new \MVC\Mapper\Warehouse();
			$mInvoiceImport = new \MVC\Mapper\InvoiceImport();
			$mGood 			= new \MVC\Mapper\Good();
															
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Supplier	 	= $mSupplier->find($IdSupplier);
			$GoodAll 		= $mGood->findAll();
			$Warehouse 		= $mWarehouse->findByKey($IdKey);
			$Invoice		= $mInvoiceImport->find($IdInvoice);
									
			$Title 			= $Invoice->getDateTimeCreatedPrint();
			$Navigation 	= array(
				array(mb_strtoupper($Warehouse->getName(), 'UTF8'), "/kho-hang/".$Warehouse->getKey()),
				array("LỆNH NHẬP", "/kho-hang/".$Warehouse->getKey()."/lenh-nhap"),
				array(mb_strtoupper($Supplier->getName(), 'UTF8'), $Warehouse->getURLImportSupplier($Supplier))
			);
																					
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setObject("Warehouse", 	$Warehouse);
			$request->setObject("Supplier", 	$Supplier);
			$request->setObject("GoodAll", 		$GoodAll);
			$request->setObject("Invoice", 		$Invoice);
			
			$request->setObject("Navigation", 	$Navigation);
			$request->setProperty("Title"	, 	$Title);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
<?php		
	namespace MVC\Command;	
	class WarehouseExportLoadFinish extends Command {
		function doExecute( \MVC\Controller\Request $request){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdKey = $request->getProperty('IdKey');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mWarehouse 	= new \MVC\Mapper\Warehouse();
			$mInvoiceSell	= new \MVC\Mapper\InvoiceSell();
															
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Warehouse 		= $mWarehouse->findByKey($IdKey);
			
			$InvoiceAll		= $mInvoiceSell->findByStateWarehouse(array(2, $Warehouse->getId()));
			$InvoiceAll1	= $mInvoiceSell->findByStateWarehouse(array(3, $Warehouse->getId()));
																					
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("InvoiceAll", 	$InvoiceAll);
			$request->setObject("InvoiceAll1", 	$InvoiceAll1);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
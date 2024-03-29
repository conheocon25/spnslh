<?php		
	namespace MVC\Command;	
	class WarehouseExport extends Command {
		function doExecute( \MVC\Controller\Request $request ){
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
			$mConfig 		= new \MVC\Mapper\Config();
			$mWarehouse 	= new \MVC\Mapper\Warehouse();			
			$mInvoiceSell	= new \MVC\Mapper\InvoiceSell();
															
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																								
			$Warehouse 		= $mWarehouse->findByKey($IdKey);
			$ConfigTimer 	= $mConfig->findByName("TIMER_01");
			
			$InvoiceAll		= $mInvoiceSell->findByState(array(1));
			$InvoiceAll1	= $mInvoiceSell->findByStateWarehouse(array(2, $Warehouse->getId()));
			$InvoiceAll2	= $mInvoiceSell->findByStateWarehouse(array(3, $Warehouse->getId()));
			
			$Title 			= "LỆNH XUẤT KHO";
			$Navigation = array(
				array(mb_strtoupper($Warehouse->getName(), 'UTF8'), "/kho-hang/".$Warehouse->getKey())
			);
																		
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("ConfigTimer", 	$ConfigTimer);
			$request->setObject("Warehouse", 	$Warehouse);
			$request->setObject("InvoiceAll", 	$InvoiceAll);
			$request->setObject("InvoiceAll1", 	$InvoiceAll1);
			$request->setObject("InvoiceAll2", 	$InvoiceAll2);
			
			$request->setObject("Navigation", 	$Navigation);
			$request->setProperty("Title"	, 	$Title);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
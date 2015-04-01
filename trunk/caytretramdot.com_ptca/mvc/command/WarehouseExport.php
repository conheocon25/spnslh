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
			$Title 			= "LỆNH XUẤT KHO";
			$Navigation = array(
				array(mb_strtoupper($Warehouse->getName(), 'UTF8'), "/kho-hang/".$Warehouse->getKey())
			);
																		
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject("ConfigTimer", 	$ConfigTimer);			
			$request->setObject("Navigation", 	$Navigation);
			$request->setProperty("Title"	, 	$Title);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
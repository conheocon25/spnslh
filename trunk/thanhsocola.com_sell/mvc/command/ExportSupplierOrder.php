<?php		
	namespace MVC\Command;	
	class ExportSupplierOrder extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdSupplier 	= $request->getProperty('IdSupplier');
			$IdOrder 		= $request->getProperty('IdOrder');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mOrderExport 	= new \MVC\Mapper\OrderExport();
			$mSupplier 		= new \MVC\Mapper\Supplier();
			$mConfig 		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$Supplier 	= $mSupplier->find($IdSupplier);
			$Order 		= $mOrderExport->find($IdOrder);
			$ConfigName	= $mConfig->findByName("NAME");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
			$Title = $Order->getDatePrint();
			$Navigation = array(
				array("XUẤT HÀNG", "/export"),
				array(mb_strtoupper($Supplier->getName(), 'UTF8'), $Supplier->getURLExport())
			);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('Title'		, $Title);			
			$request->setObject('Navigation'	, $Navigation);
									
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('Order'			, $Order);
			$request->setObject('Supplier'		, $Supplier);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
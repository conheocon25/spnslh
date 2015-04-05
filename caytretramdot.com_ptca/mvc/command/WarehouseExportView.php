<?php		
	namespace MVC\Command;	
	class WarehouseExportView extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------						
			$IdInvoice 	= $request->getProperty("IdInvoice");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mEmployee 		= new \MVC\Mapper\Employee();
			$mGood 			= new \MVC\Mapper\Good();
			$mInvoiceSell 	= new \MVC\Mapper\InvoiceSell();
			$mWarehouse 	= new \MVC\Mapper\Warehouse();
			$mTransport 	= new \MVC\Mapper\Transport();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$WarehouseAll	= $mWarehouse->findAll();
			$TransportAll	= $mTransport->findAll();
			$GoodAll		= $mGood->findAll();
			$EmployeeAll	= $mEmployee->findAll();			
			$Invoice		= $mInvoiceSell->find($IdInvoice);						
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('WarehouseAll'	, $WarehouseAll);
			$request->setObject('TransportAll'	, $TransportAll);
			$request->setObject('GoodAll'		, $GoodAll);
			$request->setObject('EmployeeAll'	, $EmployeeAll);
			$request->setObject('Invoice'		, $Invoice);
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
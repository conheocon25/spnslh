<?php		
	namespace MVC\Command;	
	class WarehouseExportDetail extends Command{
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
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$GoodAll	= $mGood->findAll();
			$EmployeeAll= $mEmployee->findAll();			
			$Invoice	= $mInvoiceSell->find($IdInvoice);						
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('GoodAll'		, $GoodAll);
			$request->setObject('EmployeeAll'	, $EmployeeAll);			
			$request->setObject('Invoice'		, $Invoice);
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
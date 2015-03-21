<?php		
	namespace MVC\Command;	
	class SaleInvoiceCustomerDetailInvoice extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdCustomer = $request->getProperty("IdCustomer");
			$IdInvoice 	= $request->getProperty("IdInvoice");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mCustomer 		= new \MVC\Mapper\Customer();
			$mEmployee 		= new \MVC\Mapper\Employee();
			$mInvoiceSell 	= new \MVC\Mapper\InvoiceSell();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$EmployeeAll= $mEmployee->findAll();
			$Customer	= $mCustomer->find($IdCustomer);
			$Invoice	= $mInvoiceSell->find($IdInvoice);						
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('EmployeeAll'	, $EmployeeAll);
			$request->setObject('Customer'		, $Customer);
			$request->setObject('Invoice'		, $Invoice);
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
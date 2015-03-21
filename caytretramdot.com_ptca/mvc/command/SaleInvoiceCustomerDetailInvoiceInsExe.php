<?php		
	namespace MVC\Command;	
	class SaleInvoiceCustomerDetailInvoiceInsExe extends Command{
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
			$Employee 	= $EmployeeAll->current();
				
			$Customer	= $mCustomer->find($IdCustomer);
			$Invoice	= new \MVC\Domain\InvoiceSell(
				null,
				$Employee->getId(),
				$Customer->getId(),				
				\date("Y-m-d H:i:s"),
				\date("Y-m-d H:i:s"),
				"",
				0
			);	
			$mInvoiceSell->insert($Invoice);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
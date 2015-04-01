<?php		
	namespace MVC\Command;	
	class BranchSaleInvoiceCustomerCheck extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdKey 		= $request->getProperty("IdKey");
			$IdCustomer = $request->getProperty("IdCustomer");
			$IdInvoice 	= $request->getProperty("IdInvoice");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------									
			$mInvoiceSell 	= new \MVC\Mapper\InvoiceSell();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------												
			$Invoice	= $mInvoiceSell->find($IdInvoice);			
			$Invoice->setState(1);
			$mInvoiceSell->update($Invoice);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
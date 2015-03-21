<?php		
	namespace MVC\Command;	
	class SaleCustomerInvoicePrint extends Command{
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
			$mInvoiceSell 	= new \MVC\Mapper\InvoiceSell();
			$mConfig 		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------												
			$Customer		= $mCustomer->find($IdCustomer);
			$Invoice		= $mInvoiceSell->find($IdInvoice);
			$ConfigName		= $mConfig->findByName("NAME_COMPANY");
			$ConfigPhone	= $mConfig->findByName("PHONE1");
			$ConfigAddress	= $mConfig->findByName("ADDRESS");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject('Customer'		, $Customer);
			$request->setObject('Invoice'		, $Invoice);
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('ConfigPhone'	, $ConfigPhone);
			$request->setObject('ConfigAddress'	, $ConfigAddress);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
<?php		
	namespace MVC\Command;	
	class BranchSaleInvoiceCustomerView extends Command{
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
			$mBranch 		= new \MVC\Mapper\Branch();
			$mCustomer 		= new \MVC\Mapper\Customer();			
			$mInvoiceSell 	= new \MVC\Mapper\InvoiceSell();
			$mBranchQuota	= new \MVC\Mapper\BranchQuota();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$Branch		= $mBranch->findByKey($IdKey);
			$Customer	= $mCustomer->find($IdCustomer);
			$Invoice	= $mInvoiceSell->find($IdInvoice);			
			$URLCommand = "/don-vi/".$IdKey."/lenh-ban";
			
			//$result 	= $Branch->checkQuota($Invoice);
			//echo $result;
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setProperty('URLCommand'	, $URLCommand);
			$request->setObject('Branch'		, $Branch);
			$request->setObject('Customer'		, $Customer);
			$request->setObject('Invoice'		, $Invoice);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
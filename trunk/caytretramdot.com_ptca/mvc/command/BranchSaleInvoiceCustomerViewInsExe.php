<?php		
	namespace MVC\Command;	
	class BranchSaleInvoiceCustomerViewInsExe extends Command{
	      
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$Data 		= $request->getProperty("Data");
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------									
			$mInvoiceSell 			= new \MVC\Mapper\InvoiceSell();
			$mInvoiceSellDetail 	= new \MVC\Mapper\InvoiceSellDetail();
			$mCustomerPriceDetail 	= new \MVC\Mapper\CustomerPriceDetail();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$InvoiceSell 	= $mInvoiceSell->find($Data[1]);
			$Customer		= $InvoiceSell->getCustomer();
			$LP 			= $mCustomerPriceDetail->lastPrice(array($Data[2]));
												
			$ISD = new \MVC\Domain\InvoiceSellDetail(
				null,
				$InvoiceSell->getId(),
				$Data[2],
				$Data[3],
				$LP->getPrice()
			);
			$mInvoiceSellDetail->insert($ISD);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
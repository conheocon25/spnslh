<?php		
	namespace MVC\Command;	
	class SaleInvoiceDetailInsExe extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdCustomer = $request->getProperty('IdCustomer');
			$IdInvoice 	= $request->getProperty('IdInvoice');
			$IdGood 	= $request->getProperty('IdGood');
			$Count 		= $request->getProperty('Count');
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 		= new \MVC\Mapper\Config();
			$mGood 			= new \MVC\Mapper\Good();
			$mInvoiceSellDetail = new \MVC\Mapper\InvoiceSellDetail();
															
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$InvoiceSellDetail = new \MVC\Domain\InvoiceSellDetail(
				null,
				$IdInvoice,
				$IdGood,
				$Count,
				10000
			);
			$mInvoiceSellDetail->insert($InvoiceSellDetail);
															
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
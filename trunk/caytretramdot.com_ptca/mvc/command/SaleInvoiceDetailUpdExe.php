<?php		
	namespace MVC\Command;	
	class SaleInvoiceDetailUpdExe extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdDetail 	= $request->getProperty('IdDetail');						
			$Count 		= $request->getProperty('Count');
			$Price 		= $request->getProperty('Price');
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 		= new \MVC\Mapper\Config();			
			$mInvoiceSellDetail = new \MVC\Mapper\InvoiceSellDetail();
															
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$InvoiceSellDetail = $mInvoiceSellDetail->find($IdDetail);
			
			$InvoiceSellDetail->setCount($Count);
			$InvoiceSellDetail->setPrice($Price);
			$mInvoiceSellDetail->update($InvoiceSellDetail);
															
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
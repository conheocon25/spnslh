<?php		
	namespace MVC\Command;	
	class WarehouseExportLoadFinish extends Command {
		function doExecute( \MVC\Controller\Request $request){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------									
			$mInvoiceSell	= new \MVC\Mapper\InvoiceSell();
															
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$InvoiceAll		= $mInvoiceSell->findByState(array(2));
																					
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject("InvoiceAll", 	$InvoiceAll);																		
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
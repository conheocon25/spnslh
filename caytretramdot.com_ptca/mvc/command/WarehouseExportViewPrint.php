<?php		
	namespace MVC\Command;	
	class WarehouseExportViewPrint extends Command{
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
			$mInvoiceSell 	= new \MVC\Mapper\InvoiceSell();
			$mConfig 		= new \MVC\Mapper\Config();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------												
			$Invoice		= $mInvoiceSell->find($IdInvoice);						
			$ConfigName		= $mConfig->findByName("NAME_COMPANY");
			$ConfigPhone	= $mConfig->findByName("PHONE1");
			$ConfigAddress	= $mConfig->findByName("ADDRESS");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject('Invoice'		, $Invoice);
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('ConfigPhone'	, $ConfigPhone);
			$request->setObject('ConfigAddress'	, $ConfigAddress);
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
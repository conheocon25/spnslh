<?php		
	namespace MVC\Command;	
	class WarehouseImportDetailPrint extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdSupplier = $request->getProperty("IdSupplier");
			$IdInvoice 	= $request->getProperty("IdInvoice");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mSupplier 		= new \MVC\Mapper\Supplier();			
			$mInvoiceImport = new \MVC\Mapper\InvoiceImport();
			$mConfig 		= new \MVC\Mapper\Config();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------												
			$Supplier		= $mSupplier->find($IdSupplier);
			$Invoice		= $mInvoiceImport->find($IdInvoice);
			$ConfigName		= $mConfig->findByName("NAME_COMPANY");
			$ConfigPhone	= $mConfig->findByName("PHONE1");
			$ConfigAddress	= $mConfig->findByName("ADDRESS");
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject('Supplier'		, $Supplier);
			$request->setObject('Invoice'		, $Invoice);
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('ConfigPhone'	, $ConfigPhone);
			$request->setObject('ConfigAddress'	, $ConfigAddress);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
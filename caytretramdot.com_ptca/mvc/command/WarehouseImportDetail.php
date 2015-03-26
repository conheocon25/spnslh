<?php		
	namespace MVC\Command;	
	class WarehouseImportDetail extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdSupplier = $request->getProperty('IdSupplier');
			$IdInvoice 	= $request->getProperty('IdInvoice');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 		= new \MVC\Mapper\Config();
			$mGood 			= new \MVC\Mapper\Good();
			$mSupplier 		= new \MVC\Mapper\Supplier();
			$mInvoiceImport = new \MVC\Mapper\InvoiceImport();
															
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																								
			$GoodAll		= $mGood->findAll();
			$Supplier		= $mSupplier->find($IdSupplier);
			$Invoice		= $mInvoiceImport->find($IdInvoice);
			
			$Title 			= mb_strtoupper($Invoice->getDateTimeCreatedPrint(), 'UTF8');
			$Navigation 	= array(
				array("LỆNH NHẬP", "/ql-kho-hang/lenh-nhap"),
				array(mb_strtoupper($Supplier->getName(), 'UTF8'), $Supplier->getURLImport())
			);
																		
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setObject("GoodAll", 		$GoodAll);
			$request->setObject("Invoice", 		$Invoice);
			$request->setObject("Navigation", 	$Navigation);
			$request->setProperty("Title"	, 	$Title);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
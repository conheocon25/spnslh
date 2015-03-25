<?php		
	namespace MVC\Command;	
	class WarehouseImportInsExe extends Command{
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
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mSupplier 		= new \MVC\Mapper\Supplier();
			$mEmployee 		= new \MVC\Mapper\Employee();
			$mInvoiceImport = new \MVC\Mapper\InvoiceImport();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$EmployeeAll= $mEmployee->findAll();
			$Employee 	= $EmployeeAll->current();
				
			$Supplier	= $mSupplier->find($IdSupplier);
			$Invoice	= new \MVC\Domain\InvoiceImport(
				null,
				$Employee->getId(),
				$Supplier->getId(),				
				\date("Y-m-d H:i:s"),
				\date("Y-m-d H:i:s"),
				"",
				0
			);	
			$mInvoiceImport->insert($Invoice);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
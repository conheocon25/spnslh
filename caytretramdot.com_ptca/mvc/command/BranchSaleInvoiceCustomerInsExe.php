<?php		
	namespace MVC\Command;	
	class BranchSaleInvoiceCustomerInsExe extends Command{
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
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mBranch 		= new \MVC\Mapper\Branch();
			$mCustomer 		= new \MVC\Mapper\Customer();
			$mEmployee 		= new \MVC\Mapper\Employee();
			$mInvoiceSell 	= new \MVC\Mapper\InvoiceSell();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$EmployeeAll= $mEmployee->findAll();
			$Employee	= $EmployeeAll->current();
			$Branch		= $mBranch->findByKey($IdKey);
			$Customer	= $mCustomer->find($IdCustomer);
			
			$Invoice = new \MVC\Domain\InvoiceSell(
				null,				
				$Session->getCurrentIdUser(),
				$Customer->getId(),
				0,
				0,
				$Branch->getId(),
				\date("Y-m-d H:i:s"),
				\date("Y-m-d H:i:s"),
				"",
				0
			);
			$mInvoiceSell->insert($Invoice);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
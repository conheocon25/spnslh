<?php		
	namespace MVC\Command;	
	class SaleCommandCustomerInsExe extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdCustomer = $request->getProperty("IdCustomer");
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mCustomer 		= new \MVC\Mapper\Customer();
			$mEmployee 		= new \MVC\Mapper\Employee();
			$mBranch 		= new \MVC\Mapper\Branch();
			$mSaleCommand 	= new \MVC\Mapper\SaleCommand();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$EmployeeAll= $mEmployee->findAll();
			$Employee 	= $EmployeeAll->current();
				
			$Customer	= $mCustomer->find($IdCustomer);
			$Command	= new \MVC\Domain\SaleCommand(
				null,
				$Employee->getId(),
				$Customer->getId(),
				$Customer->getIdBranch(),
				\date("Y-m-d H:i:s"),
				"",
				0
			);	
			$mSaleCommand->insert($Command);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
<?php		
	namespace MVC\Command;	
	class SaleCommandCustomerDetail extends Command{
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
			$IdCommand 	= $request->getProperty("IdCommand");
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mBranch 		= new \MVC\Mapper\Branch();
			$mCustomer 		= new \MVC\Mapper\Customer();
			$mEmployee 		= new \MVC\Mapper\Employee();
			$mGood 			= new \MVC\Mapper\Good();
			$mSaleCommand 	= new \MVC\Mapper\SaleCommand();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$BranchAll	= $mBranch->findAll();
			$GoodAll	= $mGood->findAll();
			$EmployeeAll= $mEmployee->findAll();
			$Customer	= $mCustomer->find($IdCustomer);
			$Command	= $mSaleCommand->find($IdCommand);						
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$request->setObject('BranchAll'		, $BranchAll);
			$request->setObject('GoodAll'		, $GoodAll);
			$request->setObject('EmployeeAll'	, $EmployeeAll);
			$request->setObject('Customer'		, $Customer);
			$request->setObject('Command'		, $Command);
			
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
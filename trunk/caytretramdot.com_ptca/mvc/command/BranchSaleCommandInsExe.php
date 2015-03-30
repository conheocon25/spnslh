<?php		
	namespace MVC\Command;	
	class BranchSaleCommandInsExe extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdKey = $request->getProperty("IdKey");
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mBranch 		= new \MVC\Mapper\Branch();
			$mEmployee 		= new \MVC\Mapper\Employee();
			$mSaleCommand 	= new \MVC\Mapper\SaleCommand();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$Branch		= $mBranch->findByKey($IdKey);
			$EmployeeAll= $mEmployee->findAll();
			$Employee 	= $EmployeeAll->current();
								
			$Command	= new \MVC\Domain\SaleCommand(
				null,
				$Session->getCurrentIdUser(),
				$Branch->getId(),				
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
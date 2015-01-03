<?php
	namespace MVC\Command;
	class SellingSessionInsert extends Command{
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session1 = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdCustomer = $request->getProperty("IdCustomer");
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCustomer 	= new \MVC\Mapper\Customer();
			$mEmployee 	= new \MVC\Mapper\Employee();
			$mTable 	= new \MVC\Mapper\Table();
			$mSession 	= new \MVC\Mapper\Session();
												
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$EmployeeAll 	= $mEmployee->findAll();
			$Employee 		= $EmployeeAll->current();
			
			$TableAll 		= $mTable->findAll();
			$Table 			= $TableAll->current();
			
			$Session = new \MVC\Domain\Session(
				null,							//Id
				$Table->getId(),				//IdTable
				$Session1->getCurrentIdUser(),	//IdUser
				$IdCustomer,					//IdCustomer	
				$Employee->getId(),				//IdEmployee
				\date("Y-m-d H:i:s"), 			//DateTime
				null, 							//DateTimeEnd
				"",								//Note
				"",								//Status
				0,								//DiscountValue	
				0,								//DiscountPercent
				0,								//Surtax
				0								//Payment
			);
			$IdSession = $mSession->insert($Session);
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$Data = array("Result" => "OK");
			echo json_encode($Data);
		}
	}
?>
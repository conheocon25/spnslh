<?php		
	namespace MVC\Command;	
	class ASellingSession extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
									
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mOrderExport 	= new \MVC\Mapper\OrderExport();
			$mEmployee 		= new \MVC\Mapper\Employee();
			$mConfig		= new \MVC\Mapper\Config();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$Order 		= $mOrderExport->findCurrent();
			$OrderAll	= $mOrderExport->findTop5(array());
			$EmployeeAll= $mEmployee->findAll();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject('Order'			, $Order);						
			$request->setObject('OrderAll'		, $OrderAll);
			$request->setObject('EmployeeAll'	, $EmployeeAll);
								
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
<?php		
	namespace MVC\Command;	
	class ASellingSessionPrint extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdOrder = $request->getProperty('IdOrder');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mOrderExport 	= new \MVC\Mapper\OrderExport();
			$mEmployee 		= new \MVC\Mapper\Employee();
			$mConfig		= new \MVC\Mapper\Config();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$Order 			= $mOrderExport->findCurrent();
			$ConfigName 	= $mConfig->findByName("NAME");
			$ConfigAddress 	= $mConfig->findByName("ADDRESS");
			$ConfigPhone 	= $mConfig->findByName("PHONE");
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$request->setObject('Order'			, $Order);
			$request->setObject('ConfigName'	, $ConfigName);
			$request->setObject('ConfigAddress'	, $ConfigAddress);
			$request->setObject('ConfigPhone'	, $ConfigPhone);
											
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
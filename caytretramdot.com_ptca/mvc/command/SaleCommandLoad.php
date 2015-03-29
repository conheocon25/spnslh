<?php		
	namespace MVC\Command;	
	class SaleCommandLoad extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mConfig 		= new \MVC\Mapper\Config();
			$mSaleCommand 	= new \MVC\Mapper\SaleCommand();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$CommandAll 	= $mSaleCommand->findByDateState(array(\date("Y-m-d"), 1));
																					
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setObject("CommandAll", 	$CommandAll);
						
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
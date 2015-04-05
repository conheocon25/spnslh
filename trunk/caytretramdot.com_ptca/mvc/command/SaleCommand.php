<?php		
	namespace MVC\Command;	
	class SaleCommand extends Command {
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
			$Title = "LỆNH BÁN";
			$Navigation = array(array("BÁN HÀNG", "/ql-ban-hang"));
			$ConfigTimer	= $mConfig->findByName("TIMER_01");
			
			$CommandFinishAll = $mSaleCommand->findByDateState(array( \date("Y-m-d"), 3));
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																											
			$request->setObject("CommandFinishAll", $CommandFinishAll);
			
			$request->setObject("Navigation", 	$Navigation);
			$request->setObject("ConfigTimer", 	$ConfigTimer);
			$request->setProperty("Title"	, 	$Title);
															
			return self::statuses('CMD_DEFAULT');
		}
	}
?>
<?php		
	namespace MVC\Command;	
	class ASellingCheckout extends Command {
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
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$Order = new \MVC\Domain\OrderExport(
				null,
				1,
				\date('y-m-d h:m'),
				"hóa đon bán lẻ"
			);
			$mOrderExport->insert($Order);
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$json = array('result' => "OK");
			echo json_encode($json);
		}
	}
?>
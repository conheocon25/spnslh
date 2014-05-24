<?php		
	namespace MVC\Command;	
	class ASellingCall extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdResource 	= $request->getProperty('IdResource');
			$Delta 			= $request->getProperty('Delta');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------						
			$mCustomer 		= new \MVC\Mapper\Customer();
			$mOrderExport 	= new \MVC\Mapper\OrderExport();
			$mProduct 		= new \MVC\Mapper\Product();
			$mOD 			= new \MVC\Mapper\OrderExportDetail();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------									
			$Order 		= $mOrderExport->findCurrent();
			$Product 	= $mProduct->find($IdResource);
			
			if (!isset($Order)){
				$Order = new \MVC\Domain\OrderExport(
					null,
					1,					
					\date("Y-m-d H:i:s"),
					"Thêm thử"
				);
				$mOrderExport->insert($Order);												
			}
			$IdOrder = $Order->getId();
			
			$IdOD = $mOD->exist(array($IdOrder, $IdResource));			
			if (!isset($IdOD) || $IdOD==-1){
				$OD = new \MVC\Domain\OrderExportDetail(
					null,
					$IdOrder, 
					$IdResource, 
					1,
					$Product->getPrice2()
				);
				$mOD->insert($OD);								
			}else{
				$OD = $mOD->find($IdOD);
				$Count = $OD->getCount() + 1;
				$OD->setCount($Count);
				$mOD->update($OD);								
			}
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------									
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$json = array('result' => "OK");
			echo json_encode($json);					
		}
	}
?>
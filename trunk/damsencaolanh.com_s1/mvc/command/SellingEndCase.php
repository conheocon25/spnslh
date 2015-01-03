<?php		
	namespace MVC\Command;	
	class SellingEndCase extends Command {
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
			$mTD 		= new \MVC\Mapper\TrackingDaily();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$TDAll 	= $mTD->findByDate(array(date('Y-m-d')));
			$TD		= $TDAll->current();
			
			$TD->setTime1(date('Y-m-d H:i'));
			$mTD->update($TD);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------																		
			$json = array('result' => "OK");
			echo json_encode($json);
		}
	}
?>
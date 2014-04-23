<?php
	namespace MVC\Command;	
	class RecommendAnswer extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();
									
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdDomain 	= $request->getProperty('IdDomain');
			$Answer 	= $request->getProperty('Answer');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mDomain = new \MVC\Mapper\Domain();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
							
			$Domain 		= $mDomain->find($IdDomain);
			$IndexQ			= $Session->getIndexQ();
			$ArrQ			= $Session->getArrQ();
			$ArrS			= $Session->getArrS();
			$ArrD			= $Session->getArrD();
			
			//Cập nhật lại ArrS
			$ArrSNew = array();
			$IndexT=0;
						
			for ($i=0; $i<count($ArrS); $i++){
				$IndexT = $ArrS[$i][2];
				if ($ArrD[$IndexT][$IndexQ] == $Answer){
					$ArrSNew[] = $ArrS[$i];
				}
			}			
			$Session->setArrS($ArrSNew);
			//Di chuyển đến câu hỏi tiếp theo và lưu vào Session
			$IndexQ++;
			$Session->setIndexQ($IndexQ);
			
						
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			$json = array('result' => "OK");
			echo json_encode($json);			
		}
	}
?>
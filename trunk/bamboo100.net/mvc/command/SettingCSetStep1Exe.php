<?php
	namespace MVC\Command;	
	class SettingCSetStep1Exe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------						
			$Session = \MVC\Base\SessionRegistry::instance();

			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdCBook 	= $request->getProperty('IdCBook');
			$IdCSet 	= $request->getProperty('IdCSet');
			$StepStr	= $request->getProperty('ArrStep');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------
			$mCB 	= new \MVC\Mapper\CBook();
			$mCS 	= new \MVC\Mapper\CSet();
			$mCStep	= new \MVC\Mapper\CStep();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------						
			$CBAll 		= $mCB->findAll();
			$CB			= $mCB->find($IdCBook);
			$CS			= $mCS->find($IdCSet);
			
			//Xóa các nước trước đó
			$mCStep->deleteBySet(array($IdCSet));
			
			$AStep		= explode("#", $StepStr);
			foreach ($AStep as $Step){
				if ($Step!=""){
					$AT = explode("|", $Step);
					$CStep = new \MVC\Domain\CStep(
						null, 
						$IdCSet, 
						$AT[1], 
						$AT[0]
					);
					$mCStep->insert($CStep);
				}
			}
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------					
			$json = array('result' => "OK");
			echo json_encode($json);						
		}
	}
?>
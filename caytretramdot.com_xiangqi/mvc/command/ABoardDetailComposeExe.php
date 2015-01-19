<?php		
	namespace MVC\Command;	
	class ABoardDetailComposeExe extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------
			$IdCategory = $request->getProperty('IdCategory');
			$IdBoard 	= $request->getProperty('IdBoard');
			$aStep 		= $request->getProperty('aStep');
			$aStepA 	= $request->getProperty('aStepA');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mCBM 			= new \MVC\Mapper\CBM();
			$mCBMDetail		= new \MVC\Mapper\CBMDetail();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																					
			$CBM			= $mCBM->find($IdBoard);
			$mCBMDetail->deleteBy(array($IdBoard));
			
			$Count = count($aStep);
			for ($i=0; $i<$Count; $i+=2){
				$CBMD = new \MVC\Domain\CBMDetail(
					null,
					$IdBoard,
					($i/2)+1,
					$aStepA[$i],
					$aStep[$i],
					$aStepA[$i+1],
					$aStep[$i+1]
				);
				$mCBMDetail->insert($CBMD);
			}
			$CBM->setMoveStart(0);
			$CBM->setMoveEnd($Count-1);
			
			$mCBM->update($CBM);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			
		}
	}
?>
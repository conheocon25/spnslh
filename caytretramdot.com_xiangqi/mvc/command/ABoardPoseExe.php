<?php		
	namespace MVC\Command;	
	class ABoardPoseExe extends Command {
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
			$mBoard 			= new \MVC\Mapper\Board();
			$mBoardDetail		= new \MVC\Mapper\BoardDetail();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																					
			$Board			= $mBoard->find($IdBoard);
			$mBoardDetail->deleteBy(array($IdBoard));
			
			$Count = count($aStep);
			for ($i=0; $i<$Count; $i+=2){
				
				if (isset($aStepA[$i+1])){
					$BoardD = new \MVC\Domain\BoardDetail(
						null,
						$IdBoard,
						($i/2)+1,
						$aStepA[$i],
						$aStep[$i],
						$aStepA[$i+1],
						$aStep[$i+1]
					);	
				}else{
					$BoardD = new \MVC\Domain\BoardDetail(
						null,
						$IdBoard,
						($i/2)+1,
						$aStepA[$i],
						$aStep[$i],
						"0",
						"END"
					);				
				}
				
				
				$mBoardDetail->insert($BoardD);
			}
			$Board->setMoveStart(0);
			$Board->setMoveEnd($Count-1);
			
			$mBoard->update($Board);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			
		}
	}
?>
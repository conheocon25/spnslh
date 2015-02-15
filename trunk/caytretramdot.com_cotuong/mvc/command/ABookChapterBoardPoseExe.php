<?php		
	namespace MVC\Command;	
	class ABookChapterBoardPoseExe extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdBook 	= $request->getProperty('IdBook');
			$IdChapter 	= $request->getProperty('IdChapter');
			$IdBoard 	= $request->getProperty('IdBoard');
			$aStep 		= $request->getProperty('aStep');
			$aStepA 	= $request->getProperty('aStepA');
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mBook 				= new \MVC\Mapper\Book();
			$mChapter 			= new \MVC\Mapper\Chapter();
			$mBoard 			= new \MVC\Mapper\Board();
			$mBoardDetail		= new \MVC\Mapper\BoardDetail();
						
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																											
			$Board			= $mBoard->find($IdBoard);
			$mBoardDetail->deleteBy(array($IdBoard));			
			$Count = count($aStep);
			
			if ($Board->getRound()>0){
				array_unshift($aStep, $Board->getState());
				array_unshift($aStepA, "...");
			}
												
			for ($i=0; $i<$Count; $i+=2){
				if ($aStepA[$i]=="-1"){
					$BoardD = new \MVC\Domain\BoardDetail(
						null,
						$IdBoard,
						($i/2)+1,
						"0",
						"START",
						$aStepA[$i],
						$aStep[$i],						
						"",
						""
					);
				}
				else if (isset($aStepA[$i+1])){
					$BoardD = new \MVC\Domain\BoardDetail(
						null,
						$IdBoard,
						($i/2)+1,
						$aStepA[$i],
						$aStep[$i],
						$aStepA[$i+1],
						$aStep[$i+1],
						"",
						""
					);	
				}else{
					$BoardD = new \MVC\Domain\BoardDetail(
						null,
						$IdBoard,
						($i/2)+1,
						$aStepA[$i],
						$aStep[$i],
						"0",
						"END",
						"",
						""
					);
				}								
				$mBoardDetail->insert($BoardD);
			}
			$Board->setMoveStart(0);
			$Board->setMoveEnd($Count-1);			
			$mBoard->update($Board);
			
			$Chapter = $mChapter->find($IdChapter);
			$Chapter->reCompleted();			
			$mChapter->update($Chapter);

			$Book 	= $mBook->find($IdBook);
			$Book->setTime(date('Y-m-d H:i:s'));
			$Book->reCompleted();			
			$mBook->update($Book);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			
		}
	}
?>
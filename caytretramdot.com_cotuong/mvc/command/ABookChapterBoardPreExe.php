<?php		
	namespace MVC\Command;	
	class ABookChapterBoardPreExe extends Command {
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
			$BoardDetailAll = $Board->getDetailAll();
			while ($BoardDetailAll->valid()){
				$Detail 		= $BoardDetailAll->current();
				$DetailPreAll 	= $mBoardDetail->findPre(array($IdBoard, $Detail->getMove()));
				
				if ($DetailPreAll->count()==0){
					$S1 = $Board->getState();
				}else{
					$DetailPre = $DetailPreAll->current();
					$S1 = $DetailPre->getState2();
				}
				//Xử lí Pre1					
				$S2 = $Detail->getState1();
					
				$A1 = str_split($S2);
				$A2 = str_split($S1);
				
				$Pos = -1;
				for ($i=0; $i< count($A1);$i++){
					if ($A1[$i] != $A2[$i] && $A1[$i] == '0'){
						$Pos = $i;
						break;
					}			
				}
				$PosStr = ($Pos%9).floor($Pos/9);
				$Detail->setPre1( $PosStr );
				
				//Xử lí Pre2
				$S1 = $Detail->getState1();
				$S2 = $Detail->getState2();
					
				$A1 = str_split($S2);
				$A2 = str_split($S1);
				
				$Pos = -1;
				for ($i=0; $i< count($A1);$i++){
					if ($A1[$i] != $A2[$i] && $A1[$i] == '0'){
						$Pos = $i;
						break;
					}			
				}
				$PosStr = ($Pos%9).floor($Pos/9);
				$Detail->setPre2( $PosStr );
				
				$mBoardDetail->update($Detail);
				
				$BoardDetailAll->next();
			}
												
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
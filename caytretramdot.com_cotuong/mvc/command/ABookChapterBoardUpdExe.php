<?php
	namespace MVC\Command;	
	class ABookChapterBoardUpdExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$IdBook 	= $request->getProperty('IdBook');
			$IdBoard 	= $request->getProperty('IdBoard');
			$IdChapter 	= $request->getProperty('IdChapter');
			$Name 		= $request->getProperty('Name');
			$State 		= $request->getProperty('State');			
			$Time 		= date('Y-m-d H:i:s');
			$Info 		= \stripslashes($request->getProperty('Info'));
			$MoveInit	= $request->getProperty('MoveInit');
			$MoveStart	= $request->getProperty('MoveStart');
			$MoveEnd	= $request->getProperty('MoveEnd');
			$Round		= $request->getProperty('Round');
			$Result		= $request->getProperty('Result');
			$Viewed		= $request->getProperty('Viewed');
			$Liked		= $request->getProperty('Liked');
									
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mBoard = new \MVC\Mapper\Board();
			$mBook 	= new \MVC\Mapper\Book();
					
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Book = $mBook->find($IdBook);
			$Book->setTime();
			$mBook->update($Book);
			
			$Board= $mBoard->find($IdBoard);
			
			$Board->setInfo($Info);			
			$Board->setName($Name);
			$Board->setState($State);
			$Board->setTime($Time);
			$Board->setMoveInit($MoveInit);
			$Board->setMoveStart($MoveStart);
			$Board->setMoveEnd($MoveEnd);
			$Board->setRound($Round);
			$Board->setResult($Result);
			$Board->setViewed($Viewed);
			$Board->setLiked($Liked);
			$Board->reKey();
			
			$mBoard->update($Board);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>
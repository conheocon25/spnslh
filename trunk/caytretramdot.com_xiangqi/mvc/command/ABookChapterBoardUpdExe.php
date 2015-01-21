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
			$IdBoard 	= $request->getProperty('IdBoard');
			$IdChapter 	= $request->getProperty('IdChapter');
			$Name 		= $request->getProperty('Name');			
			$Time 		= $request->getProperty('Time');			
			$Info 		= \stripslashes($request->getProperty('Info'));
			$MoveStart	= $request->getProperty('MoveStart');
			$MoveEnd	= $request->getProperty('MoveEnd');
												
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mBoard = new \MVC\Mapper\Board();
					
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------			
			$Board= $mBoard->find($IdBoard);
			
			$Board->setInfo($Info);			
			$Board->setName($Name);
			$Board->setTime($Time);			
			$Board->setMoveStart($MoveStart);
			$Board->setMoveEnd($MoveEnd);			
			$Board->reKey();
			
			$mBoard->update($Board);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>
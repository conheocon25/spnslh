<?php
	namespace MVC\Command;	
	class ABookChapterBoardInsExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$IdChapter 	= $request->getProperty('IdChapter');
			$Name 		= $request->getProperty('Name');			
			$Time 		= $request->getProperty('Time');			
			$Info 		= \stripslashes($request->getProperty('Info'));
			$MoveInit 	= $request->getProperty('MoveInit');
			$MoveStart 	= $request->getProperty('MoveStart');
			$MoveEnd	= $request->getProperty('MoveEnd');
			$Round 		= $request->getProperty('Round');
			$Result		= $request->getProperty('Result');
									
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mBoard = new \MVC\Mapper\Board();
					
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------										
			$Board = new \MVC\Domain\Board(
				null, 
				$IdChapter, 
				$Name, 
				"000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000",
				$Time, 
				$Info, 
				$MoveInit, 
				$MoveStart, 
				$MoveEnd,
				$Round,
				$Result,
				""
			);
			$Board->reKey();
			//print_r($Board);
			$mBoard->insert($Board);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>
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
			$MoveStart 	= $request->getProperty('MoveStart');
			$MoveEnd	= $request->getProperty('MoveEnd');
			
						
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
				$Time, 
				$Info, 
				$MoveStart, 
				$MoveEnd, 				
				""
			);
			$Board->reKey();
			
			$mBoard->insert($Board);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>
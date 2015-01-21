<?php
	namespace MVC\Command;	
	class ABoardInsExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------						
			$IdCategory = $request->getProperty('IdCategory');									
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
				$IdCategory, 
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
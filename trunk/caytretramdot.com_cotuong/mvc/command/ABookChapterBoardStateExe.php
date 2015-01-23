<?php		
	namespace MVC\Command;	
	class ABookChapterBoardStateExe extends Command {
		function doExecute( \MVC\Controller\Request $request ){
			require_once("mvc/base/domain/HelperFactory.php");
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------			
			$IdBoard 	= $request->getProperty('IdBoard');
			$aState		= $request->getProperty('aState');			
			
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mBoard 			= new \MVC\Mapper\Board();
									
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------																					
			$Board			= $mBoard->find($IdBoard);			
			$State = "";			
			for ($i=0;$i<10;$i++){
				for ($j=0;$j<9;$j++){
					$State = $State.$aState[$i][$j];
				}	
			}
			$Board->setState($State);
			$mBoard->update($Board);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			
		}
	}
?>
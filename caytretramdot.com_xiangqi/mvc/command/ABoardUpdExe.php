<?php
	namespace MVC\Command;	
	class ABoardUpdExe extends Command{
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
			$IdCategory = $request->getProperty('IdCategory');									
			$Name 		= $request->getProperty('Name');			
			$Time 		= $request->getProperty('Time');			
			$Info 		= \stripslashes($request->getProperty('Info'));
			$MoveStart	= $request->getProperty('MoveStart');
			$MoveEnd	= $request->getProperty('MoveEnd');
												
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mCBM = new \MVC\Mapper\CBM();
					
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			
			$CBM= $mCBM->find($IdBoard);
			
			$CBM->setInfo($Info);			
			$CBM->setName($Name);
			$CBM->setTime($Time);			
			$CBM->setMoveStart($MoveStart);
			$CBM->setMoveEnd($MoveEnd);			
			$CBM->reKey();
			
			$mCBM->update($CBM);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>
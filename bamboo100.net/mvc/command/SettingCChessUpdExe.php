<?php
	namespace MVC\Command;	
	class SettingCChessUpdExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			$IdCBook 	= $request->getProperty('IdCBook');
			$Author 	= $request->getProperty('Author');
			$DateTime 	= $request->getProperty('DateTime');
			$Content 	= \stripslashes($request->getProperty('Content'));
			$Title 		= $request->getProperty('Title');
			$Count 		= $request->getProperty('Count');
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mCB = new \MVC\Mapper\CBook();
					
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------													
			$CB = $mCB->find($IdCBook);
			$CB->setAuthor($Author);
			$CB->setContent($Content);
			$CB->setDateTime($DateTime);
			$CB->setTitle($Title);
			$CB->setCount($Count);
			$CB->reKey();
			$mCB->update($CB);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>

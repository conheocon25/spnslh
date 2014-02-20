<?php
	namespace MVC\Command;	
	class SettingCChessInsExe extends Command{
		function doExecute( \MVC\Controller\Request $request ) {
			require_once("mvc/base/domain/HelperFactory.php");			
			//-------------------------------------------------------------
			//THAM SỐ TOÀN CỤC
			//-------------------------------------------------------------			
			$Session = \MVC\Base\SessionRegistry::instance();
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐẾN
			//-------------------------------------------------------------									
			$DateTime 	= $request->getProperty('DateTime');
			$Author 	= $request->getProperty('Author');
			$Content 	= \stripslashes($request->getProperty('Content'));
			$Title 		= $request->getProperty('Title');
			$Count		= $request->getProperty('Count');
						
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mCB = new \MVC\Mapper\CBook();
					
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------								
			$CB = new \MVC\Domain\CBook(
				null,
				$Session->getCurrentUser()->getId(),
				$Author,
				$DateTime,
				$Title,
				$Content,
				1,
				""
			);
			$CB->reKey();
			$mCB->insert($CB);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------			
			return self::statuses('CMD_OK');
		}
	}
?>

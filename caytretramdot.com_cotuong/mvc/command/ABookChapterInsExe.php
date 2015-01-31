<?php
	namespace MVC\Command;	
	class ABookChapterInsExe extends Command{
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
			$IdBook 	= $request->getProperty('IdBook');			
			$Title 		= $request->getProperty('Title');						
			$Info 		= \stripslashes($request->getProperty('Info'));
									
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mChapter 	= new \MVC\Mapper\Chapter();
			$mBook 		= new \MVC\Mapper\Book();
			
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------
			$Book = $mBook->find($IdBook);
			$Book->setTime(date('Y-m-d H:i:s'));
			$mBook->update($Book);
			
			$Chapter = new \MVC\Domain\Chapter(
				null, 
				$IdBook, 
				$Title, 				
				$Info, 
				""
			);
			$Chapter->reKey();			
			$mChapter->insert($Chapter);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>
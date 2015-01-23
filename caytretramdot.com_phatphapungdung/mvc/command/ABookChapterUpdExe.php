<?php
	namespace MVC\Command;	
	class ABookChapterUpdExe extends Command{
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
			$IdChapter 	= $request->getProperty('IdChapter');			
			$Title 		= $request->getProperty('Title');
			$Info 		= \stripslashes($request->getProperty('Info'));
			$IdYouTube 	= $request->getProperty('IdYouTube');
									
			//-------------------------------------------------------------
			//MAPPER DỮ LIỆU
			//-------------------------------------------------------------			
			$mChapter = new \MVC\Mapper\Chapter();
					
			//-------------------------------------------------------------
			//XỬ LÝ CHÍNH
			//-------------------------------------------------------------										
			$Chapter = $mChapter->find($IdChapter);
			
			$Chapter->setInfo($Info);			
			$Chapter->setTitle($Title);			
			$Chapter->setIdYouTube($IdYouTube);			
			$Chapter->reKey();
			
			$mChapter->update($Chapter);
			
			//-------------------------------------------------------------
			//THAM SỐ GỬI ĐI
			//-------------------------------------------------------------
			return self::statuses('CMD_OK');
		}
	}
?>